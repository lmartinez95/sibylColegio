<?php if ($this->session->flashdata('mensaje')) { ?>
	<div>
		<p class="message" id="message">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</p>
	</div>
<?php }
    echo form_open('docente/cuNota/' . $grupo . '/' . $evaluacion);
 ?>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Código</th>
				<th>Alumno</th>
				<th>Nota<th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $result) { ?>
				<tr>
					<td><?php echo $result["almCodigo"]; ?></td>
					<td><?php echo $result["Nombre"]; ?></td>
					<td>
                        <input type="number" class="form-control" name="notas[<?php echo $result["notId"]; ?>][<?php echo $result["almId"]; ?>]" id="<?php echo $result["notId"]; ?>" min="0.00" max = "10" step="0.01" value="<?php echo number_format($result["nota"], 2); ?>" required />
                    </td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
    <div>
        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-placement="top" data-target="#agregar"><i class="fas fa-save"></i> Guardar</a>
    </div>
</div>
<!-- Modal de agregar -->
<div class="modal fade" id="agregar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Agregar evaluación</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				¿Está seguro de ingresar estas notas?
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" value="agregar" name="btnGuardar"><i class="fas fa-check"></i></i> Aceptar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
				
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>