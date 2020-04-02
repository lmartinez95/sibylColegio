$(document).ready(function() {
    //Funcion de cambio de ComboBox para Departamento y Municipio
    $("#cboDptId").on('change', function(){
        var cboDptId = $(this).val();
        if(cboDptId){
            $.ajax({
                type:     'POST',
                url:      "http://127.0.0.1/sibylColegio/admin/admin/cargaMunicipio",
                data:     'dptId=' + cboDptId,
                dataType: 'json',
                success:function(response){
                    var o;
                    $('#cboMunId').empty().append('');
                    $('#cboMunId').append('<option value="0">MUNICIPIO</option>');
                    $.each( response, function( key, value ) {
                        o = new Option(value.munNombre, value.munId);
                        $(o).html(value.munNombre);
                        $('#cboMunId').append(o);
                    }); //for each
                } //success
            }); //ajax
        } else{
            $('#cboMunId').empty().append('');
            $('#cboMunId').append('<option value="0">MUNICIPIO</option>');
        } //if
    }); //function
});