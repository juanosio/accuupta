<?php 
  include("maquetacion/head.php");
  session_start();

  include_once '../../conexion/conexion.php';
  include_once '../../conexion/conexion2.php';

  $estudiante= $_SESSION["usuario"]["id_estudiante"];
      
  $sqlestu      = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
  $setenciaestu = $conexion2->prepare($sqlestu);
  $setenciaestu->execute(array($estudiante));
  $datos_estudiante = $setenciaestu->fetch();

    $sql   = "SELECT * FROM acreditables";
    $gsent = $conexion->prepare($sql);
    $gsent->execute();
    $resultado = $gsent->fetchAll();

    $sqlprof  = "SELECT * FROM profesores";
    $setencia = $conexion2->prepare($sqlprof);
    $setencia->execute();
    $resultado_profesor = $setencia->fetchAll();
    
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
              <a href="index.php" class="navbar-brand d-none d-sm-inline-block">
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
               <i class="fa fa-tasks"></i>Plan de evaluación </a>
           </li>
           <li class="active">
             <a href="asignar-profesor.php">
               <i class="fa fa-user-plus"></i>Asignar profesor</a>
           </li>
           <li>
             <a href="notas.php">
               <i class="fa fa-book"></i>Control de notas </a>
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
               <i class="fa fa-users"></i>Usuarios registrados </a>
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
                 <a href="../respaldos-bd/backup.php">Exportar Base de datos</a>
               </li>
             </ul>
           </li>
           </ul>
      </nav>
      <div class="content-inner">
        <!-- Header de la pagina -->
        <header class="page-header">
            <div class="container-fluid">
              <h2 class="no-margin-bottom">Asignar profesor</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Asignar profesor</li>
            </ul>
          </div>


        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts">
          <div class="container-fluid ">
            <div class="row bg-white">
                <div class="col-sm-8 ">
                        <div class="panel-heading mb-4">
                                <h3 class="panel-title">Asignar profesor a una acreditable</h3>
                            </div>

                    <form id="new_acreditable" method="POST" class="form-horizontal" action="asignar-profesor.php">
                        <!-- Datos del profesor -->

                        <div class="form-group">
                            <label for="selectprof">Profesor</label>
                            <select class="form-control" name="id_profesor" id="selectprof">
                            <?php foreach($resultado_profesor as $profesor): ?>
                                    <option value="<?php echo $profesor['id'] ?>">
                                        <?php echo $profesor['nom_prof']; echo " "; echo $profesor['ape_prof']; echo " "; echo $profesor['ced_prof']; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="selectacreditable">Acreditable</label>
                            <select class="form-control" name="acreditable" id="selectacreditable" name="tipo">
                               <?php foreach($resultado as $key): ?>
                                    <option value="<?php echo $key['id'] ?>">
                                        <?php echo $key['nombre_acre']; echo " "; echo $key['tipo']; echo " Sección "; echo $key['seccion']; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>

                            <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary" id="enviar" value="Signup">Asignar</button>
                                <a href="index.php" class="btn btn-danger">Cancelar</a>
                            </div>
                    </form>
                </div>


            </div>
        </div>
        </section>


<?php include("maquetacion/footer.php"); ?>


<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php

    if($_POST){
        include_once '../../conexion/conexion.php';
        include_once '../../conexion/conexion2.php';
// Capturo id de acreditables y el profesor que la dara
    $profesor=$_POST["id_profesor"];
    $acreditable=$_POST["acreditable"];

    // Uso la id que llego del profesor para poder traer los datos del profesor de DACE
    $trae  = "SELECT * FROM profesores WHERE id=?";
    $datos = $conexion2->prepare($trae);
    $datos->execute(array($profesor));
    $datos_prof = $datos->fetch();

    // Aqui coloco en variables todos los campos que quiera guardar en mi bd del profesor
    $nom_prof = $datos_prof["nom_prof"];
    $ape_prof = $datos_prof["ape_prof"];
    $ced_prof = $datos_prof["ced_prof"];

  
    // guardo campos
    $sql     = "INSERT INTO profesores (id_acreditable, nombre, apellido, cedula) VALUES (?,?,?,?)";
    $agregar = $conexion->prepare($sql);
    $agregar->execute(array($acreditable, $nom_prof, $ape_prof, $ced_prof));

    if($agregar){
        ?>
        <script>
            $(document).ready(function(){
                document.getElementById("enviar").value = "Aperturando...";
                $("#enviar").attr("disabled", true);
                $("body").overhang({
                    type: "success",
                    message: "Acreditable aperturada con exito!",
                    duration: 2,
                    callback: function(){
                       window.location.href = "acreditableI.php";
                    }            
                });
            })
        </script>
        
        <?php
            }

                

    //    Cierro conexion con bd 
    $conexion = null;
    $agregar  = null;

    }

?>
</body>

</html>