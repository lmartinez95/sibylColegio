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
		<a class="btn btn-primary pull-right" href=<?php echo base_url("admin/nivel/create"); ?> ><i class="fas fa-plus"></i> Nuevo</a>
	</div>
</div>
<br />
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Abreviatura</th>
				<th>Nivel de estudio</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
				foreach ($results as $result) {
					?>
					<tr>
						<td><?php echo $result["nvlAbrev"]; ?></td>
						<td><?php echo $result["nvlNivel"]; ?></td>
						<td><a class="btn btn-outline-success" href=<?php echo base_url()."admin/nivel/edit/" . $result["nvlId"]; ?> data-toggle="tooltip" data-placement="top" title="Modificar"><i class="far fa-edit"></i></a> </td>
						<td><a class="btn btn-outline-danger" href="#" data-toggle="modal" data-tooltip="tooltip" data-placement="top" data-id="<?php echo $result["nvlId"]; ?>" data-target="#Eliminar" id="btnEliminar" title="Eliminar"><i class="far fa-trash-alt"></i></a> </td>
					</tr>
					<?php
				}
			?>
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
				¿Desea eliminar esta el nivel <strong id="data"></strong> permanentemente?
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
			<?php echo form_open('', ["id" => "frmEliminar"]); ?>
					<button type="submit" class="btn btn-danger" id="btnConfirm" data="<?php echo base_url("admin/nivel/eliminar/"); ?>" ><i class="fas fa-ban"></i> Eliminar</button>
				</form>
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