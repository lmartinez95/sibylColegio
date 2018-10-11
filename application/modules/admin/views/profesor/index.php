<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <div class="container-fluid">
    <h1>Grupos Clase</h1>
          <div class="row">
          <?php foreach ($results as $result) { ?>
              <div class="col-lg-3 col-md-6">
              <div class="card border-dark mb-3" style="max-width: 18rem;">
                <div class="card-header bg-transparent border-dark"><h4><?php echo $result["nvlNivel"]; ?></h4></div>
                <div class="card-body text-dark">
                  <h5 class="card-title"><?php echo $result["matNombre"]; ?></h5>
                  <p class="card-text"></p>
                </div>
                <div class="card-footer bg-transparent border-dark">
                    <a href="grupo/listado/<?php echo $result["grpId"]; ?>">
                      <div class="panel-footer">
                          <span class="pull-left">Ver Listado</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
                </div>
              </div>
            </div>
          <?php } ?>
                
                               
            </div>

    </div>
</body>
</html>