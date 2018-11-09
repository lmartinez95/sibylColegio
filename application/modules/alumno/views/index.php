<div class="row">
  <?php foreach ($results as $result) { ?>
    <div class="col-lg-3 col-md-6">
      <div class="card border-dark mb-3" style="max-width: 18rem;">
        <div class="card-header bg-transparent border-dark"><h4></h4></div>
        <div class="card-body text-dark">
          <h5 class="card-title"><?php echo $result["matNombre"]; ?></h5>
          <p class="card-text"></p>
        </div>
        <div class="card-footer bg-transparent border-dark">
          <div class="panel-footer">
            <a href="alumno/notas/">
              <span class="pull-left">Ver notas</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            </a>
            <div class="clearfix"></div>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>
</div>