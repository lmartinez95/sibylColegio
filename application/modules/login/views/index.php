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
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.js" integrity=""></script>
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
    </style>
</head>
<body class="text-center">
    <form class="form-signin" id='frmLogin' action='login/validar' method='POST'>
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
      
      <div id="loading" class="align-middle" style="display: none;position: fixed; z-index:100; top:45%;">
        <div class="align-middle progress">
            <img id="Image1" src="<?php echo base_url(); ?>assets/images/roller.gif" />
          <h4> <span id="LbProceso">Cargando Perfil</span></h4>
        </div>
      </div>
      <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
    

    
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity=""></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var dimension = document.getElementById('frmLogin');
        $("#frmLogin").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:$(this).attr("action"),
            type:$(this).attr("method"),
            data:$(this).serialize(),
            dataType: 'json',
            beforeSend: function(){
              var dimension = document.getElementById("frmLogin");
              $('#frmLogin').find('input, textarea, button, select').attr('disabled',true);
              $( "#loading" ).width( dimension.clientWidth );
						  $( "#loading" ).height( dimension.clientHeight );
              $("#loading").show();
            },
            complete: function(response){
              $("#loading").hide();
              $('#frmLogin').find('input, textarea, button, select').attr('disabled',false);
            },
            success: function(response) {
              if (response.status) {
                document.location.href = response.redirect;
              } else if(response.status == false){
                document.getElementById("message").innerHTML = "<div class='alert alert-danger'><strong>¡Error!</strong> Datos inválidos</div>";
              }else{
                document.getElementById("message").innerHTML = "<div class='alert alert-warning'><strong>¡Error!</strong>Ingrese los datos requeridos</div>";
              }
            } //success
          }); //ajax
        });
      });
    </script>
</body>
</html>