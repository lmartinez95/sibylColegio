<?php if ($this->session->flashdata('mensaje')) { ?>
	<div>
		<p class="message" id="message">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</p>
	</div>
<?php }
 ?>
<div class="table-responsive">
	<form name="frmNota" id="frmNota" action='alumno/detNota' method="POST" enctype="multipart/form-data">
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
						<td><button type="submit" class="btn btn-primary pull-right" onclick="doPostBack(<?php echo $result["grpId"] . ',' . $alm; ?>)" id="nota"><i class="far fa-eye"></i> Ver nota</button></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<input type="hidden" name="alm" id="alm" value="">
		<input type="hidden" name = "grp" id="grp" value="">
	</form>
	<div id="mensaje"></div>
</div>
<div class="table-responsive" id="tblNota" style="display: none">
	<table class="table">
		<thead>
			<th>Evaluación</th>
			<th>Porcentaje</th>
			<th>Nota</th>
		</thead>
		<tbody id="notas"></tbody>
	</table>
</div>
<div id="loading" class="align-middle" style="display: none;position: fixed; z-index:100; top:45%;">
	<div class="align-middle progress">
		<img id="Image1" src="<?php echo base_url(); ?>assets/images/roller.gif" />
		<h4> <span id="LbProceso">Cargando Notas</span></h4>
	</div>
</div>
<script type="text/javascript">
	var doPostBack = function(grp, alm){
		$("#alm").val(alm);
		$("#grp").val(grp);
		$("#frmNota").submit(function(event){
			event.preventDefault();			
			$.ajax({
				url:$(this).attr("action"),
				type:$(this).attr("method"),
				data:$(this).serialize(),
				dataType: 'json',
				beforeSend: function(){
					$('#frmNota').find('input, textarea, button, select').attr('disabled',true);
					//$( "#loading" ).width( dimension.clientWidth );
					$( "#loading" ).height( '416' );
					$("#loading").show();
				},
				complete: function(response){
					$("#loading").hide();
					$('#frmNota').find('input, textarea, button, select').attr('disabled',false);
				},
				success: function(response) {
					if (response.status) {
						var fila, promedio = 0;
						$('#notas').empty().append('');
						$.each( response.data, function( key, value ) {
							promedio += parseFloat(value.notTot);
							fila = '<tr id="fila"><td>'+value.evaNombre+'</td><td>' + value.notPorcentaje + '</td><td>'+ value.nota +'</td></tr>';
							$('#notas').append(fila);
						});
						fila = '<tr id="fila"><th>Promedio</th><th>' + promedio + '</th></tr>';
						$('#notas').append(fila);
						$("#tblNota").show();
					} else if(response.status == false){
						//$('#notas').hide();
						document.getElementById("mensaje").innerHTML = "<div class='alert alert-danger'><strong>¡Error!</strong> Nada</div>";
					}else{
						document.getElementById("mensaje").innerHTML = "<div class='alert alert-danger'><strong>¡Error!</strong> </div>";
					}
				} //success
			});//ajax
			return false;
		});
	};

	/*function __doPostBack(eventTarget, eventArgument) {
		
		
		
		
		if (!theForm.onsubmit || (theForm.onsubmit() != false)) {
			theForm.__EVENTTARGET.value = eventTarget;
			theForm.__EVENTARGUMENT.value = eventArgument;
			theForm.submit();
		}
	}*/
</script>