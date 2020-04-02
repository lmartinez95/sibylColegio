<!doctype html>
<html class="no-js h-100" lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon">
    <title><?php echo $title; ?> - Sibyl System</title>
    <meta name="description" content="A high-quality &amp; free Bootstrap admin dashboard template pack that comes with lots of templates and components.">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <script rel="javascript" type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-3.3.1.min.js" integrity=""></script>
  </head>
  <body class="h-100 bg-light">
    
    <!--Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img id="main-logo" class="d-inline-block align-top mr-1" style="max-width: 25px;" src="<?php echo base_url(); ?>assets/images/logo.png" alt="Shards Dashboard">
        Sibyl System
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <!--<li class="nav-item active">
            <a class="nav-link" href="#">Personal <span class="sr-only">(current)</span></a>
          </li>-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Personal
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo base_url(); ?>admin/tipoEmpleado"><i class="fas fa-circle"></i>&emsp;Tipo de empleados</a>
              <a class="dropdown-item" href="<?php echo base_url(); ?>admin/empleado"><i class="fas fa-id-card"></i>&emsp;Empleados</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Pedagógico
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?php echo base_url(); ?>admin/materia"><i class="fas fa-file"></i>&emsp;Materias</a>
              <a class="dropdown-item" href="<?php echo base_url(); ?>admin/nivel"><i class="fas fa-layer-group"></i>&emsp;Niveles</a>
              <a class="dropdown-item" href="<?php echo base_url(); ?>admin/grado"><i class="fas fa-chalkboard-teacher"></i>&emsp;Grados</a>
                  <a class="dropdown-item" href="<?php echo base_url(); ?>admin/grupo"><i class="fas fa-users"></i>&emsp;Grupos</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Alumnos
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/alumno/matricula"><i class="fas fa-user-plus"></i>&emsp;Matrícula</a>
            <a class="dropdown-item" href="<?php echo base_url(); ?>admin/alumno"><i class="fas fa-user-graduate"></i>&emsp;Alumnos</a>
          </li>
          <!-- Menú para rol de alumnos -->
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>alumno/nota">Notas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url(); ?>alumno/nota">Expediente</a>
          </li>
          <!-- Fin menú para rol de alumnos -->
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $usuario; ?>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item text-danger" href="" id="btnLogout"><i class="fas fa-sign-out-alt"></i>&emsp;Salir</a>
            </li>
        </form>
      </div>
    </nav>
    <!-- End Navbar -->
    
    <!-- Content -->
    <div class="container">
          <span class="text-uppercase page-subtitle">Dashboard</span>
          <h3 class="page-title"><?php echo $title; ?></h3>
        
      <?php $this->load->view($content_view); ?>
    </div>
    <!-- End Content -->
    <footer class="footer text-center">
      <div class="container">
        <ul class="nav mx-auto">
          <li class="nav-item">
            <a class="nav-link text-decoration-none" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-decoration-none" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-decoration-none" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-decoration-none" href="#">Products</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-decoration-none" href="#">Blog</a>
          </li>
        </ul>
        <div class="footer-copyright text-center py-3">Copyright © 2018
          <a href="#" rel="nofollow">DesignRevision</a>
        </span>
      </div>
    </footer>
    <script src="<?php echo base_url(); ?>assets/js/popper.min.js" integrity=""></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js" integrity=""></script>
    <script src="<?php echo base_url(); ?>assets/js/Chart.min.js"></script>
    
    <script src="<?php echo base_url(); ?>assets/js/shards-dashboards.1.0.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/login.js"></script>
  </body>
</html>