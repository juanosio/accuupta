<?php 
    session_start();
    include("maquetacion/head.php");

    if(isset($_SESSION["usuario"])){
      
      if($_SESSION["usuario"]["privilegio"]==2){
        header("Location: ../estudiante/index.php");

      }else if($_SESSION["usuario"]["privilegio"]==3){
          header("Location: ../becario/index.php");

      }else if($_SESSION["usuario"]["privilegio"]==3){
          header("Location: ../profesor/index.php"); 
          
      }

    }else{
        header("Location: ../login.php");
    }

    $datos_estudiante= $_SESSION["usuario"]["id_estudiante"];

    // TRAER DATOS
    include_once("../../conexion/conexion2.php");
        
    $sql       = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
    $sentencia = $conexion2->prepare($sql);
    $sentencia->execute(array($datos_estudiante));
    $resultado = $sentencia->fetch();

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
             <p><?php echo $resultado["nom_est"]; echo " "; echo $resultado["ape_est"] ?></p>
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
               <i class="fa fa-tasks"></i>Plan de evaluación </a>
           </li>
           <li>
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
                 <!-- Header de la pagina-->
                 <header class="page-header">
             <div class="container-fluid">
               <h2 class="no-margin-bottom">Inicio</h2>
             </div>
           </header>

         <!-- Aqui codigo para rellenar -->
         <section class="dashboard-counts no-padding-bottom">
 
           <div class="container-fluid">
 
             <div class="jumbotron">
               <h1 class="display-5"><strong>¡Bienvenido,</strong> <?php echo $resultado["nom_est"]; echo " "; echo $resultado["ape_est"]; echo "!"?></h1>
               <p class="lead">Privilegio | <span class="text-success"> <?php echo $_SESSION["usuario"]["privilegio"]==1 ? 'Administrador' : 'Usuario'; ?> </span>  </p>
               <hr class="my-4">
               <p>ACREDITABLES UPTAFBF. La educación universitaria es un espacio para la promoción y la práctica de actividades artísticas, deportivas, culturales, ambientalistas y comunitarias.</p>
               <a class="btn btn-primary btn-lg" href="../../conexion/cerrar_sesion.php" role="button">Cerrar Sesión</a>
             </div>
 
           </div>
         </section>
 
 <?php include("maquetacion/footer.php"); ?>

</body>

</html>