<div class="container">
		<?php if (isset($mensaje)) { ?>
				<div <?php echo "class='alert alert-" . $nivel . "'";?>>
				  	<?php echo $mensaje;?>.
				</div>
		<?php } ?>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Alumno</th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($results as $result) { ?>
						<tr>
							<td><?php echo $result["nombre"]; ?></td>
							<td><a class="btn btn-outline-danger" href="#" data-toggle="modal" data-tooltip="tooltip" data-placement="top" data-target="<?php echo "#Eliminar" . $result["almId"]; ?>" title="Eliminar"><i class="far fa-trash-alt"></i></a> </td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<?php foreach ($results as $result) { ?>
			<!-- The Modal -->
			<div class="modal fade" id="Eliminar<?php echo $result["almId"]; ?>">
			 	<div class="modal-dialog modal-lg">
			    	<div class="modal-content">

			     		<!-- Modal Header -->
				    	<div class="modal-header">
				        	<h4 class="modal-title">Eliminar registro</h4>
				        	<button type="button" class="close" data-dismiss="modal">&times;</button>
				    	</div>

					    <!-- Modal body -->
					    <div class="modal-body">
					    	¿Desea desinscribir el alumno <?php echo $result["nombre"]; ?> permanentemente?
					    </div>

					    <!-- Modal footer -->
					    <div class="modal-footer">
					    	<a class="btn btn-danger" href=<?php echo base_url()."grupo/eliminar_alm/" . $result["almId"]; ?> ><i class="fas fa-ban"></i> Eliminar</a>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
					    </div>

			    	</div>
				</div>
			</div>

			<!-- Modal de agregar notas-->
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
									echo form_open('grupo/addNota'); ?>
										
									<div class="form-group">
										<label for="txtNota1">Tareas:</label>
										<input type="number" class="form-control" name="txtNota1" id="txtNota1" placeholder="0.0" value='0.0'  autocomplete="off" require autofocus min="0.0" max="10.0" value="0.1">
									</div>
									<div class="form-group">
										<label for="txtNota2">Exámen Corto:</label>
										<input type="number" class="form-control" name="txtNota2" id="txtNota2" placeholder="0.0" autocomplete="off" require min="0.0" max="10.0" value="0.1">
									</div>
									<div class="form-group">
										<label for="txtNota3">Tarea integradora:</label>
										<input type="number" class="form-control" name="txtNota3" id="txtNota3" placeholder="0.0" autocomplete="off" require min="0.0" max="10.0" value="0.1">
									</div>
									<div class="form-group">
										<label for="txtNota4">Tarea grupal:</label>
										<input type="number" class="form-control" name="txtNota4" id="txtNota4" placeholder="0.0" autocomplete="off" require min="0.0" max="10.0" value="0.1">
									</div>
									<div class="form-group">
										<label for="txtNota5">Exámen de período:</label>
										<input type="number" class="form-control" name="txtNota5" id="txtNota5" placeholder="0.0" autocomplete="off" require min="0.0" max="10.0" value="0.1">
									</div>
										
							</div>

							<!-- Modal footer -->
							<div class="modal-footer">
								<button type="submit" class="btn btn-success" value="agregar"><i class="fas fa-plus"></i> Agregar</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
								
							</div>
							<?php echo form_close(); ?>
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


</body>
</html>