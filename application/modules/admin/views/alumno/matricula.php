<?php if ($this->session->flashdata('mensaje')) { ?>
    <div>
        <p class="message" id="message">
            <?php echo $this->session->flashdata('mensaje'); ?>
        </p>
    </div>
<?php } ?>

<div class="accordion" id="accordionIngreso">

    <?php echo validation_errors();
    echo form_open('admin/alumno/agregar'); ?>
    <div class="card">
        <div class="card-header" id="headingIOne">
            <h4 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseIOne" aria-expanded="true" aria-controls="collapseIOne">
                Nuevo ingreso
                </button>
            </h4>
        </div>

        <div id="collapseIOne" class="collapse" aria-labelledby="headingIOne" data-parent="#accordionIngreso">
            <div class="card-body">

                <div class="accordion" id="accordionNuevo">
                    <div class="card">
                        <div class="card-header" id="headingNOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseNOne" aria-expanded="false" aria-controls="collapseNOne">
                                Información personal
                                </button>
                            </h5>
                        </div>

                        <div id="collapseNOne" class="collapse" aria-labelledby="headingNOne" data-parent="#accordionNuevo">
                            <div class="card-body">
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
                                    <div class="form-group col-md-4">
                                        <label for="txtNie">NIE:</label>
                                        <input type="text" class="form-control" name="txtNie" id="txtNie" placeholder="00000000" autocomplete="off" require >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="cboDptId">Departamento:</label>
                                        <select class="form-control" name="cboDptId" id="cboDptId">
                                        <option value="">DEPARTAMENTO</option>
                                        <?php foreach ($departamento as $item) { ?>
                                            <option value="<?php echo $item["dptId"]; ?>"><?php echo $item["dptNombre"]; ?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
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
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="headingNTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseNTwo" aria-expanded="false" aria-controls="collapseNTwo">
                                Responsables
                                </button>
                            </h5>
                        </div>
                        <div id="collapseNTwo" class="collapse" aria-labelledby="headingNTwo" data-parent="#accordionNuevo">
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="txtMadre">Nombre de la Madre:</label>
                                        <input type="text" class="form-control" name="txtMadre" id="txtMadre" placeholder="Nombre de la madre" autocomplete="off" require />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="txtMadreDui">DUI Madre:</label>
                                        <input type="text" class="form-control" name="txtMadreDui" id="txtMadreDui" placeholder="00000000-0" autocomplete="off" require />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="txtPadre">Nombre del Padre:</label>
                                        <input type="text" class="form-control" name="txtPadre" id="txtPadre" placeholder="Nombre del padre" autocomplete="off" require />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="txtDuiPadre">DUI Padre:</label>
                                        <input type="text" class="form-control" name="txtDuiPadre" id="txtDuiPadre" placeholder="00000000-0" autocomplete="off" require />
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
                                        <label for="txtResponsable">Nombre del Responsable:</label>
                                        <input type="text" class="form-control" name="txtResponsable" id="txtResponsable" placeholder="Nombre del responsable" autocomplete="off" require />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="txtTelResponsable">Teléfono del Responsable:</label>
                                        <input type="text" class="form-control" name="txtTelResponsable" id="txtTelResponsable" placeholder="0000-0000" autocomplete="off" require />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Fin card 2 -->
                    <br>
                    <div class="form-group">
                        <label for="cboGrdId">Nivel:</label>
                        <select class="form-control" name="cboGrdId" id="cboGrdId">
                        <?php foreach ($grado as $item) { ?>
                            <option value="<?php echo $item["grdId"]; ?>"><?php echo $item["grdNombre"]; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success" value="agregar" name="btnAgregarN"><i class="fas fa-plus"></i> Matricular</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                </div>            
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>

    <?php echo validation_errors();
    echo form_open('admin/alumno/antiguo'); ?>
    <div class="card">
        <div class="card-header" id="headingITwo">
            <h4 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseITwo" aria-expanded="false" aria-controls="collapseITwo">
                Antiguo ingreso
                </button>
            </h4>
        </div>
        <div id="collapseITwo" class="collapse" aria-labelledby="headingITwo" data-parent="#accordionIngreso">
            <div class="card-body">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBuscar">
                    Buscar
                </button>
                <div class='form-group'>
                    <label for='cboAlumno'>Alumno</label>
                    <select class="form-control" name="cboAlumno" id="cboAlumno" require>
                        
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-success" value="agregar" name="btnAgregarA"><i class="fas fa-plus"></i> Matricular</button>
            </div>
        </div>
    </div>	
    <?php echo form_close(); ?>					
</div>
<div id='mensaje'></div>

<!-- Modal -->
<div class="modal fade" id="modalBuscar" tabindex="-1" role="dialog" aria-labelledby="modalBuscarTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalBuscarTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form name='frmBuscar' id='frmBuscar' method='POST' action=<?php echo base_url() . 'admin/alumno/buscaAlumno'; ?> enctype="multipart/form-data">
            <div class="form-group">
                <label for="txtBuscar">Búsqueda:</label>
                <input type="text" class="form-control" name="txtBuscar" id="txtBuscar" placeholder="Buscar por código o nombre" autocomplete="off" require />
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary" value="agregar" id='btnBuscar'><i class="fas fa-search"></i> Buscar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<script rel="javascript" type="text/javascript">
    $(document).ready(function() {
        $("#frmBuscar").submit(function(event){
            event.preventDefault();
            $.ajax({
                url:$(this).attr("action"),
                type:$(this).attr("method"),
                data:$(this).serialize(),
                dataType: 'json',
                beforeSend: function(){
                    //$("#loading").show();
                },
                complete: function(response){
                    $("#modalBuscar").modal('hide');
                },
                success: function(response) {
                    var o;
                    $('#cboAlumno').empty().append('');
                    $.each( response, function( key, value ) {
                        o = new Option(value.almCodigo + ' - ' + value.Nombre, value.almId);
                        $(o).html(value.almCodigo + ' - ' + value.Nombre);
                        $('#cboAlumno').append(o);
                    });
                } //success
            }); //ajax
        }); //function
    });
</script>