$(document).on("ready", general);

function general()
{
    $( "#selectTypeUser_registro" ).change(function() {
        var textInLabel = 'Nickname';
        if ($( this ).val() == 3) {
            textInLabel = 'Usuario';
        }
        //$('#labelId-registrar').html(textInLabel);
        $("#nombreUsuario").attr("placeholder", textInLabel);
    });
    $( "#selectTypeUser_login" ).change(function() {
        var textInLabel = 'Nickname ó Correo';
        if ($( this ).val() == 3) {
            textInLabel = 'Usuario ó Correo';
        }
        //$('#labelId-login').html(textInLabel);
        $("#inputEmail").attr("placeholder", textInLabel);
    });
}