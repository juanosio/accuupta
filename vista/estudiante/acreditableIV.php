<?php

session_start();
include_once '../../conexion/conexion.php';
include_once("../../conexion/conexion2.php");
$estudiante= $_SESSION["usuario"]["id_estudiante"];
$info_extra= $_SESSION["usuario"]["cedula"];
  
$sqlestu       = "SELECT * FROM estudiantes WHERE id = ?";
$setenciaestu = $conexion2->prepare($sqlestu);
$setenciaestu->execute(array($estudiante));
$datos_estudiante = $setenciaestu->fetch();

// info adicional
$sqlinfoad       = "SELECT * FROM est_situacion WHERE ced_est = ?";
$infoadicional = $conexion2->prepare($sqlinfoad);
$infoadicional->execute(array($info_extra));
$info_adicional = $infoadicional->fetch();
    
$sql="SELECT * FROM acreditables";
$gsent= $conexion->prepare($sql);
$gsent->execute();

$resultado = $gsent->fetchAll();

$sqlnota   = "SELECT SUM(notas.nota) AS notafinal, notas.id_inscripcion, inscripcion.id_usuario FROM notas INNER JOIN inscripcion ON notas.id_inscripcion = inscripcion.id WHERE inscripcion.id_usuario=$estudiante";
$querynota = $conexion->prepare($sqlnota);
$querynota->execute();
$saber_nota = $querynota->fetch();

if(166>$saber_nota["notafinal"]){
  header("Location: index.php");
  die();
 }


?>
    
