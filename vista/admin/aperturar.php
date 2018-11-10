<?php 
  include("maquetacion/head.php");
  session_start();

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
           <li class="active">
                 <a href="aperturar.php"> 
                     <i class="fa fa-plus-square"></i>Aperturar acreditable 
                 </a>
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
           <li>
             <a href="#exampledropdownDropdown2" aria-expanded="false" data-toggle="collapse">
               <i class="fa fa-users"></i>Usuarios Registrados </a>
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
              <h2 class="no-margin-bottom">Aperturar acreditable</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item active">Aperturar acreditable</li>
            </ul>
          </div>


        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts">
          <div class="container-fluid ">
            <div class="row bg-white">
                <div class="col-sm-8 ">
                        <div class="panel-heading mb-4">
                                <h3 class="panel-title">Aperturar nueva acreditable</h3>
                            </div>

                    <form id="new_acreditable" method="POST" class="form-horizontal" action="aperturar.php" autocomplete="off" enctype="multipart/form-data">
                      <div class="form-group mb-4">
                        <label class="control-label" for="acreditable">Imagen para la acreditable</label>
                        <div class="">
                            <input type="file" class="form-control" id="acreditable" name="imagen" title="soy una imagen"/>
                        </div>
                      </div>  
                      
                       <div class="form-group mb-4">
                            <label class="control-label" for="acreditable">Nombre acreditable</label>
                            <div class="">
                                <input type="text" class="form-control" id="acreditable" name="acreditable" placeholder="Introduce el nombre de la acreditable" />
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="exampleFormControlSelect1">Tipo de acreditable</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="tipo">
                                <option value="I">Acreditable I</option>
                                <option value="II">Acreditable II</option>
                                <option value="III">Acreditable III</option>
                                <option value="IV">Acreditable IV</option>
                                <option value="V">Acreditable V</option>
                            </select>
                        </div>

                        <div class="form-group mb-4">
                            <label for="exampleFormControlSelect1">Sección</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="seccion">
                                <option value="1">Sección 1</option>
                                <option value="2">Sección 2</option>
                                <option value="3">Sección 3</option>
                            </select>
                        </div>

                        <div class="form-row d-flex align-items-center">
                        
                            <div class="form-group col-md-3">
                              <label for="inputCity">Horario</label>
                              <input type="text" placeholder="00:00" class="form-control" id="inputCity" name="horario_inicio">
                            </div>
                            <div class="form-group col-md-2">
                              <label for="inputState"></label>
                              <select id="inputState" class="form-control" name="horario1">
                                <option value="am" selected>am</option>
                                <option value="pm">pm</option>
                              </select>
                            </div>

                        </div>

                        <div class="form-group mb-4">
                            <label class="control-label" for="fecha_inicio">Fecha de inicio</label>
                            <div class="">
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="cupo">Cupos Dispobibles</label>
                            <div class="">
                                <input type="number" class="form-control" id="cupo" name="cupo" placeholder="Cantidad de cupos" />
                            </div>
                        </div>

                          <div class="form-group">
                            <label for="descripcion">Descripción de la acreditable</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3"></textarea>
                          </div>

                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary" id="enviar" value="Signup">Aperturar</button>
                                <a href="index.php" class="btn btn-danger">Cancelar</a>
                            </div>
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

            $acreditable    = $_POST["acreditable"];
            $tipo           = $_POST["tipo"];
            $profesor       = $_POST["profesor"];
            $seccion        = $_POST["seccion"];
            $descripcion    = $_POST["descripcion"];
            $fecha_inicio   = $_POST["fecha_inicio"];
            $cupo           = $_POST["cupo"];
            $horario_ini = $_POST["horario_inicio"];
            $horario1       = $_POST["horario1"];
            $horario_inicio = $horario_ini." ".$horario1;

            //Recibo imagen
            $nombre_imagen  = $_FILES["imagen"]["name"];
            $tipo_imagen    = $_FILES["imagen"]["type"];
            $tamanio_imagen = $_FILES["imagen"]["size"];
            
            if($tamanio_imagen<=2500000){
                if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/png" || $tipo_imagen=="image/jpg"){
                // Ruta destino
                $destino=$_SERVER["DOCUMENT_ROOT"].'/proyectos/accuupta/img/';
                // Mover imagen de carpeta temporal al directorio escogido
                move_uploaded_file($_FILES["imagen"]["tmp_name"],$destino.$nombre_imagen);
                }else{
                    ?>
                    <script>
                        $(document).ready(function(){
                            $("body").overhang({
                                type: "error",
                                message: "Solo se pueden subir imagenes: JPG - PNG- JPEG",
                                closeConfirm: true,       
                                duration: 3,
                                callback: function(){
                                window.location.href = "apeturar.php";
                            } 
                            });
                        })
                    </script>

                <?php 
                }
            }else{
                ?>
                    <script>
                        $(document).ready(function(){
                            $("body").overhang({
                                type: "error",
                                message: "Archivo muy pesado",
                                closeConfirm: true,       
                                duration: 2,
                                callback: function(){
                                window.location.href = "apeturar.php";
                            } 
                            });
                        })
                    </script>

                <?php
            }

            $sql     = "INSERT INTO acreditables (nombre_acre, tipo, profesor, seccion, horario, fecha_inicio, cupo, imagen, descripcion, estado) VALUES (?,?,?,?,?,?,?,?,?,?)";
            $agregar = $conexion->prepare($sql);
            $agregar->execute(array($acreditable, $tipo, $profesor, $seccion, $horario_inicio, $fecha_inicio, $cupo, $nombre_imagen, $descripcion, 2 ));

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