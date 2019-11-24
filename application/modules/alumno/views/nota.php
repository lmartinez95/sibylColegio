<?php if ($this->session->flashdata('mensaje')) { ?>
	<div>
		<p class="message" id="message">
			<?php echo $this->session->flashdata('mensaje'); ?>
		</p>
	</div>
<?php }
 ?>
<div class="table-responsive">
	<form name="frmNota" id="frmNota" action="<?php echo base_url();?>alumno/detNota" method="POST" enctype="multipart/form-data">
		<table class="table">
			<thead class="thead-light">
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
						<td><button type="button" class="btn btn-primary pull-right" onclick="javascript:doPostBack(<?php echo $result['grpId'] . ',' . $alm; ?>)" id="nota"><i class="far fa-eye"></i> Ver nota</button></td>
					</tr>
				<?php } ?>
			</tbody>
		</table>
		<input type="hidden" name="alm" id="alm" value="">
		<input type="hidden" name = "grp" id="grp" value="">
		<input type="hidden" name = "n" id="n" value="0">
	</form>
	<div id="mensaje"></div>
</div>
<hr>
<div class="table-responsive table-bordered" id="tblNota" style="display: none">
	<table class="table">
		<thead class="thead-light">
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
		var cant = 0;
		$("#frmNota").click(function(event){
			event.preventDefault();					
			if ($("#n").val() == cant){
				$.ajax({
					url:$(this).attr("action"),
					type:$(this).attr("method"),
					data:$(this).serialize(),
					dataType: 'json',
					beforeSend: function(){
						var dimension = document.getElementById("frmNota");
						$('#frmNota').find('input, textarea, button, select').attr('disabled',true);
						$( "#loading" ).width( dimension.clientWidth );
						$( "#loading" ).height( dimension.clientHeight );
						$("#loading").show();
					},
					complete: function(response){
						$("#loading").hide();
						$('#frmNota').find('input, textarea, button, select').attr('disabled',false);
					},
					success: function(response) {
						$('#notas').empty().append('');
						if (response.status) {
							var fila = '', promedio = 0;
							$.each( response.data, function( key, value ) {
								promedio += parseFloat(value.notTot);
								fila += '<tr id="fila"><td>'+value.evaNombre+'</td><td>' + value.notPorcentaje + '</td><td>'+ value.nota +'</td></tr>';
								
							});
							fila += '<tr id="fila"><th>Promedio</th><th>' + promedio + '</th></tr>';
							$('#notas').append(fila);
							$("#tblNota").show();
							$("#notas").show();
							document.getElementById("mensaje").innerHTML = "";
							
						} else if(response.status == false){
							$("#tblNota").show();
							//$('#notas').hide();
							$('#notas').empty().append('');$('#notas').append('<tr><td>No hay notas</td></tr>');
							//document.getElementById("mensaje").innerHTML = "<div class='alert alert-danger'><strong>¡Error!</strong> Nada</div>";
						}else{
							document.getElementById("mensaje").innerHTML = "<div class='alert alert-danger'><strong>¡Error!</strong> </div>";
						}
					} //success
				});//ajax
				cant++; $("#n").val( cant );
			}//fin if
			console.log($("#n").val() + ',' + cant);
			return false;
		});
	};
</script>