<?php 

error_reporting(0);
    session_start();
    include("maquetacion/head.php");

    include_once 'conexion/conexion.php';
    
    $sql="SELECT inscripcion.id, inscripcion.id_estudiante, inscripcion.id_acreditable, acreditables.acreditable, acreditables.tipo, acreditables.seccion, usuarios.nombre, usuarios.apellido, usuarios.cedula FROM inscripcion, acreditables, usuarios, estudiantes WHERE inscripcion.id_acreditable=acreditables.id AND inscripcion.id_estudiante=estudiantes.id AND estudiantes.id_usuarios=usuarios.id";
    $gsent= $conexion->prepare($sql);
    $gsent->execute();

    $resultado = $gsent->fetchAll();

?>

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
             <h1 class="h4">¡Bienvenido!</h1>
             <p><?php echo $_SESSION["usuario"]["nombre"]; echo " "; echo $_SESSION["usuario"]["apellido"] ?></p>
           </div>
         </div>
 
         <!-- Opciones menu lateral-->
         <span class="heading">Menu</span>
         <ul class="list-unstyled">
           <li>
             <a href="index.php">
               <i class="fa fa-home"></i>Inicio </a>
           </li>
           <li>
                 <a href="aperturar.php"> 
                     <i class="fa fa-plus-square"></i>Aperturar acreditable 
                 </a>
             </li>
           <li>
             <a href="evaluacion.php">
               <i class="fa fa-tasks"></i>Plan de Evaluación </a>
           </li>
           <li>
             <a href="#">
               <i class="fa fa-book"></i>Cargar nota </a>
           </li>
           <li class="active">
             <a href="mostrar_consulta_asistencia.php">
               <i class="fa fa-calendar-check-o"></i>Control de Asistencia </a>
           </li>
           <li>
             <a href="acreditableI.php">
               <i class="fa fa-futbol-o"></i>Acreditables aperturadas </a>
           </li>
           <!-- <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li> -->
           <li>
             <a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse">
               <i class="fa fa-users"></i>Estudiantes inscritos </a>
             <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
               <li>
                 <a href="consultar_estudiantes.php">Cambiar privilego</a>
               </li>
               <li>
                 <a href="consultar_estudiantes_contra.php">Cambiar contraseña</a>
               </li>
             </ul>
           </li>
         </ul>
         <ul class="list-unstyled">
             <li>
             <a href="#exampledropdownDropdown3" aria-expanded="false" data-toggle="collapse">
               <i class="fa fa-cogs"></i>Mantenimiento </a>
             <ul id="exampledropdownDropdown3" class="collapse list-unstyled ">
               <li>
                 <a href="#">Exportar Base de datos</a>
               </li>
               <li>
                 <a href="#">Importar Base de datos</a>
               </li>
             </ul>
           </li>
           </ul>
       </nav>
       <div class="content-inner">
                 <!-- Header de la pagina-->
                 <header class="page-header">
             <div class="container-fluid">
               <h2 class="no-margin-bottom">Registrar asistencia</h2>
             </div>
           </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Registrar asistencia</li>
            </ul>
          </div>

    <div class="container-fluid" style="margin-top: 1rem;">
      <p>*Marque el checkbox de los estudiantes que asistieron y posteriormente pulse el boton de cargar asistencia</p>
    </div>

 <div class="d-flex p-4 m-4 justify-content-center bg-white">          
            <table class="table table-striped table-bordered text-center">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Apellido</th>
                          <th>Cedula</th>
                          <th>Acreditable</th>
                          <th>Tipo</th>
                          <th>Sección</th>
                          <?php
                            // Saber fecha de hoy
                            $fecha_actual = date('d-m-Y'); 
                          ?>
                          <th>Cargar asistencia  <?php echo $fecha_actual ?></th>
                      </tr>
                  </thead>
                  <form method="POST" action="consulta_asistencia.php">
                  <tbody>
                      <?php 
                          $i=1;
                          $asistencia=$_REQUEST["id"];
                          foreach($resultado as $dato):
                         if($asistencia==$dato["id_acreditable"]){
                      ?>
                              <tr>
                                  <th scope="row"><?php echo $i++ ?>
                                  <input type="hidden" name="inscripcion" value="<?php echo $dato["id"] ?>">
                                </th>
                                  <td><?php echo $dato["nombre"] ?></td>
                                  <td><?php echo $dato["apellido"] ?></td>
                                  <td><?php echo $dato["cedula"] ?></td>
                                  <td><?php echo $dato["acreditable"] ?></td>
                                  <td>Acreditable <?php echo $dato["tipo"] ?></td>
                                  <td>Sección <?php echo $dato["seccion"] ?></td>
                                  <td>
                                      <input type="checkbox" style="width:20px;height:20px" id="asistencia<?php echo $dato["id"] ?>">
                                      <input type="hidden" name="asistio[]" value="2" id="cambiame<?php echo $dato["id"] ?>"] ?>
                                      <!-- <input type="checkbox" name="asistio" style="width:20px;height:20px"> -->
                                  </td>
                              </tr>
 <!-- SCRIPT PARA CAMBIAR EL VALOR DE LA ASISTENCIA                               -->
<script>
  $(document).ready(function(){
      
      $("#asistencia<?php echo $dato["id"] ?>").on("click", function(){
          $("#cambiame<?php echo $dato["id"] ?>").val("1");
      });

  });
</script>
                      <?php 
                      }
                          endforeach 
                      ?>
                  </tbody>
                  <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th><button class="btn btn-primary" type="submit">Cargar Asistencia</button></th>
            </tr>
        </tfoot>
                </form>
             </table>
         
      </div>
 
 <?php include("maquetacion/footer.php"); ?>

</body>

</html>





<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php 
  if($_POST){
    include_once 'conexion/conexion.php';

    $id_inscripcion = $_POST["inscripcion"];
    $asistio        = $_POST["asistio"];
    $fecha_actual = date("Y-m-d");

    echo $fecha_actual;

    $n=count($id_inscripcion);


    for($i=0; $i<$n; $i++) 
    {       





      $sql = "INSERT INTO asistencia(id_inscripcion, asistencia, fecha_asistencia) VALUES ($id_inscripcion, $asistio[$i], '$fecha_actual')";

      $agregar = $conexion->prepare($sql);
      $agregar->execute();  
      
      if($agregar){

?>
                <script>
                    $(document).ready(function(){
                        $("#enviar").attr("disabled", true);
                        $("body").overhang({
                            type: "success",
                            message: "Asistencia registrada",
                            duration: 2,
                            callback: function(){
                                window.location.href = "mostrar_consulta_asistencia.php";
                            }            
                        });
                    })
                </script>

                <?php
      }
    }

  }
  
?>