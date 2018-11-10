<?php 
    session_start();

    if(isset($_SESSION["usuario"])){
      if($_SESSION["usuario"]["privilegio"]==1){
          header("Location: ../admin/index.php");
      }
  }else{
      header("Location: ../login.php");
  }
    include("maquetacion/head.php");
    
    include_once '../../conexion/conexion.php';
    include_once("../../conexion/conexion2.php");
    
    $sql="SELECT inscripcion.*, acreditables.nombre_acre, acreditables.fecha_inicio, acreditables.horario FROM inscripcion INNER JOIN acreditables ON inscripcion.id_acreditable=acreditables.id ";
    $gsent= $conexion->prepare($sql);
    $gsent->execute();

    $resultado = $gsent->fetchAll();

    



  // TRAER DATOS
  $estudiante= $_SESSION["usuario"]["id_estudiante"];
    
  $sqlestu       = "SELECT id, nom_est, ape_est FROM estudiantes WHERE id = ?";
  $setenciaestu  = $conexion2->prepare($sqlestu);
  $setenciaestu->execute(array($estudiante));
  $datos_estudiante = $setenciaestu->fetch();



?>


<script type="text/javascript">

function retirar(id) {
    //  if (confirm("¿Seguro que desea eliminar esta acreditable?")) {
        // 	 	window.location="trabajo/eliminar.php?id="+id;
        // 	}
            $(document).ready(function(){


var snapchatIcon = '<i class="fa fa-trash-o"></i>';
var snapchatNote = ' ¿Seguro deseas retirar esta acreditable? ';

$("body").overhang({
type: "confirm",
primary: "#767B89",
accent: "#878C9B",
message: snapchatIcon + snapchatNote,
custom: true,
html: true,
overlay: true,
callback: function (value) {
    if (value) {
     window.location.href = "ver_inscripciones.php?id="+id;
    } 
}
});

});
}

</script>



