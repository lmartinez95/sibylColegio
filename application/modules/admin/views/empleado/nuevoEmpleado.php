<?php if ($this->session->flashdata('mensaje')) { ?>
    <div>
        <p class="message" id="message">
            <?php echo $this->session->flashdata('mensaje'); ?>
        </p>
    </div>
<?php } ?>

<div class="accordion" id="accordionIngreso">

    <?php echo validation_errors();
    echo form_open('admin/empleado/agregar'); ?>
    <div class="form-group">
        <label for="txtNombre">Nombres:</label>
        <input type="text" class="form-control" name="txtNombre" id="txtNombre" placeholder="Nombres" autocomplete="off" require>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="txtApellidoP">Apellido Paterno:</label>
            <input type="text" class="form-control" name="txtApellidoP" id="txtApellidoP" placeholder="Apellido Paterno" autocomplete="off" require >
        </div>
        <div class="form-group col-md-6">
            <label for="txtApellidoM">Apellido Materno:</label>
            <input type="text" class="form-control" name="txtApellidoM" id="txtApellidoM" placeholder="Apellido Materno" autocomplete="off" require >
        </div>
    </div>
    
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="dtpFechaNac">Fecha de Nacimiento:</label>
            <input type="date" class="form-control" name="dtpFechaNac" id="dtpFechaNac" require >
        </div>
        <div class="form-group col-md-4">
            <label for="txtLugarNac">Lugar de Nacimiento:</label>
            <input type="text" class="form-control" name="txtLugarNac" id="txtLugarNac" placeholder="Lugar de nacimiento" autocomplete="off" require >
        </div>
        <div class="form-group col-md-4">
            <label for="cboSexo">Sexo:</label>
            <select class="form-control" name="cboSexo" id="cboSexo" require>
                <option value="M" selected>Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="cboDptId">Departamento:</label>
            <select class="form-control" name="cboDptId" id="cboDptId">
            <option value="">DEPARTAMENTO</option>
            <?php foreach ($departamento as $item) { ?>
                <option value="<?php echo $item["dptId"]; ?>"><?php echo $item["dptNombre"]; ?></option>
            <?php } ?>
            </select>
        </div>
        <div class="form-group col-md-6">
            <label for="cboMunId">Municipio:</label>
            <select class="form-control" name="cboMunId" id="cboMunId">
                <option value="0">MUNICIPIO</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="txtDireccion">Dirección:</label>
        <input type="text" class="form-control" name="txtDireccion" id="txtDireccion" placeholder="Dirección" autocomplete="off" require >
    </div>
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="txtDUI">DUI:</label>
            <input type="text" class="form-control" name="txtDUI" id="txtDUI" pattern="^[0-9]{8}-[0-9]{1}$" require title="Formato: 00000000-0" placeholder="00000000-0" autocomplete="off" />
        </div>
        <div class="form-group col-md-3">
            <label for="txtNIT">NIT:</label>
            <input type="text" class="form-control" name="txtNIT" id="txtNIT" pattern="^\d{4}-\d{6}-\d{3}-\d{1}$" require title="Formato: 0000-000000-000-0" placeholder="0000-000000-000-0" autocomplete="off" />
        </div>
        <div class="form-group col-md-3">
            <label for="txtISSS">ISSS:</label>
            <input type="text" class="form-control" name="txtISSS" id="txtISSS" pattern="^\d{9}$" require title="Formato: 000000000" placeholder="000000000" autocomplete="off" />
        </div>
        <div class="form-group col-md-3">
            <label for="txtNUP">NUP:</label>
            <input type="text" class="form-control" name="txtNUP" id="txtNUP" pattern="^\d{12}$" require title="Formato: 000000000000" placeholder="000000000000" autocomplete="off"/>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="txtTelCasa">Teléfono de casa:</label>
            <input type="text" class="form-control" name="txtTelCasa" id="txtTelCasa" placeholder="0000-0000" autocomplete="off" require />
        </div>
        <div class="form-group col-md-4">
            <label for="txtTelCel">Teléfono celular:</label>
            <input type="text" class="form-control" name="txtTelCel" id="txtTelCel" placeholder="0000-0000" autocomplete="off" require />
        </div>
        <div class="form-group col-md-4">
            <label for="txtEmail">Correo:</label>
            <input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="email@algo.com" autocomplete="off" require />
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="txtProfesion">Profesión:</label>
            <input type="text" class="form-control" name="txtProfesion" id="txtProfesion" placeholder="Profesión" autocomplete="off" require >
        </div>
        <div class="form-group col-md-4">
            <label for="cboTempId">Tipo de empleado:</label>
            <select class="form-control" name="cboTempId" id="cboTempId">
            <?php foreach ($combo as $item) { ?>
                <option value="<?php echo $item["tempId"]; ?>"><?php echo $item["tempNombre"]; ?></option>
            <?php } ?>
            </select>
        </div>
    </div>
    <br>
    <button type="submit" class="btn btn-success" value="agregar" name="btnAgregarN"><i class="fas fa-plus"></i> Agregar</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
    <?php echo form_close(); ?>

    				
</div>
<div id='mensaje'></div>
<script src="<?php echo base_url(); ?>assets/js/functions.js"></script>
