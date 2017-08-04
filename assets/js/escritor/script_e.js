//(function (d, s, id) {
//    var js, fjs = d.getElementsByTagName(s)[0];
//    if (d.getElementById(id))
//        return;
//    js = d.createElement(s);
//    js.id = id;
//    js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
//    fjs.parentNode.insertBefore(js, fjs);
//}(document, 'script', 'facebook-jssdk'));
//
//window.twttr = (function(d, s, id) {
//  var js, fjs = d.getElementsByTagName(s)[0],
//    t = window.twttr || {};
//  if (d.getElementById(id)) return t;
//  js = d.createElement(s);
//  js.id = id;
//  js.src = "https://platform.twitter.com/widgets.js";
//  fjs.parentNode.insertBefore(js, fjs);
//
//  t._e = [];
//  t.ready = function(f) {
//    t._e.push(f);
//  };
//
//  return t;
//}(document, "script", "twitter-wjs"));

$(document).on("ready", scripts_escritor);

function scripts_escritor(event)
{
    $("#loading").addClass('hide');
    $("#id_topico").attr('required', 'required');
    
    get_data();

    function get_data()
    {
        event.preventDefault();
        var data = new FormData();
        data.append('get_data', true);

        $.ajax({
            url: '../controllers/escritor/controller_e.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (respuesta) {
//            console.log(respuesta);
                setTimeout(function () {
                    $("#loading").addClass('hide');
                    //location.reload();
                    var obj = JSON.parse(respuesta);
                    $('#load-datos-contenido').html(obj.contenido_con_desc);
                    $('#count-contenido').html(obj.total_contenido);
                    
                }, 1000);
            },
            error: function (result)
            {
                alert(JSON.stringify(result));
            },
            fail: function (status) {
            },
            beforeSend: function (d) {
                $("#loading").removeClass('hide');
            }
        });
    }

    $('form').on('submit', function (event)
    {
        event.preventDefault();
        var data = new FormData();
        data.append('data_up', true);
        data.append('titulo_content', $('#titulo_content').val());
        data.append('post_to_enmbedded_text', $('#post_to_enmbedded_text').val());
        data.append('file_update', $('input[type=file]')[0].files[0]);
        data.append('red_social', $(this).find('input[name=red_social]:checked').val());
        data.append('id_topico', $('#id_topico').val());
        data.append('referencias', $('#referencias').val());

        $.ajax({
            url: '../controllers/escritor/controller_e.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (respuesta) {
                console.log(respuesta);
                setTimeout(function () {
                    $("#loading").addClass('hide');
                    //location.reload();
                    var obj = JSON.parse(respuesta);

                    $('#load-datos-contenido').html(obj.contenido_con_desc);
                    $('#count-contenido').html(obj.total_contenido);
                    
                    bootbox.alert("Acción Satisfactoria!", function () {
                        console.log('This was logged in the callback!');
                    });
                }, 1000);
            },
            error: function (result)
            {
                alert(JSON.stringify(result));
            },
            fail: function (status) {
            },
            beforeSend: function (d) {
                $("#loading").removeClass('hide');
            }
        });

    });

    $('#post_to_enmbedded_text').on('keyup', function (e) {
        var limit = 140;
        var value = e.target.value.length
        var result = limit - value;
        result = (result <= 0) ? result = 0 : result;
        if (result <= 0) {
            $('#count-caracter').html('<strong>' + result + '</strong>').append('&nbsp;<i class="fa fa-times" aria-hidden="true"></i>').css('color', 'red');
        } else {
            $('#count-caracter').html('<strong>' + result + '</strong>').append('&nbsp;<i class="fa fa-check" aria-hidden="true"></i>').css('color', 'green');
        }
    });

    $("#div-textarea-id").show("slow");
    $('input:radio').change(function () {
        if ($(this).val() == 'facebook') {
//            document.forms[0].reset();
            $("#div-textarea-id").show("slow");
            $("#post_to_enmbedded_text").attr("placeholder", "Escribe la idea principal de tu post");
            var e = $('<strong>250</strong>');
            $("#count-caracter").html(e);
        } else if ($(this).val() == 'twitter') {
//            document.forms[0].reset();
            $("#div-textarea-id").show("slow");
            $("#post_to_enmbedded_text").attr("placeholder", "Escribe la idea principal de tu #tweet");
            var e = $('<strong>140</strong>');
            $("#count-caracter").html(e);
        } else if ($(this).val() == 'instagram') {
//            document.forms[0].reset();
            $("#div-textarea-id").hide("slow");
        }
    });
    $(document).on('change', 'input[type="file"]', function (e) {
        readURL(this);
    });

    getTopicos();
    function getTopicos()
    {
        event.preventDefault();
        var data = new FormData();
        data.append('get_topicos', true);

        $.ajax({
            url: '../controllers/escritor/controller_e.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                var obj = JSON.parse(res);


                $('#id_topico').attr('disabled', false).find('option').remove();
                $('#id_topico').append($("<option></option>").attr("value", '').text("-- Topicos"));

                $.each(obj, function (key, val) {
                    $('#id_topico').append($("<option></option>").attr("value", val.id).text(val.nombre));
                });
            },
            error: function (request, status, error) {
                alert("Lo sentimos, hubo un problema\n" + status + ": " + request.status + " - " + error);
            }
        });
    }

}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#previewImgPerfil img').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}