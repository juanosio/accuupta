<?php
session_start();

    include_once '../../conexion/conexion.php';
    include_once '../../conexion/conexion2.php';

    $estudiante= $_SESSION["usuario"]["id_estudiante"];
      
    $sqlestu       = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
    $setenciaestu = $conexion2->prepare($sqlestu);
    $setenciaestu->execute(array($estudiante));
    $datos_estudiante = $setenciaestu->fetch();

    
    $sql="SELECT * FROM acreditables";
    $gsent= $conexion->prepare($sql);
    $gsent->execute();

    $resultado = $gsent->fetchAll();

?>
    
<?php include("maquetacion/head.php"); ?>

<script type="text/javascript">

        function eliminar(id) {
            //  if (confirm("¿Seguro que desea eliminar esta acreditable?")) {
                // 	 	window.location="trabajo/eliminar.php?id="+id;
                // 	}
                    $(document).ready(function(){


        var snapchatIcon = '<i class="fa fa-trash-o"></i>';
        var snapchatNote = ' Seguro desea eliminar esta acreditable? ';

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
             window.location.href = "acreditableI.php?id="+id;
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
            <h1 class="h4">Administrador</h1>
            <p><?php echo $datos_estudiante["nom_est"]; echo " "; echo $datos_estudiante["ape_est"] ?></p>
          </div>
        </div>

        <!-- Opciones menu lateral-->
        <span class="heading">Menú</span>
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
           <li>
             <a href="mostrar_consulta_asistencia.php">
               <i class="fa fa-calendar-check-o"></i>Control de Asistencia </a>
           </li>
           <li class="active">
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
              <h2 class="no-margin-bottom">Acreditables aperturadas</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Acreditables aperturadas</li>
              <!-- <li class="breadcrumb-item active">Acreditables I</li> -->
            </ul>
        </div>
        <!-- FIN DEL HEADER -->


        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts no-padding-bottom"></section>
        <div class="container-fluid d-flex">
            <div class="row d-flex flex-row">
                <?php 
                foreach($resultado as $dato): 
                  if($dato["estado"]==2){
                    
                  }else{

                            
   
                  ?>
                <div class="col-sm">
                        

                        <div class="card" style="width: 19rem;">
                                <img class="card-img-top" src="../../img/<?php echo $dato["imagen"] ?>" alt="Acreditable de <?php echo $dato['acreditable'] ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $dato["nombre_acre"]; echo " "; echo $dato["tipo"]; ?>
                                </h5>
                                
                            </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Prof: <?php echo $dato["profesor"] ?></li>
                                    <li class="list-group-item">Seccion: <?php echo $dato["seccion"] ?></li>
                                    <li class="list-group-item">Horario: <?php echo $dato["horario"] ?></li>
                                    <li class="list-group-item">Fecha de inicio: <?php echo $fechaBD = date("d-m-Y", strtotime($dato["fecha_inicio"])); ?></li>
                                </ul>
                            <div class="card-body">
                                <!-- Boton modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="recibir(<?php echo $dato["id"] ?>);">
                                <i class="fa fa-list-alt"></i>
                                </button>
                                <input type="hidden" id="<?php echo $dato["id"] ?>" value="<?php echo $dato["id"] ?>" />
                                <a title="Modificar" href="modificar_acreditable.php?id=<?php echo $dato["id"] ?>" class="btn btn-warning"> <i class="fa fa-edit"></i> </a>
                                <a title="Eliminar" href="javascript:eliminar(<?php echo $dato["id"] ?>)" class="btn btn-danger"> <i class="fa fa-trash-o"></i> </a>

                            </div>
                        </div>
                    </div>

                <?php 
                  }
                endforeach ?>

                             <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-uppercase" id="exampleModalCenterTitle">Inscripción de Acreditable</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            
                                        <!-- Contenido del modal -->
                                            <div class="container">
                                                <div class="row">
                                                    <!-- Informacion relevante -->
                                                    <div class="col-lg">
                                                                INFORMACION RELEVANTE
                                                    </div>
                                                            <!-- Formulario -->
                                                        
                                                            
                                                            <div class="col-lg">

                                                            <form method="POST" class="form-horizontal" action="acreditableI.php" autocomplete="off">
                                                            <input type="hidden" name="id_acreditable" id="codigo"/>
                                                              <div class="form-group">
                                                                <label for="exampleFormControlInput1">PNF</label>
                                                                <input type="text" class="form-control" name="pnf" id="exampleFormControlInput1" placeholder="A que PNF perteneces">
                                                              </div>
                                                              <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Turno</label>
                                                                <select class="form-control" name="turno" id="exampleFormControlSelect1">
                                                                  <option value="diurno">Diurno</option>
                                                                  <option value="nocturno">Nocturno</option>
                                                                </select>
                                                              </div>

                                                              <div class="form-group">
                                                                <label for="exampleFormControlSelect1">Trayecto</label>
                                                                <select class="form-control" name="trayecto" id="exampleFormControlSelect1">
                                                                  <option value="I">Trayecto I</option>
                                                                  <option value="II">Trayecto II</option>
                                                                  <option value="III">Trayecto III</option>
                                                                  <option value="IV">Trayecto IV</option>
                                                                  <option value="V">Trayecto V</option>
                                                                </select>
                                                              </div>

                                                              
                                                              <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Direccion</label>
                                                                <textarea name="direccion" class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
                                                              </div>
                                                              <input type="submit" id="enviar" value="Inscribirse" class="btn btn-primary">
                                                            
                                                            </form>
                                                            </div>
                                                </div>
                                            </div> <!-- Fin Contenido del modal-->
                                        
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                    </div>
                                </div>
                            </div> <!--Final modal-->



                </div>
            </div>
        </section>

<?php include("maquetacion/footer.php"); ?>



<!-- FUNCION PARA CAPTURAR EL ID EN EL MODAL -->
  <script> 
        function recibir(numero)
        {
            var valor = document.getElementById(numero).value;
            document.getElementById("codigo").value=valor;        
            
        } 
  </script>

</body>
</html>

<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php
    if($_GET){
        $id       = $_GET["id"];

        $sql      = "UPDATE acreditables SET estado=2 WHERE id=?";
        $eliminar = $conexion->prepare($sql);
        $eliminar->execute(array($id));
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
                                window.location.href = "acreditableI.php";
                            }            
                        });
                    })
                </script>    
            <?php
        }
      }


      if($_POST){
          $pnf=$_POST["pnf"];
          $turno=$_POST["turno"];
          $trayecto=$_POST["trayecto"];
          $direccion=$_POST["direccion"];
          $id_acreditable=$_POST["id_acreditable"];
      
          $sql="INSERT INTO estudiantes (pnf, turno, trayecto, direccion, id_acreditable) VALUES ('$pnf', '$turno', '$trayecto', '$direccion', $id_acreditable)";
          $agregar = $conexion->prepare($sql);
          $agregar->execute();

          if($agregar){
              ?>
                <script>
                    $(document).ready(function(){
                        document.getElementById("enviar").value = "Inscribiendo...";
                        $("#enviar").attr("disabled", true);
                        $("body").overhang({
                            type: "success",
                            message: "Felicidades te has inscrito!",
                            duration: 1,
                            callback: function(){
                                window.location.href = "index.php";
                            }            
                        });
                    })
                </script>
              
              <?php
                  }else{
                      echo "No te inscribiste";
                  }
              

                //    Cierro conexion con bd 
                $conexion=null;
                $agregar=null;

      }





?>