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
    $('.card__share > a').on('click', function (e) {
        e.preventDefault() // prevent default action - hash doesn't appear in url
        $(this).parent().find('div').toggleClass('card__social--active');
        $(this).toggleClass('share-expanded');
    });

    $('#cb1').attr('checked', true);
    $(".button-actualizar").addClass("hide");
//    $(".button-nuevo").addClass("hide");

    $("#loading").addClass('hide');
    $("#id_topico").attr('required', 'required');

    get_data();

    $('#nuevo-clean').click(function () {
        $('#titulo_content').val('');
        $('#post_to_enmbedded_text').val('');
        $("#idImagenPerfil").attr("src", 'https://placehold.it/300x200');
        $('#id_topico').val('');
        $('#referencias').val('');
        $('.button-actualizar').attr('data-id', '');
//        $(".button-nuevo").addClass("hide");
        $(".button-actualizar").addClass("hide");
        $(".button-agregar").removeClass("hide");
    });

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
        data.append('id_contenido', $('.button-actualizar').attr('data-id'));
        data.append('url_other_image', $("#idImagenPerfil").attr("src"));


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
            $("#div-textarea-id").show("slow");
            $("#post_to_enmbedded_text").attr("placeholder", "Escribe la idea principal de tu #tweet");
            var e = $('<strong>140</strong>');
            $("#count-caracter").html(e);
        } else if ($(this).val() == 'instagram') {
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

function editContent(value)
{
    var data = new FormData();
    data.append('editContent', true);
    data.append('value_edit', value);

    $.ajax({
        url: '../controllers/escritor/controller_e.php',
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {

            document.forms[0].reset();
            $(".button-agregar").addClass("hide");
            $(".button-actualizar").removeClass("hide");
            $(".button-nuevo").removeClass("hide");

            $("#loading").addClass('hide');
            var obj = JSON.parse(respuesta);
            $('#titulo_content').val(obj[0].titulo);
            $('#post_to_enmbedded_text').val(obj[0].post_to_enmbedded_text);
            $("#idImagenPerfil").attr("src", obj[0].path_source);
            $('#id_topico').val(obj[0].id_topico);
            $('#referencias').val(obj[0].referencias);

            //agregar el id para actualizar
            $('.button-actualizar').attr('data-id', obj[0].id_contenido);

            $('input:radio').each(function () {
                var $this = $(this),
                        id = $this.attr('id'),
                        name = $this.attr('name'),
                        value = $this.attr('value');

                if (($(this).val() == 'facebook') && (obj[0].red_social == 'facebook')) {
                    $(this).attr('checked', true);
                    $('input[name="red_social"][value="twitter"]').attr('checked', false);
                    $('input[name="red_social"][value="instagram"]').attr('checked', false);
                    $("#div-textarea-id").show("slow");
                    $("#post_to_enmbedded_text").attr("placeholder", "Escribe la idea principal de tu post");
                    var e = $('<strong>250</strong>');
                    $("#count-caracter").html(e);
                } else if (($(this).val() == 'twitter') && (obj[0].red_social == 'twitter')) {
                    $(this).attr('checked', true);
                    $('input[name="red_social"][value="facebook"]').attr('checked', false);
                    $('input[name="red_social"][value="instagram"]').attr('checked', false);
                    $("#div-textarea-id").show("slow");
                    $("#post_to_enmbedded_text").attr("placeholder", "Escribe la idea principal de tu #tweet");
                    var e = $('<strong>140</strong>');
                    $("#count-caracter").html(e);
                } else if (($(this).val() == 'instagram') && (obj[0].red_social == 'instagram')) {
                    $(this).attr('checked', true);
                    $('input[name="red_social"][value="facebook"]').attr('checked', false);
                    $('input[name="red_social"][value="twitter"]').attr('checked', false);
                    $("#div-textarea-id").hide("slow");
                }

            });

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

function deleteContenido(value)
{
    bootbox.confirm({
        message: "Esta seguro de eliminar este contenido? No se puede deshacer la accion.",
        buttons: {
            confirm: {
                label: '<i class="fa fa-check"></i> Confirm'
            },
            cancel: {
                label: '<i class="fa fa-times"></i> Cancel'
            }
        },
        callback: function (result) {
            if (result) {
                var data = new FormData();
                data.append('deleteContent', true);
                data.append('value_delete', value);

                $.ajax({
                    url: '../controllers/escritor/controller_e.php',
                    type: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (respuesta) {
                        setTimeout(function () {
                            $("#loading").addClass('hide');
                            var obj = JSON.parse(respuesta);

                            $('#load-datos-contenido').html(obj.contenido_con_desc);
                            $('#count-contenido').html(obj.total_contenido);
                            bootbox.alert("contenido eliminado!", () =>
                                console.log('This was logged in the callback!')
                            );
                        }, 100);
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
        }
    });
}

function modalPreview(json)
{
    var data = new FormData();
    data.append('getMD5info', true);
    data.append('md5info', json);
    
    $.ajax({
        url: '../controllers/escritor/controller_e.php',
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {
            var obj = JSON.parse(respuesta);
            $('.border-tlr-radius').html('<img src="http://lorempixel.com/400/200/sports/" alt="image" class="border-tlr-radius">');
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