<?php include("maquetacion/head.php"); ?>

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
            <h1 class="h4">Estudiante</h1>
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
             <a href="ver_inscripciones.php">
               <i class="fa fa-book"></i>Mis Acreditables </a>
           </li>
           <li>
             <a href="ver_notas.php">
               <i class="fa fa-trophy"></i>Mis notas </a>
           </li>
          <!-- <li><a href="forms.html"> <i class="icon-padnote"></i>Forms </a></li> -->
          <li class="active">
            <a href="#exampledropdownDropdown" aria-expanded="false" data-toggle="collapse">
              <i class="fa fa-futbol-o"></i>Inscribir Acreditable </a>
            <ul id="exampledropdownDropdown" class="collapse list-unstyled ">
              <li>
                <a href="acreditableI.php">Acreditable I</a>
              </li>
              <li class="active">
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
              <h2 class="no-margin-bottom">Acreditables II</h2>
            </div>
          </header>
          <!-- Historial -->
          <div class="breadcrumb-holder container-fluid">
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="index.php">Inicio</a>
              </li>
              <li class="breadcrumb-item">Inscribir Acreditable</li>
              <li class="breadcrumb-item active">Acreditables III</li>
            </ul>
        </div>
        <!-- FIN DEL HEADER -->


        <!-- Aqui codigo para rellenar -->
        <section class="dashboard-counts no-padding-bottom"></section>
        <div class="container-fluid d-flex">
            <div class="row d-flex flex-row">
                
                <?php 
                foreach($resultado as $dato): 
                  if($dato["tipo"]=="III"){
                  ?>
                <div class="col-sm">                       
                        <div class="card" style="width: 19rem;">
                                <img class="card-img-top" src="../../img/<?php echo $dato["imagen"] ?>" alt="Foto de la acreditable de <?php echo $dato['nombre_acre'] ?>">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $dato["nombre_acre"]; echo " "; echo $dato["tipo"]; ?>
                                </h5>

                                <?php
                                    date_default_timezone_set('America/Caracas');
                                    // CAPTURO LA FECHA LIMITE DE HASTA CUANDO ESTARA APERTURADA
                                    $fecha_acreditable =$dato["fecha_inicio"];
                                    // COMPARO FECHA ACTUAL CON LA ENVIADA
                                    $fecha_actual = strtotime(date("Y-m-d H:i:s"));
                                    $fecha_limite = strtotime($fecha_acreditable);
                                    
                                        if($fecha_actual < $fecha_limite){
                                        ?>
                                          <p class="card-text alert-success">Cupos disponibles: <?php echo $dato["cupo"] ?></p>
                                       <?php   
                                        }else{
                                          ?>
                                          <p class="card-text alert-dark">Inscripciones cerradas</p>
                                      <?php
                                        }   
                                                     
                                ?>


                                
                                <input type="hidden" id="<?php echo $dato["id"] ?>" value="<?php echo $dato["id"] ?>" />
                            </div>
                                <ul class="list-group list-group-flush">
                                <li class="list-group-item">Prof: <?php echo $dato["profesor"] ?></li>
                                  <li class="list-group-item">Seccion: <?php echo $dato["seccion"] ?></li>
                                  <li class="list-group-item">Horario: <?php echo $dato["horario"] ?></li>

                                      <?php  if($fecha_actual < $fecha_limite){
                                        ?>
                                          <li class="list-group-item">Fecha de inicio: <?php echo $fechaBD = date("d-m-Y", strtotime($dato["fecha_inicio"])); ?></li>
                                       <?php   
                                        }else{
                                          $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");

                                          ?>
                                          <li class="list-group-item">Clases cada: <?php echo $fechaBD = $dias[ date("w", strtotime($dato["fecha_inicio"])) ]; ?></li>
                                      <?php
                                        }   
                                                     
                                ?>


                                  
                                </ul>
                            <div class="card-body">
                                <!-- Boton modal -->

                                  <!-- PARA VALIDAR FECHA DE INSCRIPCION -->
                                  <?php
                                    date_default_timezone_set('America/Caracas');
                                    // CAPTURO LA FECHA LIMITE DE HASTA CUANDO ESTARA APERTURADA
                                    $fecha_acreditable =$dato["fecha_inicio"];
                                    // COMPARO FECHA ACTUAL CON LA ENVIADA
                                    $fecha_actual = strtotime(date("Y-m-d H:i:s"));
                                    $fecha_limite = strtotime($fecha_acreditable);
                                    
                                        if($fecha_actual < $fecha_limite){
                                        ?>
                                        <button type="button" class="btn btn-outline-primary"  onclick="descripcion('<?php echo $dato['descripcion'];?>');">
                                          Saber más
                                        </button>
                                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" onclick="recibir(<?php echo $dato['id'] ?>);">
                                          Inscribirse
                                      </button>

                                       <?php   
                                        }else{
                                          ?>
                                      <button type="button" class="btn btn-light"  onclick="descripcion('<?php echo $dato['descripcion'];?>');">
                                          Saber más
                                      </button>
                                          <button type="button" class="btn btn-secondary" disabled>
                                          No disponible
                                      </button>
                                      <?php
                                        }   
                                                     
                                ?>

                            </div>
                        </div>
                    </div>
                                      <?php 
                                          } 
                                            endforeach 
                                        ?>

                             <!-- Modal de inscripcion -->
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
  
                                                            <!-- Formulario -->
                                                            <form action="acreditableI.php" method="POST" autocomplete="off">
                                                              <!-- id acreditable -->
                                                            <input type="hidden" name="id_acreditable" id="codigo"/>

                                                            <div class="form-row">
                                                              <div class="form-group col-md-6">
                                                              <label for="">Nombres</label>
                                                                  <input type="text" class="form-control" disabled id="disabled" value="<?php echo $datos_estudiante["nom_est"] ?>">
                                                                  <input type="hidden" class="form-control" id="disabled" name="nombre" value="<?php echo $datos_estudiante["nom_est"] ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                  <label for="">Apellidos</label>
                                                                  <input type="text" class="form-control" disabled id="disabled" value="<?php echo $datos_estudiante["ape_est"] ?>">
                                                                  <input type="hidden" class="form-control" id="disabled" name="apellido" value="<?php echo $datos_estudiante["ape_est"] ?>">
                                                                </div>
                                                              </div>

                                                              <div class="form-row">
                                                              <div class="form-group col-md-6">
                                                              <label for="">Cédula</label>
                                                                  <input type="text" class="form-control" disabled id="disabled" value="<?php echo $datos_estudiante["ced_est"] ?>">
                                                                  <input type="hidden" class="form-control" id="disabled" name="cedula" value="<?php echo $datos_estudiante["ced_est"] ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                  <label for="">PNF</label>
                                                                  <input type="text" class="form-control" disabled id="disabled" value="<?php echo $info_adicional["pnf"] ?>">
                                                                  <input type="hidden" class="form-control" id="disabled" name="pnf" value="<?php echo $info_adicional["pnf"] ?>">
                                                                </div>
                                                              </div>

                                                              <div class="form-row">
                                                              <div class="form-group col-md-6">
                                                              <label for="">Turno</label>
                                                                  <input type="text" disabled class="form-control" id="disabled" value="<?php echo $info_adicional["turno"]==1 ? 'Diurno' : 'Nocturno'; ?>">
                                                                  <input type="hidden" class="form-control" id="disabled" name="turno" value="<?php echo $info_adicional["turno"]==1 ? 'Diurno' : 'Nocturno'; ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                  <label for="tlf">Número de teléfono</label>
                                                                  <input type="text" class="form-control" id="tlf" name="tlf" value="<?php echo $datos_estudiante["telf_est"] ?>">
                                                                </div>
                                                              </div>

                                                              <div class="form-row">
                                                              <div class="form-group col-md-6">
                                                              <label for="">Correo electrónico</label>
                                                                  <input type="email" class="form-control" id="disabled" name="correo" value="<?php echo $datos_estudiante["correo"] ?>">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                <label for="exampleFormControlSelect1">Trayecto</label>
                                                                <select class="form-control" name="trayecto" id="exampleFormControlSelect1">
                                                                  <option value="I">Trayecto I</option>
                                                                  <option value="II">Trayecto II</option>
                                                                  <option value="III">Trayecto III</option>
                                                                  <option value="IV">Trayecto IV</option>
                                                                  <option value="V">Trayecto V</option>
                                                                </select>
                                                              </div>
                                                              </div>
                                                              
                                                              
                                                              
                                                            


                                                            
                                                             <input type="submit" id="enviar" value="Inscribirse" class="btn btn-primary btn-block">
                                                            
                                                            </form>
                                                            
                                              
                                            </div> <!-- Fin Contenido del modal-->                                        
                                        </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                    </div>
                                </div>
                            </div> <!--Final modal-->



                                <!-- INFORMACION DE LA ACREDITABLE -->
                                <div class="modal fade" id="modal-descripcion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">De que trata esta acreditable</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">


                                      <div id="descripcion"></div>


                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>

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

        //funcion para para capturar descripcion

        function descripcion(descripcion){


          $('#descripcion').html(descripcion);

          $('#modal-descripcion').modal('show');

        }
  </script>

