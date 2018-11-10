<?php include("maquetacion/head.php") ?>

<body>
  <div class="page login-page">
    <div class="container d-flex align-items-center">
      <div class="form-holder has-shadow">
        <div class="row">
          <!-- Logo & Panel de informacion -->
          <div class="col-lg-6">
            <div class="info d-flex align-items-center">
              <div class="content">
                <div class="logo">
                  <h1>Registro de cuenta</h1>
                </div>
                <img src="../img/UPTA.png" width="350px" height="400px" text-align="center" alt="">
                <p text-aling="center">Todos los campos son obligatorios.</p>
              </div>
            </div>
          </div>
          <!-- Formulario de registro    -->
          <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
              <div class="content">
                <form class="form-validate" id="formulario" autocomplete="off" method="POST" action="registro.php">
                  <div class="form-group">
                    <label for="registrar-cedula" class="label-material">Cédula</label>
                    <input id="registrar-cedula" type="text" name="cedula" placeholder="Introduce tú cédula" required class="input-material">
                  </div>
                  <div class="form-group">
                    <label for="registrar-password" class="label-material">Contraseña </label>
                    <input id="registrar-password" type="password" name="pass" placeholder="Introduce tú contraseña" required class="input-material">
                    <small>La contraseña debe tener entre 5-16 caracteres y solo puede contener caracteres alfanuméricos</small>  
                  </div>
                  <div class="form-group">
                    <label for="registrar-password2" class="label-material">Repetir contraseña </label>
                    <input id="registrar-password2" type="password" placeholder="Repite tú contraseña" name="pass2" required class="input-material">
                  </div>
                  <div class="form-group">
                    <button id="enviar" type="submit" name="registerSubmit" class="btn btn-primary">Registrarse</button>
                  </div>
                </form>
                <small>¿Ya posees una cuenta?</small>
                <a href="login.php" class="signup">Inicia Sesión</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copyrights text-center">
        <p title="Realizado por Juan Osio y Aida Blanco">ACCU &copy; 2018
          <a href="#" class="external">UPTAFBF - La Victoria</a>
        </p>
      </div>
    </div>
  </div>

<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php
            // Conexion a mi base de datos
            include_once("../conexion/conexion.php");
            // Conexion base de datos Departamento
            include_once("../conexion/conexion2.php");

    // REGISTRAR USUARIO

    if($_POST){
        $cedula   = $_POST["cedula"];
        $pass     = $_POST["pass"];
        $pass2    = $_POST["pass2"];

        // VERIFICAR QUE EL ESTUDIANTE ESTE EN LA BASE DE DATOS DE LA UNIVERSIDAD
        $sqldepar       = "SELECT * FROM estudiantes WHERE ced_est=$cedula";
        $setenciadepar  = $conexion2->prepare($sqldepar);
        $setenciadepar->execute();
        $resultadodepar = $setenciadepar->fetch();

        $id_estudiante  = $resultadodepar["id"];

        // SI EL ESTUDIANTE NO ESTA INSCRITO, TERMINAR PROCESO
        if(!($resultadodepar)){
          ?>
              <script>
                  $(document).ready(function(){
                    document.getElementById("enviar").value = "Registrando...";
                    $("#enviar").attr("disabled", true);
                      // Notificacion
                      $("body").overhang({
                          type: "error",
                          message: "Los campos introducidos no se encuentran en sistema",
                          closeConfirm: true,
                          duration: 1,
                          // Asi redirijo
                          callback: function(){
                              window.location.href = "login.php";
                          }            
                      });
                  })
              </script>
          <?php
      die();
      }
        

        // VERIFICAR SI USUARIO EXISTE
        $sql       = "SELECT usuarios.cedula from usuarios WHERE cedula = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(array($cedula));
        $resultado = $sentencia->fetch();


      // SI EL ESTUDIANTE YA ESTA REGISTRADO, TERMINAR PROCESO
        if( $resultado ){
            ?>
                <script>
                    $(document).ready(function(){
                      $("#enviar").attr("value", "Registrando...");
                      $("#enviar").attr("disabled", true);
                        // Notificacion
                        $("body").overhang({
                            type: "error",
                            message: "Este usuario ya ha sido registrado",
                            closeConfirm: true,
                            duration: 1,
                            // Asi redirijo
                            callback: function(){
                                window.location.href = "login.php";
                            }            
                        });
                    })
                </script>
            <?php
        die();
        }

        // ENCRYPTAR CONTRASEÑA
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        

        // VALIDAR CONTRASEÑAS DESDE EL BACKEND
        if (password_verify($pass2, $pass)) {

            //REGISTRO EN MI BASE DE DATOS SI LA CONTRASEÑA SON LAS MISMAS
            $sql     = "INSERT INTO usuarios(cedula,pass,privilegio,id_estudiante) VALUES (?,?,?,?)";
            $agregar = $conexion->prepare($sql);
            $agregarif = $agregar->execute( array($cedula, $pass, 2, $id_estudiante));
          
            
            if( $agregarif ){
                ?>
                    <script>
                    $(document).ready(function(){
                        $("#enviar").attr('value', 'Registrando...');
                        $("#enviar").attr("disabled", true);
                        // Notificacion
                        $("body").overhang({
                            type: "success",
                            message: "Usuario registrado satisfactoriamente",
                            duration: 2,
                            // Asi redirijo
                            callback: function(){
                                window.location.href = "login.php";
                            }            
                        });
                    })
                    </script>
                <?php
            }else{
                echo "error";
            }

            //Cerramos conexion con base de datos
            $agregar  = null;
            $conexion = null;

        } else {
            ?>
            <script>
                $(document).ready(function(){
                    document.getElementById("enviar").value = "Registrando...";
                    $("#enviar").attr("disabled", true);
                    $("body").overhang({
                        type: "error",
                        message: "Las contraseñas no son iguales",
                        closeConfirm: true,
                        callback: function(){
                            window.location.href = "registro.php";
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