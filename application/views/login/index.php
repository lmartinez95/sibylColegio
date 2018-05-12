<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sibyl System - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/util.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/login.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>assets/css/fontawesome-all.css" />
    <script src="<?php echo base_url(); ?>assets/js/jquery-slim.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-t-50 p-b-90">
                <?php echo form_open('login/validar','class="login100-form validate-form flex-sb flex-w"'); ?>    
					<span class="login100-form-title p-b-51">
						Login
					</span>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "El Carné es requerido">
						<input class="input100" type="text" name="carne" placeholder="Carné">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-16" data-validate = "La contraseña es requerida">
						<input class="input100" type="password" name="pass" placeholder="Contraseña">
						<span class="focus-input100"></span>
					</div>
					<div class="flex-sb-m w-full p-t-3 p-b-24">
						<div class="contact100-form-checkbox">
							<div class="row">
								<div class="col-6">
									<input class="input-checkbox100" id="ckb1" type="radio" name="tipo" value="administrador">
									<label class="label-checkbox100" for="ckb1">
										Administrador
									</label>
								</div>
								<div class="col-6">
									<input class="input-checkbox100" id="ckb2" type="radio" name="tipo" value="profesor">
									<label class="label-checkbox100" for="ckb2">
										Profesor
									</label>
								</div>
							</div>
						</div>
                    </div>
                    <div>
						<p class="message">
                            <?php 
                                if (isset($message)){
                                    echo $message;
                                }
                            ?>
                        </p>
                    </div>
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Login
						</button>
					</div>
                <?php echo form_close(); ?>
			</div>
		</div>
	</div>
</body>
</html>