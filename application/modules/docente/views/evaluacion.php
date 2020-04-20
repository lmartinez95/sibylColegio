<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Inicio</a></li>
    <li class="breadcrumb-item active" aria-current="page">Evaluaciones</li>
  </ol>
</nav>
<?php if ($this->session->flashdata('mensaje')) { ?>
	<div>
		<p class="message" id="message">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</p>
	</div>
<?php } ?>
<br>
<?php echo form_open('docente/agregarEva/'.$grupo, 'class="form-inline border rounded"'); ?>
	
	<div class="input-group mb-2 mr-sm-3">
		<div class="input-group-prepend">
			<span class="btn btn-light active input-group-text" id="basic-addon1">Evaluación</span>
		</div>
		<input type="text" class="form-control" name="txtEvaluacion" id="txtEvaluacion" placeholder="Título de evaluación" aria-label="Evaluación" aria-describedby="basic-addon1" autocomplete="off" require>
	</div>
	<label for="nudPorcentaje" class="sr-only">Porcentaje</label>
	<div class="input-group mb-2 mr-sm-3">
		<div class="btn btn-light active input-group-prepend">
			<div class="input-group-text">Porcentaje</div>
		</div>
		<input type="numeric" class="form-control" name="nudPorcentaje" id="nudPorcentaje" placeholder="0" autocomplete="off" min="1" max="100" step="1" value="1" require>
		<div class="input-group-append">
			<span class="btn btn-light active input-group-text">%</span>
		</div>
	</div>
	<small id="passwordHelpInline" class="text-muted mr-sm-2">
		Tiene que ser entre 1 y 100
	</small>
	<input type="hidden" name="grpId" value="<?php echo $grupo; ?>">
	<a class="btn btn-primary mb-2 mr-sm-5" href="#" data-toggle="modal" data-placement="top" data-target="#agregar"><i class="fas fa-plus"></i> Agregar</a>
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
					¿Está seguro de agregar la evaluación?
				</div>

				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="submit" class="btn btn-success" value="agregar" name="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>			
				</div>
			</div>
		</div>
	</div>
	<!-- Fin Modal -->
<?php echo form_close(); ?>
<br>
<br>
<div class="table-responsive">
	<table class="table justify-content-center">
		<thead class="thead-light">
			<tr>
				<th scope="col">Evaluación</th>
				<th scope="col">Porcentaje</th>
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