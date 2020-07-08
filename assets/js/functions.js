$(document).ready(function() {
    const base_url =  "http://127.0.0.1/sibylColegio/";

    //Función para Cerrar Sesiónss
    $("#btnLogout").click(function() {
        $.ajax({
            url: base_url.concat('login/logout'),
            beforeSend: function(){
                $("#lblProceso").html = "Cerrando Sesión";
                document.getElementById("lblProceso").innerHTML = "Cerrando Sesión";
                $("#loading").show();
              },
            success: function(response){
                if (response.status) {
                    document.location.href = response.redirect;
                }
            }
        });
    });

    //Funcion de cambio de ComboBox para Departamento y Municipio
    $("#cboDptId").on('change', function(){
        var cboDptId = $(this).val();
        if(cboDptId){
            $.ajax({
                type:     'GET',
                url:      base_url.concat("admin/admin/cargaMunicipio"),
                data:     {dptId: cboDptId},
                dataType: 'JSON',
                beforeSend: function(){
                    $("#loading").show();
                },
                success:function(response){
                    var o;
                    $('#cboMunId').empty().append('');
                    $('#cboMunId').append('<option value="0">MUNICIPIO</option>');
                    $.each( response, function( key, value ) {
                        o = new Option(value.munNombre, value.munId);
                        $(o).html(value.munNombre);
                        $('#cboMunId').append(o);
                    }); //for each
                    $("#loading").hide();
                } //success
            }); //ajax
        } else{
            $('#cboMunId').empty().append('');
            $('#cboMunId').append('<option value="0">MUNICIPIO</option>');
        } //if
    }); //function

    //Función para autocompletar
    $("#txtEvaluacion").autocomplete({
        source: base_url.concat("docente/autoEvaluacion")
    });

    //Función para confirmación de eliminar
    (function(){
        $("tr td #btnEliminar").click(function(ev) {
            var nombre = $(this).parents('tr').find('td:eq(1)').text();
            var id = $(this).attr('data-id');
            var url = $("#btnConfirm").attr('data') + id;
            $("#data").text(nombre);
            $("#btnConfirm").attr('href', url);
        })
    })();
});