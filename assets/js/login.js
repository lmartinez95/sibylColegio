
$(document).ready(function(){
    $("#btnLogout").click(function() {
        $.ajax({
            url: 'http://127.0.0.1/sibylColegio/login/logout',
            success: function(response){
                if (response.status) {
                    document.location.href = response.redirect;
                }
            }
        });
    });
});