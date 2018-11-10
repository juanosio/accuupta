
<?php include("maquetacion/head.php");
session_start();
?>

<body>
  <div class="page login-page">
    <div class="container d-flex align-items-center">
      <div class="form-holder has-shadow">
        <div class="row">
          <!-- Logo & Information Panel-->
          <div class="col-lg-6">
            <div class="info d-flex align-items-center">
              <div class="content">
                <div class="logo">
                  
                </div>
                <center><img src="../img/UPTA.png" alt="LOGO UPTAFBF" width="350px" height="400px"></center>
              </div>
            </div>
          </div>
          <!-- Form Panel    -->
          <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
              <div class="content">
               <center><h1>Inicio de Sesión <br> Acreditables de la UPTAFBF</h1></center>
                
              <form method="post" class="form-validate" autocomplete="off" action="login.php">
                  <div class="form-group">
                      <label for="login-username" class="label-material">Cédula</label>
                    <input id="login-username" type="text" name="usuario" required maxlength="12" placeholder="Introduce tú cédula" class="input-material">
                  </div>
                  <div class="form-group">
                      <label for="login-password" class="label-material">Contraseña</label>
                    <input id="login-password" type="password" name="usr_pass" required maxlength="17" placeholder="Introduce tú contraseña" class="input-material">
                  </div>
                  <!-- <a id="login" href="index.html" class="btn btn-primary">Entrar</a> -->
                  
                  <input type="submit" value="Iniciar sesion" id="enviar" class="btn btn-primary">
                </form>
                <a href="olvido.php" class="forgot-pass">¿Olvidaste tu contraseña?</a>
                <br>
                <small>¿Aún no tienes una cuenta? </small>
                <a href="registro.php" class="signup">Registrate</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyrights text-center">
      <p title="Juan Osio y Aida Blanco">ACCU &copy; 2018
        <a href="#" class="external">UPTAFBF - La Victoria</a>
      </p>
    </div>
  </div>

<!-- *********************************************** -->
<!-- ******** TIME TO WORK CON PHP JUANCHO ********* -->
<!-- *********************************************** -->
<?php 
    

    if($_POST){
        $usuario  = $_POST["usuario"];
        $usr_pass = $_POST["usr_pass"];


        include_once("../conexion/conexion.php");
        
        $sql       = "SELECT * from usuarios WHERE cedula = ?";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(array($usuario));
        $resultado = $sentencia->fetch();


        if( !$resultado ){
            // matar operacion por que usuario no existe
            ?>
                <script>
                    $(document).ready(function(){
                        // Notificacion
                        $("body").overhang({
                            type: "error",
                            message: "Los datos ingresados son incorrectos",
                            closeConfirm: true,       
                            duration: 1,
                        });
                    })
                </script>
            <?php
            die();
        }

        if( password_verify($usr_pass, $resultado['pass']) ){
            // todo correcto hay que acceder y mando la sesion
            $_SESSION["usuario"] = array(
                "id"            => $resultado['id'],
                "cedula"        => $resultado['cedula'],
                "privilegio"    => $resultado['privilegio'],
                "id_estudiante" => $resultado['id_estudiante'],
            );
        ?>

            <script>
                $(document).ready(function(){
                    document.getElementById("enviar").value = "Ingresando...";
                    $("#enviar").attr("disabled", true);
                    $("body").overhang({
                        type: "success",
                        message: "Iniciando sesion.. te estamos redirigiendo",
                        duration: 1,
                        callback: function(){
                            window.location.href = "admin/index.php";
                        }            
                    });
                })
            </script>

        <?php

        } else{
            // Contraseñas no son iguales
            ?>
                <script>
                    $(document).ready(function(){
                        $("body").overhang({
                            type: "error",
                            message: "Los datos ingresados son incorrectos",
                            closeConfirm: true,       
                            duration: 1,
                        });
                    })
                </script>
            <?php
            die();
        }

    }
?>



</body>

</html>