<div>
    <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-placement="top" data-target="#agregar"><i class="fas fa-plus"></i> Nuevo</a>
</div>
<?php if ($this->session->flashdata('mensaje')) { ?>
	<div>
		<p class="message" id="message">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</p>
	</div>
<?php } ?>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Evaluación</th>
				<th>Porcentaje</th>
				<th><th>
			</tr>
		</thead>
		<tbody>
			<?php $suma = 0; foreach ($results as $result) { $suma += $result["evaPorcentaje"];?>
				<tr>
					<td><?php echo $result["evaNombre"]; ?></td>
					<td><?php echo ($result["evaPorcentaje"] * 100) . '%'; ?></td>
					<td><a href='<?php echo base_url() . 'docente/addNota/' . $grupo . '/' . $result["evaId"]; ?>' class="btn btn-outline-primary"><i class="fas fa-plus-circle"></i> Agregar nota</a></td>
				</tr>
			<?php } ?>
			<tr>
				<th>Total</th><th><?php echo ($suma * 100) . '%'; ?></th>
			</tr>
		</tbody>
	</table>
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
				<?php
					echo form_open('docente/agregarEva/'.$grupo); ?>
						<div class="form-group">
							<label for="txtEvaluacion">Evaluación:</label>
							<input type="text" class="form-control" name="txtEvaluacion" id="txtEvaluacion" placeholder="Evaluación" autocomplete="off" require autofocus>
						</div>
						<div class="form-group">
							<label for="nudPorcentaje">Porcentaje:</label>
							<input type="numeric" class="form-control" name="nudPorcentaje" id="nudPorcentaje" placeholder="0" autocomplete="off" min="1" max="100" step="1" value="1" require>
						</div>
                        <input type="hidden" name="grpId" value="<?php echo $grupo; ?>">
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="submit" class="btn btn-success" value="agregar" name="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
				
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>