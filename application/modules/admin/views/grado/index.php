<div class="form-inline">
	<div class="col-lg-8">
		<form name="frmBuscar" method="POST" action="Editorial" enctype="multipart/form-data">
			<div class="input-group input-group-md">
				<input type="text" class="form-control" name="txtbuscar" id="txtbuscar" autocomplete="off" placeholder="Búsqueda">
				<span class="input-group-btn">
					<button type="submit" class="btn" name="buscar"><span class="fa fa-search" aria-hidden="true" alt="Buscar"></span></button>
				</span>
			</div>
		</form>
	</div>
	<div>
	<a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-placement="top" data-target="#agregar"><i class="fas fa-plus"></i> Nuevo</a>
	</div>
</div>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Empleado</th>
				<th>Nivel</th>
				<th>Turno</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $result) { ?>
				<tr>
					<td><?php echo $result["Empleado"]; ?></td>
					<td><?php echo $result["nvlNivel"]; ?></td>
					<td><?php echo $result["turNombre"]; ?></td>
					<td><a class="btn btn-outline-primary" href=<?php echo base_url()."admin/grado/addAlumno/" . $result["grdId"]; ?> data-toggle="tooltip" data-placement="top" title="Agregar alumno"><i class="fas fa-plus"></i></a> </td>
					<td><a class="btn btn-outline-success" href=<?php echo base_url()."admin/grado/update/" . $result["grdId"]; ?> data-toggle="tooltip" data-placement="top" title="Modificar"><i class="far fa-edit"></i></a> </td>
					<td><a class="btn btn-outline-danger" href="#" data-toggle="modal" data-tooltip="tooltip" data-placement="top" data-id="<?php echo $result["grdId"]; ?>" data-target="#Eliminar" id="btnEliminar" title="Eliminar"><i class="far fa-trash-alt"></i></a> </td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<!-- Modal para eliminar -->
<div class="modal fade" id="Eliminar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Eliminar registro</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				¿Desea eliminar esta el tipo <strong id="data"></strong> permanentemente?
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<a class="btn btn-danger" id="btnConfirm" data="<?php echo base_url("admin/grado/eliminar/"); ?>" href="#"><i class="fas fa-ban"></i> Eliminar</a>
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
			</div>
		</div>
	</div>
</div>
<!-- Fin Modal -->
<ul class="pagination justify-content-center">
	<?php
		/*if ($npag > 0) {
			if ($pagina > 1)
				echo "<li class=\"page-item\"><a class=\"page-link\" href=\"Editorial/Index/" . ($pagina - 1) . "\">Anterior</a></li>";
			else
				echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">Anterior</a></li>";
			
			for ($i = 1; $i <= $npag; $i++) { 
				if ($i == $pagina)
					echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">" . $i . "</a></li>";
				else
					echo "<li class=\"page-item\"><a class=\"page-link\" href=\"Editorial/Index/" . $i . "\">" . $i . "</a></li>";	
			}

			if ($pagina < $npag)
				echo "<li class=\"page-item\"><a class=\"page-link\" href=\"Editorial/Index/" . ($pagina + 1) . "\">Siguiente</a></li>";
			else
				echo "<li class=\"page-item disabled\"><a class=\"page-link\" href=\"#\">Siguiente</a></li>";
		}*/
	?>
</ul>
<!-- Modal de agregar -->
<div class="modal fade" id="agregar">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title">Agregar registro</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<?php echo validation_errors();
					echo form_open('admin/grado/agregar'); ?>
						<div class="form-group">
							<label for="txtgrdNombre">Nombres:</label>
							<input type="text" class="form-control" name="txtgrdNombre" id="txtgrdNombre" placeholder="Nombre de grado" autocomplete="off" require autofocus>
						</div>
						<div class="form-group">
							<label for="cboNvlId">Nivel:</label>
							<select class="form-control" name="cboNvlId" id="cboNvlId">
							<?php foreach ($nivel as $item) { ?>
								<option value="<?php echo $item["nvlId"]; ?>"><?php echo $item["nvlNivel"]; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="cboEmpId">Maestro guía:</label>
							<select class="form-control" name="cboEmpId" id="cboEmpId">
							<?php foreach ($empleado as $emp) { ?>
								<option value="<?php echo $emp["empId"]; ?>"><?php echo $emp["nombre"]; ?></option>
							<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<label for="cboTurId">Turno:</label>
							<select class="form-control" name="cboTurId" id="cboTurId">
							<?php foreach ($turno as $tur) { ?>
								<option value="<?php echo $tur["turId"]; ?>"><?php echo $tur["turNombre"]; ?></option>
							<?php } ?>
							</select>
						</div>
						
						
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