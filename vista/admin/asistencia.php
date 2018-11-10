<?php 
    session_start();
    include("maquetacion/head.php");

    include_once 'conexion/conexion.php';
    
    $sql="SELECT inscripcion.id, inscripcion.id_acreditable, acreditables.acreditable, acreditables.tipo, acreditables.seccion FROM inscripcion, acreditables WHERE inscripcion.id_acreditable=acreditables.id";
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

 <div class="d-flex p-4 m-4 justify-content-center bg-white">

          
           
    <script>
        $(document).ready(function() {
        $('#Tablausuarios').DataTable({
            "language": {
            "url": "../../vendor/datatable/js/traduccion.json"
            }
        });
        });    
    </script>
            <table id="Tablausuarios" class="table table-striped table-bordered text-center">
                  <thead>
                      <tr>
                          <th>#</th>
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
                  <tbody>
                      <?php 
                          $i=1;
                          foreach($resultado as $dato):
                      ?>
                              <tr>
                                  <th scope="row"><?php echo $i++ ?></th>
                                  <td><?php echo $dato["acreditable"] ?></td>
                                  <td>Acreditable <?php echo $dato["tipo"] ?></td>
                                  <td>Sección <?php echo $dato["seccion"] ?></td>
                                  <td> <a href="consulta_asistencia.php?id=<?php echo $dato["id_acreditable"] ?>" title="Registrar asistencia"><i class="fa fa-check-square-o fa-lg"></i></a> </td>
                              </tr>
                      <?php 
                          endforeach 
                      ?>
                  </tbody>
             </table>
         
      </div>
 
 <?php include("maquetacion/footer.php"); ?>

</body>

</html>