<body>
 
 <div class="page">
     <!-- Navegacion principal-->
     <header class="header">
       <nav class="navbar">
         <div class="container-fluid">
           <div class="navbar-holder d-flex align-items-center justify-content-between">
             <!-- Header - Navegacional -->
             <div class="navbar-header">
               <!-- Navbar Superior -->
               <a href="index.php" class="navbar-brand d-none d-sm-inline-block">
                 <div class="brand-text d-none d-lg-inline-block">
                   <span>Acreditables</span>
                   <strong> UPTAFBF</strong>
                 </div>
                 <div class="brand-text d-none d-sm-inline-block d-lg-none">
                   <strong>Acreditables</strong>
                 </div>
               </a>
               <!-- Boton toggle-->
               <a id="toggle-btn" href="#" class="menu-btn active">
                 <span></span>
                 <span></span>
                 <span></span>
               </a>
             </div>
             <!-- Navbar Menu -->
             <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
               <!-- Configuracion de cuenta  -->
               <li class="nav-item dropdown">
                 <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                   class="nav-link dropdown-toggle">
                   <span class="d-none d-sm-inline-block">Configurar</span>
                 </a>
                 <ul aria-labelledby="languages" class="dropdown-menu">
                 <li>
                    <a rel="nofollow" href="cambiardatos.php?id=<?php echo $_SESSION["usuario"]["id"] ?>" class="dropdown-item"> Actualizar datos</a>
                  </li>
                 </ul>
               </li>
               <!-- Boton - Salir    -->
               <li class="nav-item">
                 <a href="../../conexion/cerrar_sesion.php" class="nav-link logout">
                   <span class="d-none d-sm-inline">Cerrar Sesión</span>
                   <i class="fa fa-sign-out"></i>
                 </a>
               </li>
             </ul>
           </div>
         </div>
       </nav>
     </header>
     <div class="page-content d-flex align-items-stretch">
       <!-- Menu Lateral -->
       <nav class="side-navbar">
 
         <!-- Cabezera menu lateral-->
         <div class="sidebar-header d-flex align-items-center">
           <div class="avatar">
             <img src="../../img/avatar3.png" alt="..." class="img-fluid rounded-circle">
           </div>
           <div class="title">
             <h1 class="h4">Estudiante</h1>
             <p><?php echo $datos_estudiante["nom_est"]; echo " "; echo $datos_estudiante["ape_est"] ?></p>
           </div>
         </div>
 
         <!-- Opciones menu lateral-->
         <span class="heading">Menu</span>
         <ul class="list-unstyled">
           <li>
             <a href="index.php">
               <i class="fa fa-home"></i>Inicio </a>
           </li>
           <li class="active">
             <a href="ver_inscripciones.php">
               <i class="fa fa-book"></i>Mis Acreditables </a>
           </li>
          <li>
             <a href="ver_notas.php">
               <i class="fa fa-trophy"></i>Mis notas </a>
           </li>
           <!-- <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li> -->
           <li>
             <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
               <i class="fa fa-futbol-o"></i>Inscribir Acreditable </a>
             <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
               <li>
                 <a href="acreditableI.php">Acreditable I</a>
               </li>
               <li>
                 <a href="acreditableII.php">Acreditable II</a>
               </li>
               <li>
                 <a href="acreditableIII.php">Acreditable III</a>
               </li>
               <li>
                 <a href="acreditableIV.php">Acreditable IV</a>
               </li>
             </ul>
           </li>
             </ul>
           </li>
         </ul>
       </nav>
       <div class="content-inner">
                 <!-- Header de la pagina-->
                 <header class="page-header">
             <div class="container-fluid">
               <h2 class="no-margin-bottom">Mis acreditables</h2>
             </div>
           </header>
            <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Mis acreditables</li>
            </ul>
          </div>

         <!-- Aqui codigo para rellenar -->
         <section class="dashboard-counts no-padding-bottom">
 
           <div class="container-fluid">



   <table class="table bg-white text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Cedula</th>
      <th scope="col">Acreditable</th>
      <th scope="col">Estado</th>
      <th scope="col">Día de clases</th>
      <th scope="col">Hora</th>
      <th scope="col">Acciones</th>
    </tr>
  </thead>
  <tbody>
      <?php 
      foreach($resultado as $dato): 
        if( $dato["id_usuario"]== $_SESSION["usuario"]["id"] ){
          if( $dato["estado"]==1){

      ?>
    <tr>
      <td><?php echo $dato["nombre"] ?></td>
      <td><?php echo $dato["apellido"] ?></td>
      <td><?php echo $dato["cedula"] ?></td>
      <td><?php echo $dato["nombre_acre"] ?></td>

<?php
date_default_timezone_set('America/Caracas');
// CAPTURO LA FECHA LIMITE DE HASTA CUANDO ESTARA APERTURADA
$fecha_acreditable =$dato["fecha_inicio"];
// COMPARO FECHA ACTUAL CON LA ENVIADA
$fecha_actual = strtotime(date("Y-m-d H:i:s"));
$fecha_limite = strtotime($fecha_acreditable);
if($fecha_actual < $fecha_limite){
  ?>

      <td><strong><p class="text-success">Inscrito</p></strong></td>
      <td><?php echo $fechaBD = date("d-m-Y", strtotime($dato["fecha_inicio"])); ?></td>
      <td><?php echo $dato["horario"] ?></td>
      <td> <a href="javascript:retirar(<?php echo $dato["id"] ?>)" title="Retirar acreditable"><i class="fa fa-trash fa-lg"></i></a> </td>
      
      <?php 
        }else{ 
          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
      ?>
      <td><strong><p class="text-primary">En curso</p></strong></td>
      <td><?php echo $fechaBD = $dias[ date("w", strtotime($dato["fecha_inicio"])) ]; ?></td>
      <td><?php echo $dato["horario"] ?></td>
      <!-- <td> <a href="modificar_estudiante.php?id=<?php echo $dato["id"] ?>" title="Modificar"><i class="fa fa-edit fa-lg"></i></a> </td> -->
  
      <?php  
        }
      ?>   
    
    </tr>



<?php
          }
     }
    endforeach ?>
  </tbody>
</table>         
 
           </div>
         </section>
 
 <?php include("maquetacion/footer.php"); ?>

</body>

</html>


<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php
    if($_GET){
      include_once("../conexion/conexion.php");
        $id       = $_GET["id"];
        $id_usuario = $datos_estudiante["id"];

        $sql      = "UPDATE inscripcion SET estado=2 WHERE id=? AND id_usuario=?";
        $eliminar = $conexion->prepare($sql);
        $eliminar->execute(array($id, $id_usuario));
      echo $sql;
        if($eliminar){
            ?>
                <script>
                    $(document).ready(function(){
                        $("#enviar").attr("disabled", true);
                        $("body").overhang({
                            type: "success",
                            message: "Acreditable eliminada con exito!",
                            duration: 1,
                            callback: function(){
                                window.location.href = "ver_inscripciones.php";
                            }            
                        });
                    })
                </script>    
            <?php
        }
      }