</body>
</html>

<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php
      if($_POST){

        include_once '../../conexion/conexion.php';

          $nombre         = $_POST["nombre"];
          $apellido       = $_POST["apellido"];
          $cedula         = $_POST["cedula"];
          $correo         = $_POST["correo"];
          $pnf            = $_POST["pnf"];
          $tlf            = $_POST["tlf"];
          $turno          = $_POST["turno"];
          $trayecto       = $_POST["trayecto"];
          $id_acreditable = $_POST["id_acreditable"];
          $id_usuario     = $datos_estudiante["id"];

          // echo $nombre."<br>";
          // echo $apellido."<br>";
          // echo $cedula."<br>";
          // echo $correo."<br>";
          // echo $pnf."<br>";
          // echo $tlf."<br>";
          // echo $turno."<br>";

          // die();
          

          // SABER CUANTOS CUPOS TIENE CADA ACREDITABLE
          $sql5="SELECT cupo FROM acreditables WHERE id=".$id_acreditable;
          $gsent3= $conexion->prepare($sql5);
          $gsent3->execute();
          $resultado2 = $gsent3->fetch();
          $cupo=$resultado2["cupo"];


          // LIMITE MAXIMO
          $sqlcontar = "SELECT COUNT(*) FROM inscripcion WHERE id_acreditable=".$id_acreditable;
          $resultconteo = $conexion->query($sqlcontar);
          $conteo_registros = $resultconteo->fetchColumn();




          // echo 'Número de total de registros: ' . $total."<br>";

          // SABER QUE EL ESTUDIANTE SOLO INSCRIBA UNA ACREDITABLE
          $sql5       = "SELECT id_usuario, estado FROM inscripcion WHERE id_usuario = ? AND estado = 1";
          $sentencia5 = $conexion->prepare($sql5);
          $sentencia5->execute(array($id_usuario));
          $resultado5 = $sentencia5->fetch();

          if( $resultado5 ){
            ?>
                <script>
                    $(document).ready(function(){
                        // Notificacion
                        $("body").overhang({
                            type: "error",
                            message: "Ya te has registrado en una acreditable",
                            closeConfirm: true,
                            duration: 2,
                            // Asi redirijo
                            callback: function(){
                                window.location.href = "acreditableI.php";
                            }            
                        });
                    })
                </script>
            <?php
        die();
        }

        if($conteo_registros<$cupo){

          // REGISTRAR ESTUDIANTE
           $sql2     = "INSERT INTO inscripcion (nombre, apellido, cedula, pnf, turno, tlf, correo, trayecto, estado, nota_cargada, id_acreditable, id_usuario) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
           $agregar2 = $conexion->prepare($sql2);
           $agregar2->execute(array($nombre, $apellido, $cedula, $pnf, $turno, $tlf, $correo, $trayecto, 1, 1, $id_acreditable, $id_usuario));
 
          if($agregar2){
              ?>
                <script>
                    $(document).ready(function(){
                        document.getElementById("enviar").value = "Inscribiendo...";
                        $("#enviar").attr("disabled", true);
                        $("body").overhang({
                            type: "success",
                            message: "Te has inscrito correctamente",
                            duration: 1,
                            callback: function(){
                               window.location.href = "ver_inscripciones.php";
                            }            
                        });
                    })
                </script>
              
              <?php
                  }else{
                      echo "No te inscribiste";
                      // var_dump($agregar);
                  }        
                }else{
                    ?>
                <script>
                    $(document).ready(function(){
                        // Notificacion
                        $("body").overhang({
                            type: "error",
                            message: "Ya no hay cupos disponibles",
                            closeConfirm: true,       
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
                $agregar=null;
    

?>