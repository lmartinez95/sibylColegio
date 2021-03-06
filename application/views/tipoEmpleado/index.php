<div class="container">
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
		<br />
		<?php if (isset($mensaje)) { ?>
				<div <?php echo "class='alert alert-" . $nivel . "'";?>>
				  	<?php echo $mensaje;?>.
				</div>
		<?php } ?>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Código</th>
						<th>Tipo de empleado</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
						foreach ($results as $result) {
							?>
							<tr>
								<td><?php echo $result["tempCodigo"]; ?></td>
								<td><?php echo $result["tempNombre"]; ?></td>
                                <td><a class="btn btn-outline-success" href=<?php echo base_url()."index.php/tipoEmpleado/update/" . $result["tempId"]; ?> data-toggle="tooltip" data-placement="top" title="Modificar"><i class="far fa-edit"></i></a> </td>
								<td><a class="btn btn-outline-danger" href="#" data-toggle="modal" data-tooltip="tooltip" data-placement="top" data-target="<?php echo "#Eliminar" . $result["tempId"]; ?>" title="Eliminar"><i class="far fa-trash-alt"></i></a> </td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<?php
			foreach ($results as $result) {	?>
			<!-- The Modal -->
			<div class="modal fade" id="Eliminar<?php echo $result["tempId"]; ?>">
			 	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">

			     		<!-- Modal Header -->
				    	<div class="modal-header">
				        	<h4 class="modal-title">Eliminar registro</h4>
				        	<button type="button" class="close" data-dismiss="modal">&times;</button>
				    	</div>

					    <!-- Modal body -->
					    <div class="modal-body">
					    	¿Desea eliminar esta el tipo <?php echo $result["tempNombre"]; ?> permanentemente?
					    </div>

					    <!-- Modal footer -->
					    <div class="modal-footer">
					    	<a class="btn btn-danger" href=<?php echo base_url()."index.php/tipoEmpleado/eliminar" . $result["tempId"]; ?> ><i class="fas fa-ban"></i> Eliminar</a>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					    </div>

			    	</div>
				</div>
			</div>
			<?php } ?>
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
	</div>
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
							echo form_open('tipoEmpleado/agregar'); ?>
								<div class="form-group">
									<label for="txtTempCodigo">Código:</label>
									<input type="text" class="form-control" name="txtTempCodigo" id="txtTempCodigo" placeholder="Código" autocomplete="off" require autofocus>
								</div>
								<div class="form-group">
									<label for="txtTempNombre">Tipo de empleado:</label>
									<input type="text" class="form-control" name="txtTempNombre" id="txtTempNombre" placeholder="Tipo de empleado" autocomplete="off" require>
								</div>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-success" value="agregar"><i class="fas fa-plus"></i> Agregar</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
						<?php echo form_close(); ?>
					</div>

				</div>
			</div>
		</div>
</body>
</html>