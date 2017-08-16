$(document).on("ready", scripts_cliente);

function scripts_cliente(event)
{
    getAllAutores()
    
    function getAllAutores()
    {
        event.preventDefault();
        var data = new FormData();
        data.append('get_all_autores', true);
        $.ajax({
            url: '../controllers/cliente/controller_c.php',
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
                    }
                    if (autor_obj.series_usuario != undefined ) {
                        countSeries = countSeries + Object.keys(autor_obj.series_usuario).length;
                    }
                });
                
                $('#load-datos-autores').html(obj.structure_view);
                $('#count-autores').html("Autores &nbsp;<span class='badge'>"+Object.keys(obj.array_autores).length+"</span>");
                $('#count-articulos').html("<b>Artículos </b><br/>"+countArticulos);
                $('#count-series').html("<b>Series</b><br/>"+countSeries);
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
        url: '../controllers/cliente/controller_c.php',
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {
            var obj = JSON.parse(respuesta);
            var objs_generales_autor = JSON.parse(obj.generales_autor);
            var objs_articulos_usuario = JSON.parse(obj.articulos_usuario);
            var objs_series_usuario = JSON.parse(obj.series_usuario);
            var viewArt = renderViewArticulos(objs_articulos_usuario);
            var viewSeries = renderViewSeries(objs_series_usuario);
            
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
                        <span class="label label-info pull-right" style="margin-left:5px">Educación</span>\n\
                        <span class="label label-info pull-right" style="margin-left:5px">México</span>\n\
                        <span class="label label-info pull-right" style="margin-left:5px">Duarte</span>\n\
                        <hr />\n\
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
            srcRedSocial = '../../assets/images/fb.png';
        }else if (articulo.red_social == 'twitter') {
            srcRedSocial = '../../assets/images/tw.png';
        } else if (articulo.red_social == 'instagram') {
            srcRedSocial = '../../assets/images/in.png';
        }
        finview_content = finview_content+initcontainer
            + '<div class="col-lg-2">\n\
                    <img src="'+articulo.path_source+'" class="img-thumbnail" width="100%" height="100%">\n\
                </div>\n\
                <div class="col-lg-4 ">\n\
                    <h4>'+articulo.titulo+'</h4>\n\
                    '+articulo.post_to_enmbedded_text+'\n\
                    <footer class="mt-20">\n\
                        <img src="'+srcRedSocial+'" width="21" height="21">\n\
                        $ &nbsp; '+articulo.precio_contenido+'\n\
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
                <span class="label label-info pull-right" style="margin-left:5px">Educación</span>\n\
                <span class="label label-info pull-right" style="margin-left:5px">México</span>\n\
                <span class="label label-info pull-right" style="margin-left:5px">Duarte</span>\n\
                <hr />\n\
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
        finview_content = finview_content+initcontainer
            + '<div class="col-md-3"><img  src="'+series.path_source+'" style="height: 100%; width: 100%;" ></div>'
            + fincontainer;
    });
    return head_view+finview_content;
}