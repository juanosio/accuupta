<?php 
    session_start();
    include("maquetacion/head.php");

    if(isset($_SESSION["usuario"])){
        if($_SESSION["usuario"]["privilegio"]==1){
            header("Location: ../admin/index.php");
        }
    }else{
        header("Location: ../login.php");
    }

    // TRAER DATOS
    include_once("../../conexion/conexion2.php");
    $estudiante= $_SESSION["usuario"]["id_estudiante"];
      
    $sqlestu       = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
    $setenciaestu = $conexion2->prepare($sqlestu);
    $setenciaestu->execute(array($estudiante));
    $datos_estudiante = $setenciaestu->fetch();

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
             <a href="ver_inscripciones.php">
               <i class="fa fa-book"></i>Mis Acreditables </a>
           </li>
           <li>
             <a href="ver_notas.php">
               <i class="fa fa-trophy"></i>Mis notas </a>
           </li>
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
               <h1 class="display-5"><strong>¡Bienvenido,</strong> <?php echo $datos_estudiante["nom_est"]; echo " "; echo $datos_estudiante["ape_est"]; echo "!"?></h1>
               <p class="lead">Privilegio | <span class="text-success"> <?php echo $_SESSION["usuario"]["privilegio"]==1 ? 'Administrador' : 'Estudiante'; ?> </span>  </p>
               <hr class="my-4">
               <p>ACREDITABLES UPTAFBF. La educación universitaria es un espacio para la promoción y la práctica de actividades artísticas, deportivas, culturales, ambientalistas y comunitarias.</p>
               <a class="btn btn-primary btn-lg" href="../../conexion/cerrar_sesion.php" role="button">Cerrar Sesión</a>
             </div>
 
           </div>
         </section>
 
 <?php include("maquetacion/footer.php"); ?>
  
</body>

</html>