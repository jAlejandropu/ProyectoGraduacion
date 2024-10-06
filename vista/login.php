<?php
session_start();
if (isset($_SESSION['S_IDUSUARIO'])) { //La sesion existe
  header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN SISTEMA TALLER</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plantilla/dist/css/adminlte.min.css">

  <!-- SWEETALERT 2 -->
  <link rel="stylesheet" href="plantilla/plugins/sweetalert2/sweetalert2.css">

  <link rel="stylesheet" href="public/estilos.css">

  <!-- Custom CSS -->
  <style>
    /* Fondo de la página de login */
    #fondoLogin {
      background-color: #f0f0f0;
      background-image: url('https://1000marcas.net/wp-content/uploads/2020/03/CAT-Emblema.jpg'); /* Si quieres un fondo personalizado */
      background-size: cover;
      background-position: center;
    }

    /* Contenedor del login */
    #cont__login {
      background-color: #ffffff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    /* Encabezado del formulario */
    .card-header {
      background-color: #ffcc00; /* Color amarillo de CAT */
      color: #000; /* Color negro para el texto */
      text-align: center;
    }

    /* Estilo del botón */
    .btn-primary {
      background-color: #ffcc00; /* Color amarillo de CAT */
      border-color: #ffcc00;
      color: #000;
    }

    /* Cambia el color al pasar el ratón sobre el botón */
    .btn-primary:hover {
      background-color: #e6b800;
      border-color: #e6b800;
    }

    /* Cambiar el color de los iconos en los campos */
    .input-group-text {
      background-color: #ffcc00;
      border-color: #ffcc00;
      color: #000;
    }

    /* Estilo para el enlace de restablecer contraseña */
    #btnRestablecerPassword {
      color: #ffcc00;
    }

    #btnRestablecerPassword:hover {
      color: #e6b800;
    }

    /* Logo de CAT */
    .logo-cat {
      width: 120px;
      margin-bottom: 15px;
    }
  </style>
</head>

<body class="hold-transition login-page" id="fondoLogin">
  <div class="login-box" id="cont__login">
    <!-- Logo CAT -->
    <div class="card-header text-center py-3">
      <img src="https://cdn-icons-png.flaticon.com/512/846/846351.png" alt="" class="logo-cat">
      <a href="plantilla/index.html" class="h1"><b>INICIAR SESI&Oacute;N</b>
    </div>

    <div class="card-body my-3">
      <form id="login-form" action="javascript:;" method="post">
        <div class="input-group mb-4">
          <input type="text" class="form-control" placeholder="Username" id="usuario" autocomplete="off" maxlength="40">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-2">
          <input type="password" class="form-control" placeholder="Password" id="password" maxlength="250">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-lg-12 my-3">
            <button class="btn btn-primary btn-block" onclick="verificarUsuario()">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="recuperar_password.php" id="btnRestablecerPassword">Reestablecer Contraseña</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.login-box -->

  <div class="login-box" style="display: none;" id="cont__crendenciales">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="#" class="h1"><b>CONFIGURE SUS CREDENCIALES</b></a>
      </div>
      <div class="card-body">
        <form id="frmCredentials">
          <label for="">Password Temporal</label>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password temporal." id="txtPasswordTemporal" autocomplete="off" maxlength="250">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <input type="hidden" id="txtIdUser">
            <input type="hidden" id="txtPasswordCurrent">
          </div>
          <label for="">Nuevo Password</label>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password nuevo." id="txtNuevoPassword" autocomplete="off" maxlength="250">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <label for="">Confirmación Nuevo Password</label>
          <div class="input-group mb-4">
            <input type="password" class="form-control" placeholder="Confirme su password." id="txtConfirmacionPassword" autocomplete="off" maxlength="250">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <button type="button" class="btn btn-primary btn-block" id="btnSaveCredentials">Guardar Credenciales</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="login.php">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>

  <!-- jQuery -->
  <script src="plantilla/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="plantilla/dist/js/adminlte.min.js"></script>

  <script src="../js/console_usuario.js" type="text/javascript"></script>

  <!-- SWALALERT -->
  <script src="plantilla/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>
