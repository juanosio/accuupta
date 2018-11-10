<?php 
session_start();

    include_once '../../conexion/conexion.php';
    include_once '../../conexion/conexion2.php';
    include("maquetacion/head.php");


    $estudiante= $_SESSION["usuario"]["id_estudiante"];
      
    $sqlestu       = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
    $setenciaestu = $conexion2->prepare($sqlestu);
    $setenciaestu->execute(array($estudiante));
    $datos_estudiante = $setenciaestu->fetch();


    $id    = $_GET["id"];

    $sql   = "SELECT * FROM acreditables WHERE id=?";
    $gsent = $conexion->prepare($sql);
    $gsent->execute(array($id));

    $resultado = $gsent->fetch();

?>

<body>
  <div class="page">
    <!-- Navegacion principal-->
    <header class="header">
      <nav class="navbar">
        <div class="container-fluid">
          <div class="navbar-holder d-flex align-items-center justify-content-between">
            <!-- Header - Navegacional-->
            <div class="navbar-header">
              <!-- Nav Superior -->
              <a href="index.html" class="navbar-brand d-none d-sm-inline-block">
                <div class="brand-text d-none d-lg-inline-block">
                  <span>Acreditables</span>
                  <strong> UPTAFBF</strong>
                </div>
                <div class="brand-text d-none d-sm-inline-block d-lg-none">
                  <strong>Acreditables</strong>
                </div>
              </a>
              <!-- Boton Toggle -->
              <a id="toggle-btn" href="#" class="menu-btn active">
                <span></span>
                <span></span>
                <span></span>
              </a>
            </div>
            <!-- Navegacion Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Configuracion de cuenta    -->
              <li class="nav-item dropdown">
                <a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  class="nav-link dropdown-toggle">
                  <span class="d-none d-sm-inline-block">Configurar</span>
                </a>
                <ul aria-labelledby="languages" class="dropdown-menu">
                  <li>
                    <a rel="nofollow" href="#" class="dropdown-item"> Actualizar datos</a>
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
      <!-- Menu lateral -->
      <nav class="side-navbar">

        <!-- cabezera menu lateral -->
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
           <li>
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
        <!-- Header de la pagina -->
        <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Modificación de acreditable</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Modificar acreditable</li>
            </ul>
          </div>


        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts">
          <div class="container-fluid ">
            <div class="row bg-white">
                <div class="col-sm-8 ">
                        <div class="panel-heading mb-4">
                                <h3 class="panel-title">Modificar acreditable</h3>
                            </div>

                    <form id="new_acreditable" method="POST" class="form-horizontal" action="modificar_acreditable.php" autocomplete="off">
                        <div class="form-group mb-4">
                            <label class="control-label" for="acreditable">Nombre acreditable</label>
                            <div class="">
                                <input type="text" class="form-control" id="acreditable" name="acreditable" value="<?php echo $resultado["nombre_acre"] ?>" />
                            </div>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $resultado["id"]?>">

                        <div class="form-group mb-4">
                            <label for="exampleFormControlSelect1">Tipo de acreditable</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                <option value="I" <?php if ($resultado[2]=="I") { ?> selected="selected" <?php } ?> >Acreditable I</option>
                                <option value="II" <?php if ($resultado[2]=="II") { ?> selected="selected" <?php } ?> >Acreditable II</option>
                                <option value="III" <?php if ($resultado[2]=="III") { ?> selected="selected" <?php } ?> >Acreditable III</option>
                                <option value="IV" <?php if ($resultado[2]=="IV") { ?> selected="selected" <?php } ?> >Acreditable IV</option>
                                <option value="V" <?php if ($resultado[2]=="V") { ?> selected="selected" <?php } ?> >Acreditable V</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="exampleFormControlSelect1">Sección</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="seccion">
                                <option value="1" <?php if ($resultado[4]=="1") { ?> selected="selected" <?php } ?> >Sección 1</option>
                                <option value="2" <?php if ($resultado[4]=="2") { ?> selected="selected" <?php } ?> >Sección 2</option>
                                <option value="3" <?php if ($resultado[4]=="3") { ?> selected="selected" <?php } ?> >Sección 3</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label class="control-label" for="horario">Horario</label>
                            <div class="">
                                <input type="text" class="form-control" id="horario" name="horario" value="<?php echo $resultado["horario"] ?>"/>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="control-label" for="fecha_inicio">Fecha de inicio</label>
                            <div class="">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo $resultado["fecha_inicio"] ?>"/>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label class="control-label" for="profesor">Profesor asignado</label>
                            <div class="">
                                <input type="text" class="form-control" id="profesor" name="profesor" value="<?php echo $resultado["profesor"] ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="cupo">Cupos Dispobibles</label>
                            <div class="">
                                <input type="number" class="form-control" id="cupo" name="cupo" value="<?php echo $resultado["cupo"] ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary" name="signup1" value="Signup">Modificar</button>
                                <a href="index.php" class="btn btn-danger">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
        </section>


<?php include("maquetacion/footer.php"); ?>

</body>
</html>


<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php

    if($_POST){

      include_once("../conexion/conexion.php");

        $id           = $_REQUEST["id"];
        $acreditable  = $_REQUEST["acreditable"];
        $tipo         = $_REQUEST["tipo"];
        $profesor     = $_REQUEST["profesor"];
        $seccion      = $_REQUEST["seccion"];
        $horario      = $_REQUEST["horario"];
        $fecha_inicio = $_REQUEST["fecha_inicio"];
        $cupo         = $_REQUEST["cupo"];

        $sql    = "UPDATE acreditables SET nombre_acre=?, tipo=?, profesor=?, seccion=?, horario=?, fecha_inicio=?, cupo=? WHERE id=?";
        $editar = $conexion->prepare($sql);
        $editar->execute(array($acreditable, $tipo, $profesor, $seccion, $horario, $fecha_inicio, $cupo, $id));

        if($editar){
    ?>
                <script>
                    $(document).ready(function(){
                        $("#enviar").attr("disabled", true);
                        $("body").overhang({
                            type: "success",
                            message: "Acreditable modificada con exito!",
                            duration: 2,
                            callback: function(){
                                window.location.href = "acreditableI.php";
                            }            
                        });
                    })
                </script>
    
    <?php
        }
    }

    //    Cierro conexion con bd 
$conexion=null;
$editar=null;
    ?>