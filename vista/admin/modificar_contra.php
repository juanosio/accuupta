<?php 

    session_start();

    include("maquetacion/head.php");

    include_once '../../conexion/conexion.php';
    
    include_once '../../conexion/conexion2.php';

  //$estudiante= $_SESSION["usuario"]["id_estudiante"];
      
    $datos_estudiante= $_SESSION["usuario"]["id_estudiante"];

        
    $sqlestu       = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
    $setenciaestu = $conexion2->prepare($sqlestu);
    $setenciaestu->execute(array($datos_estudiante));
    $datos_estudiante = $setenciaestu->fetch();

    $id=$_GET["id"];

    $sql="SELECT * FROM usuarios WHERE id=?";
    $gsent= $conexion->prepare($sql);
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
           <li class="active">
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
           <li class="active">
             <a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse">
               <i class="fa fa-users"></i>Estudiantes inscritos </a>
             <ul id="exampledropdownDropdown2" class="collapse list-unstyled ">
               <li>
                 <a href="consultar_estudiantes.php">Cambiar privilego</a>
               </li>
               <li class="active">
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
              <h2 class="no-margin-bottom">Modificiar Privilegio</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item">Estudiantes inscritos</li>
              <li class="breadcrumb-item active">Modificar Privilegio</li>
            </ul>
          </div>


        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts">
          <div class="container-fluid ">
            <div class="row bg-white">
                <div class="col-sm-8 ">
                        <div class="panel-heading">
                                <h3 class="panel-title">Modificar Privilegio</h3>
                            </div>

                    <form id="signupForm1" method="POST" class="form-horizontal" action="modificar_contra.php">
                        
                    <input type="hidden" name="id" value="<?php echo $resultado["id"]?>">
                    
                    <div class="form-group">
                            <label class="control-label" for="firstname1">Nombre</label>
                            <div class="">
                                <input type="text" class="form-control" id="firstname1" name="firstname1" value="<?php echo $datos_estudiante["nom_est"] ?>" disabled />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="lastname1">Apellido</label>
                            <div class="">
                                <input type="text" class="form-control" id="lastname1" name="lastname1" value="<?php echo $datos_estudiante["ape_est"] ?>" disabled />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="username1">Cedula</label>
                            <div class="">
                                <input type="text" class="form-control" id="username1" name="username1" value="<?php echo $resultado["cedula"] ?>" disabled />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password1">Contraseña Nueva</label>
                            <div class="">
                                <input type="password" class="form-control" id="password1" name="password1" placeholder="Introduce tu contraseña" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="confirm_password1">Repita la contraseña nueva</label>
                            <div class="">
                                <input type="password" class="form-control" id="confirm_password1" name="confirm_password1" placeholder="Confirma tu contraseña" />
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-4">
                                <button type="submit" id="enviar" class="btn btn-primary" name="signup1" value="Sign up">Actualizar</button>
                                <a href="consultar_estudiantes_contra.php" class="btn btn-secondary">Volver</a>
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
        $id     = $_POST["id"];
        $pass   = $_POST["confirm_password1"];

        $pass = password_hash($pass, PASSWORD_DEFAULT);

        $sql    = "UPDATE usuarios SET pass=? WHERE id=?";
        $editar = $conexion->prepare($sql);
        $editar->execute(array($pass, $id));

        if($editar){
            ?>
                <script>
                    $(document).ready(function(){
                        document.getElementById("enviar").value = "Actualizando datos...";
                        $("#enviar").attr("disabled", true);
                            $("body").overhang({
                                type: "success",
                                message: "Datos modificados con exito!",
                                duration: 2,
                                callback: function(){
                                    window.location.href = "index.php";
                                }            
                            });
                    })
                        </script>

            <?php
        }
    }
 //    Cierro conexion con bd 
    $conexion = null;
    $editar   = null;

?>