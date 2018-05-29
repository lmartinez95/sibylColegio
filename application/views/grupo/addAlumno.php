<div class="container">
    <?php echo validation_errors();
	echo form_open('grupo/inscribir', array('id' => 'frmInscribir')); ?>
        <div class='form-group'>
            <div class="row">
				<div class="col-md-6">
					<select multiple class="form-control" name="almOrigen" id="almOrigen">
						<?php foreach ($alumno as $result) { ?>
									<option value=<?php echo $result['almId']; ?>><?php echo $result["nombre"]; ?></option>
							<?php } ?>
					</select>
				</div>
				<div class="col-md-1">
					<input type="button" name="" class="btn btn-outline-success" onclick="agregar()" value=">>">
					<input type="button" name="" class="btn btn-outline-danger" onclick="quitar()" value="<<">
				</div>
				<div class="col-md-5">
					<select multiple class="form-control" name="almDestino" id="almDestino"></select>
				</div>
			</div>
        </div>
        <input type="hidden" name="alumno" id="alumno" value="">
        <input type="hidden" name="grupo" id="grupo" value=<?php echo $grupo; ?>>
        <button type="button" class="btn btn-outline-primary" name="btnGuardar" onclick="enviar()">Guardar</button>
	<?php echo form_close(); ?>	
</div>
<script type="text/javascript">
    var arreglo = new Array();
    function agregar() {
        origen = document.getElementById('almOrigen');
        if (origen.selectedIndex == -1) return;
        valor = origen.value;
        texto = origen.options[origen.selectedIndex].text;
        origen.options[origen.selectedIndex] = null;
        destino = document.getElementById('almDestino');
        opc = new Option(texto, valor);
        eval(destino.options[destino.options.length] = opc);
        arreglo.push(valor);
    }

    function quitar() {
        origen = document.getElementById('almDestino');
        if (origen.selectedIndex == -1) return;
        valor = origen.value;
        texto = origen.options[origen.selectedIndex].text;
        origen.options[origen.selectedIndex] = null;
        destino = document.getElementById('almOrigen');
        opc = new Option(texto, valor);
        eval(destino.options[destino.options.length] = opc);
        arreglo.splice(arreglo.indexOf(valor), 1);
    }

    function enviar() {
        document.getElementById("alumno").value = arreglo;
        document.getElementById('frmInscribir').submit();
    }
</script>    
</body>
</html>