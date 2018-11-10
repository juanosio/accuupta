<?php include("maquetacion/head.php"); ?>

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
                  <h1 class="textoolvidar">¡No puede ser, olvidaste tu contraseña!</h1>
                </div>
                <img class="imgolvidar" src="../img/olvidar.png" text-align="center" alt="¿Olvidaste tu contraseña?">
                <p class="textoolvidar">Rellena los campos y te enviaremos una nueva a tu correo.</p>
              </div>
            </div>
          </div>
          <!-- Form Panel    -->
          <div class="col-lg-6 bg-white">
            <div class="form d-flex align-items-center">
              <div class="content">
                <form class="form-validate" id="formulario">
                  <div class="form-group">
                    <input id="registrar-email" type="email" name="mail" required class="input-material">
                    <label for="registrar-email" class="label-material">Correo Electronico </label>
                  </div>
                  <div class="form-group">
                    <input id="registrar-cedula" type="text" name="cedula" required class="input-material">
                    <label for="registrar-cedula" class="label-material">Cedula</label>
                  </div>
                  <div class="form-group">
                    <button id="enviar" type="submit" name="registerSubmit" class="btn btn-primary">Enviar</button>
                  </div>
                </form>
                <small>Recordaste tu cuenta?</small>
                <a href="login.php" class="signup">Inicia Sesión</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyrights text-center">
      <p>JAN &copy; 2018
        <a href="#" class="external">UPTAFBF - La Victoria</a>
      </p>
    </div>
  </div>
</body>

</html>