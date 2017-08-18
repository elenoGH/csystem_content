$(document).on("ready", scripts_cliente);
var totalComprasCliente = 0;

function scripts_cliente(event)
{
    getAllAutores()
    
    function getAllAutores()
    {
        event.preventDefault();
        var data = new FormData();
        data.append('get_all_autores', true);
        $.ajax({
            url: '../../controllers/cliente/controller_c.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (respuesta) {
                
                var obj = JSON.parse(respuesta);
                
                var countArticulos = 0;
                var countSeries = 0;
                
                $.each(obj.array_autores, function (key, autor_obj) {
                    if (autor_obj.articulos_usuario != undefined) {
                        countArticulos = countArticulos + Object.keys(autor_obj.articulos_usuario).length;
                        
                        $.each(autor_obj.articulos_usuario, function(llaveArt, objArt){
                            if(objArt.id_compra != null && obj.id_cliente == objArt.id_cliente_comp) {
                                totalComprasCliente++;
                            }
                        });
                    }
                    if (autor_obj.series_usuario != undefined ) {
                        countSeries = countSeries + Object.keys(autor_obj.series_usuario).length;
                        $.each(autor_obj.series_usuario, function(llaveSerie, objSerie){
                            if(objSerie.id_compra != null && obj.id_cliente == objSerie.id_cliente_comp) {
                                totalComprasCliente++;
                            }
                        });
                    }
                });
                
                $('#load-datos-autores').html(obj.structure_view);
                $('#count-autores').html("Autores &nbsp;<span class='badge'>"+Object.keys(obj.array_autores).length+"</span>");
                $('#count-articulos').html("<b>Total Artículos </b><br/>"+countArticulos);
                $('#count-series').html("<b>Total Series</b><br/>"+countSeries);
                $('#total-compras-cliente').html('Mis Compras &nbsp; <span class="badge alert-danger">'+totalComprasCliente+'</span>');
                
                $("#loading").addClass('hide');
                
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

function viewContentAutor(generales_autor, articulos_usuario, series_usuario)
{
    var data = new FormData();
    data.append('getMD5info', true);
    data.append('md5info_generales_autor', generales_autor);
    data.append('md5info_articulos_usuario', articulos_usuario);
    data.append('md5info_series_usuario', series_usuario);
    
    $.ajax({
        url: '../../controllers/cliente/controller_c.php',
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {
            var obj = JSON.parse(respuesta);
            var objs_generales_autor = '';
            if (obj.generales_autor != '') {
                objs_generales_autor = JSON.parse(obj.generales_autor);
            }
            var objs_articulos_usuario = '';
            var viewArt = '';
            if (obj.articulos_usuario != '') {
                objs_articulos_usuario = JSON.parse(obj.articulos_usuario);
                viewArt = renderViewArticulos(objs_articulos_usuario);
            }
            var objs_series_usuario = '';
            var viewSeries = '';
            if (obj.series_usuario != '') {
                objs_series_usuario = JSON.parse(obj.series_usuario);
                viewSeries = renderViewSeries(objs_series_usuario);
            }
            
            $('#section-view-articulos').html(viewArt);
            $('#section-view-series').html(viewSeries);
            

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

function renderViewArticulos(objs_articulos_usuario)
{
    var head_view = '<div class="container mt-20">\n\
                        <div class="col-md-6 text-uppercase">\n\
                            <h4>Artículos</h4>\n\
                        </div>\n\
                        <div class="col-md-6">\n\
                        </div>\n\
                        <div class="clearfix">...</div>\n\
                    </div>';
    
    var finview_content = '';
    var count = 0;
    
    $.each(objs_articulos_usuario, function(key, articulo){
        
        if (count == 1){
            initcontainer = '';
            fincontainer = '<hr /></div><div class="clearfix">...</div>';
            count--;
        }else {
            initcontainer = '<div class="container">';
            fincontainer = '';
            count++;
        }
        srcRedSocial = '';
        if (articulo.red_social == 'facebook') {
            srcRedSocial = '../../../assets/images/fb.png';
        }else if (articulo.red_social == 'twitter') {
            srcRedSocial = '../../../assets/images/tw.png';
        } else if (articulo.red_social == 'instagram') {
            srcRedSocial = '../../../assets/images/in.png';
        }
        var compraIcon = '&nbsp;<strong>Comprado</strong>';
        var ponerPrecio = '';
        var styleComprado = 'style="color: green;"';
        var iconPalomitaComprado = '&nbsp;<i class="fa fa-check" aria-hidden="true"></i>';
        
        if (articulo.id_compra == null) {
            compraIcon = '&nbsp;<i class="fa fa-shopping-cart" aria-hidden="true" style="cursor: pointer" onclick="addCarritoComprar('+articulo.id+', '+articulo.id_usuario+', 1)"></i>';
            ponerPrecio = articulo.precio_contenido+'$ ';
            styleComprado = '';
            iconPalomitaComprado = '';
        }
        
        finview_content = finview_content+initcontainer
            + '<div class="col-lg-2">\n\
                    <img src="'+articulo.path_source+'" class="img-thumbnail" width="100%" height="100%">\n\
                </div>\n\
                <div class="col-lg-4 ">\n\
                    <h4><img src="'+srcRedSocial+'" width="21" height="21"> &nbsp;'+articulo.titulo+'</h4>\n\
                    '+articulo.post_to_enmbedded_text+'\n\
                    <footer class="mt-20">'
                        + '<div id="comprado-text-'+articulo.id+'" '+styleComprado+'>'
                        + ponerPrecio
                        + compraIcon + iconPalomitaComprado
                        + '</div>'
                        + '&nbsp;<i class="fa fa-eye" aria-hidden="true" style="cursor: pointer" data-toggle="modal" \n\
                            data-target=".preview-redsocial" onclick="modalPreview(\'' +articulo.titulo+ '\', \'' +articulo.post_to_enmbedded_text+ '\', \'' +articulo.path_source+ '\')"></i>\n\
                    </footer>\n\
                </div>'
            + fincontainer;
    
    })
    return head_view+finview_content;
}

function renderViewSeries(objs_series_usuario)
{
    var head_view = '<div class="container mt-20">\n\
                <div class="col-md-6 text-uppercase">\n\
                    <h4>Series</h4>\n\
                </div>\n\
                <div class="col-md-6">\n\
                </div>\n\
                <div class="clearfix">...</div>\n\
            </div>\n\
            <div class="clearfix">...</div>';
    var finview_content = '';
    var count = 0;
    
    $.each(objs_series_usuario, function (key, series){
        if (count == 3){
            initcontainer = '';
            fincontainer = '</div><div class="clearfix">...</div>';
            count = 0;
        }else if (count == 0){
            initcontainer = '<div class="container mt-20">';
            fincontainer = '';
            count++;
        }else {
            initcontainer = '';
            fincontainer = '';
            count++;
        }
        srcRedSocial = '';
        if (series.red_social == 'facebook') {
            srcRedSocial = '../../../assets/images/fb.png';
        }else if (series.red_social == 'twitter') {
            srcRedSocial = '../../../assets/images/tw.png';
        } else if (series.red_social == 'instagram') {
            srcRedSocial = '../../../assets/images/in.png';
        }
        var articulos = '';
        $.each(series.articulos_by_serie, function(k1, v1){
            articulos = articulos+'<b>Articulo:</b>&nbsp;'
                    +v1.titulo
                    +'&nbsp;<i class="fa fa-eye" aria-hidden="true" style="cursor: pointer" data-toggle="modal" \n\
                    data-target=".preview-redsocial" onclick="modalPreview(\'' +v1.titulo+ '\', \'' +v1.post_to_enmbedded_text+ '\', \'' +v1.path_source+ '\')"></i>'
                    +'<br/>';
        });
        
        var compraIcon = '&nbsp;<strong>Comprado</strong>';
        var ponerPrecio = '';
        var styleComprado = 'style="color: green;"';
        var iconPalomitaComprado = '&nbsp;<i class="fa fa-check" aria-hidden="true"></i>';
        
        if (series.id_compra == null) {
            compraIcon = '&nbsp;<i class="fa fa-shopping-cart" aria-hidden="true" style="cursor: pointer" onclick="addCarritoComprar('+series.id+', '+series.id_usuario+', 2)"></i>';
            ponerPrecio = series.precio_serie+'$ ';
            styleComprado = '';
            iconPalomitaComprado = '';
        }
        
        finview_content = finview_content+initcontainer
            + '<div class="col-md-3">\n\
                <h4><img src="'+srcRedSocial+'" width="21" height="21"> &nbsp; '+series.titulo+'</h4>\n\
                <img  src="'+series.path_source+'" style="height: 100%; width: 100%;" >\n\
                <footer class="mt-20">'
                    + articulos
                    + '<div id="comprado-text-'+series.id+'" '+styleComprado+'>'
                    + ponerPrecio
                    + compraIcon + iconPalomitaComprado
                    + '</div>'
                + '</footer>\n\
            </div>'
            + fincontainer;
    });
    return head_view+finview_content;
}

function modalPreview(titulo, descipcion, url_imagen)
{
    var dt = new Date();
    var date_format = dt.getDay() + '/' + dt.getMonth() + '/' + dt.getFullYear();
    $('.border-tlr-radius').html('<img src="'+url_imagen+'" alt="image" class="border-tlr-radius">');
    $('.card__article').html('<h2><a href="#">'+titulo+'</a></h2>\n\
                            <p>'+descipcion+'</p>');
    $('.card__meta').html('<time>'+date_format+'</time>');
}

function addCarritoComprar(id_contenido,id_autor, tipo)
{
    var tipo_contenido_comprado = 'serie';
    if (tipo == 1) {
        tipo_contenido_comprado = 'articulo';
    }
    
    bootbox.confirm({
        message: "Deseas comprar este contenido?",
        buttons: {
            confirm: {
                label: 'Si',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result) {
                
                var data = new FormData();
                data.append('save_compra_cliente', true);
                data.append('id_contenido', id_contenido);
                data.append('id_autor', id_autor); 
                data.append('tipo_contenido_comprado', tipo_contenido_comprado); 
                
                $.ajax({
                    url: '../../controllers/cliente/controller_c.php',
                    type: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (respuesta) {

                        var obj = JSON.parse(respuesta);
                        $('#comprado-text-'+id_contenido).html('<strong>Comprado</strong>').append('&nbsp;<i class="fa fa-check" aria-hidden="true"></i>').css('color', 'green');
                        totalComprasCliente++;
                        $('#total-compras-cliente').html('Mis Compras &nbsp; <span class="badge alert-danger">'+totalComprasCliente+'</span>');
                        $("#loading").addClass('hide');
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