<?php 
    session_start();
    include("maquetacion/head.php");

    include_once '../../conexion/conexion.php';

     include_once '../../conexion/conexion2.php'; 


    $datos_estudiante= $_SESSION["usuario"]["id_estudiante"];

        
    $sqlestu       = "SELECT nom_est, ape_est FROM estudiantes WHERE id = ?";
    $setenciaestu = $conexion2->prepare($sqlestu);
    $setenciaestu->execute(array($datos_estudiante));
    $datos_estudiante = $setenciaestu->fetch();
    
    $sql="SELECT acreditables.id, acreditables.nombre_acre FROM acreditables";
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
               <h2 class="no-margin-bottom">Asistencia de estudiantes</h2>
             </div>
           </header>
            <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Registrar asistencia</li>
              <li class="breadcrumb-item active">Asistencia de estudiantes</li>
            </ul>
          </div>



         <!-- Aqui codigo para rellenar -->

         <!-- /**************************************************************/ -->
         <div class="d-flex p-4 m-4 justify-content-center bg-white">
	<form action="controlador_asistencia.php" method="POST">


		<label>Clase</label>
		<select name="clase">

			<?php

			if (isset($clase)) {
				$sql="SELECT id, acreditable FROM acreditables WHERE id='$clase'";
				$resultado=mysqli_query($conexion, $sql);
				$fila=mysqli_fetch_assoc($resultado);
				?>
				<option value="<?php echo $clase; ?>"><?php echo $fila['acreditable']; ?></option>
				<?php
			} else {
				?>
				<option value="">Seleccione</option>
				<?php
			}

			$sql="SELECT * FROM acreditables";
			$resultado=mysqli_query($conexion, $sql);
			while ($row=mysqli_fetch_assoc($resultado)) {
				?>
				<option value="<?php echo $row['id']?>">
					<?php
					echo $row['acreditable'];
					?>
				</option>;
				<?php
			}
			?>
		</select>


		<label for="exampleInputName">Fecha Inicial</label>
		<input class="form-cajas" name="fecha_inicio" type="date" value="<?php echo $inicio; ?>">

		<label for="exampleInputName">Fecha Final</label>
		<input class="form-cajas" name="fecha_final" type="date" value="<?php echo $final; ?>">


		<input type="submit" name="buscar" value="Buscar">


	</form>

 
          </div>


<?php
/******///
$clase=$_POST["clase"];
$inicio=$_POST["fecha_inicio"];
$final=$_POST["fecha_final"];
include('conexionA.php');

?>
<!-- //////////////////////////////////////////////////////////////////////// -->

          <div class="d-flex p-4 m-4 justify-content-center bg-white">
<?php

	if (isset($clase) && isset($inicio) && isset($final) && isset($vacio)) {
		echo $vacio;
	} elseif (isset($clase) && isset($inicio) && isset($final)) {

		?>

		<table id="customers" class="table table-striped table-bordered text-center" cellspacing="0">
			<thead>
				<tr>
					<td>#</td>
					<td>Nombre y Apellido</td>
					<td>Cedula</td>
					<?php								
					$sql="SELECT asistencia.fecha_asistencia, inscripcion.id_acreditable FROM asistencia, inscripcion WHERE asistencia.id_inscripcion=inscripcion.id AND inscripcion.id_acreditable='$clase' AND asistencia.fecha_asistencia BETWEEN '$inicio' AND '$final' GROUP BY asistencia.fecha_asistencia ASC";
					$resultado=mysqli_query($conexion, $sql);
					while($fila=mysqli_fetch_assoc($resultado)) {
						?>
						<td><?php echo $fila['fecha_asistencia']; ?></td>
						<?php
					}
					$num=$resultado->num_rows;
					?>
				</tr>
			</thead>
			<tbody>


				<?php
				$sql="SELECT usuarios.nombre, usuarios.apellido, usuarios.cedula, inscripcion.id_acreditable, inscripcion.id FROM inscripcion, acreditables, usuarios, estudiantes WHERE inscripcion.id_acreditable=acreditables.id AND inscripcion.id_estudiante=estudiantes.id AND estudiantes.id_usuarios=usuarios.id AND inscripcion.id_acreditable='$clase' ORDER BY inscripcion.id ASC";
				$resultado=mysqli_query($conexion, $sql);
				$nume=1;

				while ($fila=mysqli_fetch_assoc($resultado)) {
					?>
					<tr>
						<td><?php echo $nume; ?></td>
						<td><?php echo $fila['nombre']." ".$fila['apellido']; ?></td>
						<td><?php echo $fila['cedula']; ?></td>
						<?php
						$id=$fila['id'];
						$sql1="SELECT inscripcion.id_acreditable, asistencia.fecha_asistencia, asistencia.asistencia, asistencia.id_inscripcion FROM asistencia, inscripcion WHERE asistencia.id_inscripcion=inscripcion.id AND inscripcion.id_acreditable='$clase' AND asistencia.id_inscripcion='$id' ORDER BY asistencia.fecha_asistencia ASC LIMIT $num";
						$resultado1=mysqli_query($conexion, $sql1);
						while ($fila1=mysqli_fetch_assoc($resultado1)) { 
							if ($fila1['asistencia']=='2') {
								?>
								<td>Asistente</td>
								<?php
							} elseif ($fila1['asistencia']=='1') {
								?>
								<td>Inasistente</td>
								<?php
							}
						}


						?>
					</tr>
					<?php
					$nume++;
				}
				?>
			</tbody>
		</table>

		<?php

		//$boton="<a href='index.php?view=modificar-asistencia&clase=".$clase."&inicio=".$inicio."&final=".$final."&num=".$num."'><button>Modificar</button></a>";

		//echo $boton;

	}

	?>



          </div>
 
 <?php include("maquetacion/footer.php"); ?>

</body>

</html>



	