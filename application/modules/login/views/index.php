<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
  <title>Sibyl System - Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" />
  <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js" integrity=""></script>
  <style>
    html, body {
      height: 100%;
    }

    body {
      display: -ms-flexbox;
      display: flex;
      -ms-flex-align: center;
      align-items: center;
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      width: 100%;
      max-width: 330px;
      padding: 15px;
      margin: auto;
    }
    .form-signin .checkbox {
      font-weight: 400;
    }
    .form-signin .form-control {
      position: relative;
      box-sizing: border-box;
      height: auto;
      padding: 10px;
      font-size: 16px;
    }
    .form-signin .form-control:focus {
      z-index: 2;
    }
    .form-signin input[type="email"] {
      margin-bottom: -1px;
      border-bottom-right-radius: 0;
      border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }
    .progress{
      opacity: 0.7;
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      z-index: 666;
      text-align: center;
    }
    .progress img {
      position: absolute;
      margin: auto;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
    }
    .progress span {
        position: absolute;
        margin: auto;
        top: 55%;
        left: -2px;
        right: 2px;
        bottom: 0;
    }
  </style>
</head>
<body class="text-center">
    <!-- <form class="form-signin" id='frmLogin' action='login/validar' method='POST'> -->
    <?php echo form_open('login/validar', ['class' => 'form-signin', 'id' => 'frmLogin'])?>
      <img class="mb-4" src="<?php echo base_url(); ?>assets/images/logo.png" alt="" width="72" height="72">
      <!--<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>-->
      <label for="carne" class="sr-only">Usuario</label>
      <input type="text" name='carne' id="carne" class="form-control" value="" placeholder="Usuario" required autofocus>
      <label for="pass" class="sr-only">Password</label>
      <input type="password" name='pass' id="pass" class="form-control" value="" placeholder="Password" data-validate = "La contraseña es requerida" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>
      <div>
        <p class="message" id="message">
          
        </p>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      
      <div id="loading" style="display: none;">
        <div class="progress">
            <img id="Image1" src="<?php echo base_url(); ?>assets/images/roller.gif" />
          <h4> <span id="LbProceso">Cargando Perfil</span></h4>
        </div>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2020</p>
    </form>
    

    
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity=""></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $("#frmLogin").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:$(this).attr("action"),
            type:$(this).attr("method"),
            data:$(this).serialize(),
            dataType: 'JSON',
            beforeSend: function(){
              $("#message").html = "";
              $('#frmLogin').find('input, textarea, button, select').attr('disabled',true);
              $("#loading").show();
            },
            complete: function(response){
              $("#loading").hide();
              $('#frmLogin').find('input, textarea, button, select').attr('disabled',false);
            },
            success: function(response){
              if (response.status == true) {
                  document.location.href = response.redirect;
                } else if(response.status == false){
                  $("#message").html = "<div class='alert alert-danger'><strong>¡Error!</strong> Datos inválidos</div>";
                }else{
                  $("#message").html = "<div class='alert alert-warning'><strong>¡Error!</strong>Ingrese los datos requeridos</div>";
                }
            }
          }); //ajax
        });
      });
    </script>
</body>
</html>