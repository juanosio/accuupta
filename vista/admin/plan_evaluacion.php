<?php 
    session_start();
    include("maquetacion/head.php");

    include_once '../../conexion/conexion.php';
    include_once '../../conexion/conexion2.php';
  
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
           <li class="active">
             <a href="evaluacion.php">
               <i class="fa fa-tasks"></i>Plan de Evaluación </a>
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
              <h2 class="no-margin-bottom">Plan de Evaluación</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Plan de Evaluación</li>
            </ul>
          </div>


  <script>
			
      $(function(){
  $("#adicional").on('click', function() {
    var seleccion = $('#tabla tbody tr').last();
    var num = +seleccion.find('input#evaluacion').attr('value').split(' ')[1];

    var nuevoElemento = seleccion.clone().removeClass('fila-fija')
    nuevoElemento.appendTo("#tabla");
    nuevoElemento.find('input#evaluacion').attr('value','Evaluacion ' + (num + 1)) 
  });

  $(document).on("click",".eliminar",function(){
    var parent = $(this).parents().get(0);
    $(parent).remove();
  });
});
  </script>

<!-- Recibir el id de la acreditable -->
<?php $id=$_GET["id"]; ?>

        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts">
          <div class="container-fluid ">
            <div class="row bg-white">
                <form method="post" action="plan_evaluacion.php">
                <div class="col-sm-12 ">
                        <div class="panel-heading mb-4">
                                <h3 class="panel-title">Registrar plan de evaluación</h3>
                                <button id="calcular" type="button" class="btn btn-info">Calcular porcentaje</button>
                              <input type="text" name="id_acreditable" value="<?php echo $id ?>">
                            </div>

			
      <table class="table table-striped"  id="tabla">

        <thead>
          <tr class="fila-fija">
            <td>Evaluación</td>
            <td>Ponderación</td>
            <td>Actividad a realizar</td>
            <td></td>
          </tr>
        </thead>
              
        <tbody>
          <tr class="fila-fija">
            <td><input type="text" name="evaluacion[]" id="evaluacion" class="input-add form-control" value="Evaluacion 1"  /></td>
            <td>
              <select class="form-control" id="ponderacion" name="ponderacion[]">
                  <option value="5">5%</option>
                  <option value="10">10%</option>
                  <option value="15">15%</option>
                  <option value="20">20%</option>
                  <option value="25">25%</option>
                  <option value="30">30%</option>
              </select>
            </td>
            <td><input type="text" name="actividad[]" class="form-control" placeholder="Actividad que se realizara"/></td>
        
            <td class="eliminar"><input type="button" class="btn btn-danger" value="Menos -"/></td>
          </tr>
        </tbody>
      </table>

				<div class="btn-der">
					<input type="submit" disabled id="enviar" name="insertar" value="Registrar" class="btn btn-primary"/>
					<button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más + </button>
				</div>
			</form>

      
      
      <script>
      $('#calcular').on('click', function(){
    
     var result = 0;

    $('select').each(function(){   
      
      result += ($(this).val())*1
     

     });

     if (result>100){
      $('#enviar').attr("disabled", true);
      $("body").overhang({
          type: "error",
          message: "Las actividades planteadas suman más del 100%",
          closeConfirm: true,       
          duration: 2,
        });
       
    $(".fila-fija").remove();
     }else{ if(result<100){
      $('#enviar').attr("disabled", true);
        $("body").overhang({
          type: "error",
          message: "Las actividades planteadas no suman 100%",
          closeConfirm: true,       
          duration: 2,
        });
     }else{ if(result==100){
      $('#enviar').attr("disabled", false);
      $("body").overhang({
          type: "success",
          message: "Las actividades tienen una ponderacion correcta, pulse registrar para proseguir",
          duration: 3,           
      });
     }
  }};
   });
  
      </script>

            </div>
        </div>
        </section>


<?php include("maquetacion/footer.php"); ?>


<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php

				//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
				if(isset($_POST['insertar']))

				{

          include_once '../../conexion/conexion.php';

        $id_acreditable=$_POST["id_acreditable"];
				$items1 = ($_POST['evaluacion']);
				$items2 = ($_POST['ponderacion']);
        $items3 = ($_POST['actividad']);
        $n=count($items1);


        for($i=0; $i<$n; $i++) 
        { 
          $valores='("'.$id_acreditable.'","'.$items1[$i].'","'.$items2[$i].'","'.$items3[$i].'"),';

          $valoresQ= substr($valores, 0, -1);

          $sql = "INSERT INTO plan_evaluacion(id_acreditable, evaluacion, ponderacion, actividad) 
          VALUES $valoresQ";
    
          $agregar = $conexion->prepare($sql);
          $agregar->execute();  
        
        } //Cierre ciclo

        if($agregar){
          ?>
                    <script>
                    $(document).ready(function(){
                        $("body").overhang({
                            type: "success",
                            message: "Plan de evaluación asignado correctamente",
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

			?>
</body>

</html>