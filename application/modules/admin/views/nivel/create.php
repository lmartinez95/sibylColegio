<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?php echo $this->session->userdata('redirect'); ?>">Inicio</a></li>
    <li class="breadcrumb-item"><a href="<?php echo $this->session->userdata('redirect') . 'nivel/'; ?>">Niveles</a></li>
    <li class="breadcrumb-item active" aria-current="page">Agregar nivel</li>
  </ol>
</nav>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo validation_errors(); ?>
</div>
<?php echo form_open('admin/nivel/agregar'); ?>
    <div class="form-group">
        <label for="nvlAbrev">Abreviatura:</label>
        <input type="text" class="form-control" name="nvlAbrev" id="nvlAbrev" value="<?php echo set_value('nvlAbrev'); ?>" placeholder="Abreviatura" autocomplete="off" require autofocus>
    </div>
    <div class="form-group">
        <label for="nvlNivel">Nivel:</label>
        <input type="text" class="form-control" name="nvlNivel" id="nvlNivel" value="<?php echo set_value('nvlNivel'); ?>" placeholder="Nivel" autocomplete="off" require>
    </div>
    <div class="form-group">
        <label for="cboNvlIdPadre">Nivel:</label>
        <select class="form-control" name="cboNvlIdPadre" id="cboNvlIdPadre">
            <option value="0">Ninguno</option>
        <?php foreach ($nivel as $item) { ?>
            <option <?php echo set_select('cboNvlIdPadre', $item["nvlId"]); ?> value="<?php echo $item["nvlId"]; ?>"><?php echo $item["nvlNivel"]; ?></option>
        <?php } ?>
        </select>
    </div>
<button type="submit" class="btn btn-success" value="agregar" name="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
<?php echo form_close(); ?>