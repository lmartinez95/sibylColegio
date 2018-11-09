<?php if ($this->session->flashdata('mensaje')) { ?>
	<div>
		<p class="message" id="message">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</p>
	</div>
<?php }
 ?>
<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>Código</th>
				<th>Materia</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $result) { ?>
				<tr>
					<td><?php echo $result["matCodigo"]; ?></td>
					<td><?php echo $result["matNombre"]; ?></td>
					<td><a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-placement="top" data-target="#agregar"><i class="far fa-eye"></i> Ver nota</a></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>