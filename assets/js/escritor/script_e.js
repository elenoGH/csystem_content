
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$(document).on("ready", scripts_escritor);

function scripts_escritor(event)
{
    globalEsArticuloEscritor = true;
    getSeries();
    function getSeries()
    {
        event.preventDefault();
        var data = new FormData();
        data.append('get_series', true);

        $.ajax({
            url: '../controllers/escritor/controller_e.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (respuesta) {
                //en caso de deshabilitar el dropdown de series
                //$('#id_serie').attr('disabled', true).find('option').remove();
                //$('#id_serie').attr('disabled', false).find('option').remove();
//                console.log(respuesta);
                var obj = JSON.parse(respuesta);
                $('#id_serie').find('option').remove();
                $('#id_serie').append($("<option></option>").attr("value",0).text("--Series"));
                
                $.each(obj, function(key, val){
                    $('#id_serie').append($("<option></option>").attr("value",val.id_serie).text(val.titulo_serie));
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
    //$(".series-escritor").addClass("hide");
    
    $('.tab-pane-type-action').click(function () {
        if($(this).attr('data-id') == 1){
            globalEsArticuloEscritor = true;
            $('.series-escritor').removeClass('hide');
        } else {
            globalEsArticuloEscritor = false;
            $('.series-escritor').addClass('hide');
        }
    });    

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
                    var str_series = renderViewSeries(obj.series_escritor);
                    $('#load-datos-series').html(str_series);
                    $('[data-toggle="tooltip"]').tooltip();
                        $('.add-cont-to-serie').click(function () {
                            $('a[href="#misarticulos"]').tab('show');
                            $('.series-escritor').removeClass('hide');
                            globalEsArticuloEscritor = true;
                            $('#id_serie').val($(this).attr('data-id'));
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
        data.append('id_serie', $('#id_serie').val());
        data.append('esarticulo', globalEsArticuloEscritor);
        data.append('valor_precio', $('#valor_precio').val());
        
        $.ajax({
            url: '../controllers/escritor/controller_e.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (respuesta) {
                if (!globalEsArticuloEscritor) {
                    getSeries();
                }
//                console.log(respuesta);
                setTimeout(function () {
                    $("#loading").addClass('hide');
                    //location.reload();
                    var obj = JSON.parse(respuesta);

                    $('#load-datos-contenido').html(obj.contenido_con_desc);
                    $('#count-contenido').html(obj.total_contenido);
                    var str_series = renderViewSeries(obj.series_escritor);
                    $('#load-datos-series').html(str_series);
                    $('[data-toggle="tooltip"]').tooltip();
                        $('.add-cont-to-serie').click(function () {
                            $('a[href="#misarticulos"]').tab('show');
                            $('.series-escritor').removeClass('hide');
                            globalEsArticuloEscritor = true;
                            $('#id_serie').val($(this).attr('data-id'));
                        });
                    bootbox.alert("Acción Satisfactoria!", function () {
                        $('#titulo_content').val('');
                        $('#post_to_enmbedded_text').val('');
                        $("#idImagenPerfil").attr("src", '');
                        $('#id_topico').val('');
                        $('#referencias').val('');
                        $('.button-actualizar').attr('data-id', '');
                        $(".button-actualizar").addClass("hide");
                        $(".button-agregar").removeClass("hide");
                        $('#valor_precio').val(0);
                    });
                }, 500);
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
            $("#post_to_enmbedded_text").attr("placeholder", "post");
            var e = $('<strong>140</strong>');
            $("#count-caracter").html(e);
        } else if ($(this).val() == 'twitter') {
            $("#div-textarea-id").show("slow");
            $("#post_to_enmbedded_text").attr("placeholder", "#tweet");
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
            $('#valor_precio').val(obj[0].precio_contenido);
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
                    var e = $('<strong>140</strong>');
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

function deleteSerie (idSerie)
{
        bootbox.confirm({
        message: "Esta seguro de eliminar esta serie? Todos Los Contenidos Asociados en esta Serie Serán Borrados!.",
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
                data.append('deleteContentSerie', true);
                data.append('id_serie_delete', idSerie);

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
                            var str_series = renderViewSeries(obj.series_escritor);
                            $('#load-datos-series').html(str_series);
                            $('[data-toggle="tooltip"]').tooltip();
                                $('.add-cont-to-serie').click(function () {
                                    $('a[href="#misarticulos"]').tab('show');
                                    $('.series-escritor').removeClass('hide');
                                    globalEsArticuloEscritor = true;
                                    $('#id_serie').val($(this).attr('data-id'));
                                });
                            bootbox.alert("Sontenido eliminado!", function(){
//                                console.log('This was logged in the callback!')
                            });
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
//                            var str_series = renderViewSeries(obj.series_escritor);
//                            $('#load-datos-series').html(str_series);
                            bootbox.alert("Contenido eliminado!", function(){
//                                console.log('This was logged in the callback!')
                            });
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
            var dt = new Date(obj.created_date*1000);
            var date_format = dt.getDay() + '/' + dt.getMonth() + '/' + dt.getFullYear();
            $('.border-tlr-radius').html('<img src="'+obj.path_source+'" alt="image" class="border-tlr-radius">');
            $('.card__article').html('<h2><a href="#">'+obj.titulo+'</a></h2>\n\
                                    <p>'+obj.post_to_enmbedded_text+'</p>');
            $('.card__meta').html('<a href="'+obj.referencias+'" target="_blank">Referencia</a>\n\
                                    <time>'+date_format+'</time>');
            

        },
        error: function (result)
        {
            alert(JSON.stringify(result));
        },
        fail: function (status) {
        },
        beforeSend: function (d) {
//            $("#loading").removeClass('hide');
        }
    });
}

function renderViewSeries(arrayObj)
{
    var str_series = '';
    var inirow = '';
    var findivrow = '';
    var count = 0;
    $.each(arrayObj, function (key, val) {
        var lis_string = '';
        $.each(val.data_by_serie, function (k1, v1) {
            lis_string = lis_string
                + '<li>'
                    + 'Artículo: <a href="#">'+v1.titulo+'</a>'
                    + '&nbsp;<i class="fa fa-eye" aria-hidden="true" '
                             + 'style="cursor: pointer" '
                             + 'data-toggle="modal" '
                             + 'data-target=".preview-redsocial" '
                             + 'onclick="modalPreview(\'' + v1.json_by_series_content + '\')"></i>'
                + '</li>';
        });
        if (count == 1) {
             inirow = '';
             findivrow = '</div>';
            count--;
        }else {
             inirow = '<div class="row">';
             findivrow = '';
            count++;
        }
        srcRedSocial = '';
        if (val.red_social == 'facebook') {
            srcRedSocial = '../../assets/images/fb.png';
        }else if (val.red_social == 'twitter') {
            srcRedSocial = '../../assets/images/tw.png';
        } else if (val.red_social == 'instagram') {
            srcRedSocial = '../../assets/images/in.png';
        }
        str_series = str_series+inirow+'<div class="col-md-3">'
            + '<button type="button" class="close" data-dismiss="modal" onclick="deleteSerie('+val.id_serie+')" aria-label="Close">'
                + '<span aria-hidden="true">&times;</span>'
            + '</button>'
            + '<img  src="'+val.path_source+'" width="100%" >'
        + '</div>'
        + '<div class="col-md-3">'
            + '<h4><img src="'+srcRedSocial+'" width="21" height="21">&nbsp;'+val.titulo_serie+'</h4>'
            + '<p>'+val.desc_serie+'</p>'
            + '<br/>'
            + '<h6>Agregar Contenido</h6>'
            + '&nbsp;<a href="#"><i class="fa fa-plus add-cont-to-serie" aria-hidden="true" \n\
               style="cursor: pointer" data-toggle="tooltip" data-placement="right" title="Agregar Contenido" data-id="'+val.id_serie+'"></i></a>'
            + '<ul>'
                + lis_string
            + '</ul>'
            + '<br/>'
            + '<footer class="mt-20">'
                + '<cite title="Source Title">'
                    + '<b>Autor: &nbsp;</b>' + val.nombreUser
                    + '<a href="#"></a>'
                + '</cite><br>'
                + '<cite title="Source Topico">'
                    + '<b>Topico: &nbsp;</b>' + val.nameTopico
                    + '<a href="#"></a>'
                + '</cite><br>'
                + '<cite title="Source Estatus">'
                    + '<b>Estatus: &nbsp;</b>' + val.estatus
                    + '<a href="#"></a>'
                + '</cite><br>'
//                + '<a class="gototop gototop-button" href="#">'
//                    + '<i class="fa fa-pencil" aria-hidden="true" style="cursor: pointer" onclick="editSerie('+val.id_serie+')"></i>'
//                + '</a>'
                //+ '&nbsp;<i class="fa fa-eye" aria-hidden="true" style="cursor: pointer" data-toggle="modal" data-target=".preview-redsocial"></i>'
//                +'&nbsp;<a href="" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true" style="cursor: pointer"></i></a>'
            + '</footer>'
        + '</div>'
        +findivrow;
    });
    return str_series;
}