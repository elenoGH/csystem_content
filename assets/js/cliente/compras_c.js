$(document).on("ready", compras_cliente);

function compras_cliente(event)
{
    getAllComprasCliente();
    
    function getAllComprasCliente()
    {
        event.preventDefault();
        var data = new FormData();
        data.append('get_all_compras_cliente', true);
        
        $.ajax({
            url: '../../controllers/cliente/compras_c.php',
            type: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function (respuesta) {
                
                var obj = JSON.parse(respuesta);
                
                var srting_articulos = viewContenArticulosComprados(obj.array_data_articulos);
                var string_series = viewContentSeriesCompradas(obj.array_data_series);
                
                $('#load-datos-articulos-facebook').html(srting_articulos.facebook_view);
                $('#load-datos-articulos-twitter').html(srting_articulos.twitter_view);
                $('#load-datos-articulos-instagram').html(srting_articulos.instagram_view);
//                $('#load-datos-series').html(str_series);
                
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


function viewContenArticulosComprados(objArt)
{
    var string_return_facebook = '';
    var string_return_twitter = '';
    var string_return_instagram = '';
    
    var inirow = '';
    var findivrow = '';
    var count = 0;
    
    $.each(objArt, function(key, articulo){
        if (articulo.red_social == 'facebook') {
            if (count == 1) {
                inirow = '';
                findivrow = '</div>';
               count--;
           }else {
                inirow = '<div class="row center-block">';
                findivrow = '';
               count++;
           }
            var dt = new Date(articulo.created_date*1000);
            var date_format = dt.getDay() + '/' + dt.getMonth() + '/' + dt.getFullYear();
           string_return_facebook = string_return_facebook 
               + inirow
               + '<div class="col-lg-6">\n\
                       <div class="row">\n\
                           <div class="">\n\
                               <img src="http://lorempixel.com/40/40/sports/" alt="user">\n\
                               <div class="card__author-content">\n\
                                   <b>'+articulo.nombreAutor+'</b>\n\
                                   <br/>\n\
                                   '+date_format+' \n\
                               </div>\n\
                           </div>\n\
                       </div>\n\
                       <div class="row mt-10 mb-10" style="margin-right: 10px; border-width: 20px">\n\
                           <img src="'+articulo.path_source+'" width="100%" height="250">\n\
                           <h5><b>'+articulo.titulo+'</b></h5>\n\
                           '+articulo.post_to_enmbedded_text+' \n\
                       </div>\n\
                       <div class="row">\n\
                           <i class="fa fa-thumbs-up" aria-hidden="true" style="cursor: pointer"></i> &nbsp; <b>Me gusta</b>\n\
                       </div>\n\
                   </div>'
               + findivrow
           ;
        }
        
        if (articulo.red_social == 'twitter') {
            if (count == 1) {
                inirow = '';
                findivrow = '</div>';
               count--;
           }else {
                inirow = '<div class="row center-block">';
                findivrow = '';
               count++;
           }

           string_return_twitter = string_return_twitter 
               + inirow
               + '<div class="col-lg-6">\n\
                            <div class="row">\n\
                                <div class="card__author">\n\
                                    <img src="http://lorempixel.com/40/40/sports/" alt="user">\n\
                                    <div class="card__author-content">\n\
                                        <b>'+articulo.nombreAutor+'</b>\n\
                                        <br/>\n\
                                        '+date_format+' \n\
                                    </div>\n\
                                </div>\n\
                            </div>\n\
                            <div class="row mt-10 mb-10">\n\
                                <h5><b>'+articulo.titulo+'</b></h5>\n\
                                '+articulo.post_to_enmbedded_text+' \n\
                            </div>\n\
                            <div class="row mt-10 mb-10" style="margin-right: 10px; border-width: 20px">\n\
                                <img src="'+articulo.path_source+'" width="100%" height="250">\n\
                            </div>\n\
                            <div class="row">\n\
                                <i class="fa fa-comment-o" aria-hidden="true"></i>\n\
                                &nbsp; &nbsp; &nbsp;<i class="fa fa-heart-o" aria-hidden="true" style="cursor: pointer"></i>\n\
                                &nbsp; &nbsp; &nbsp;<i class="fa fa-retweet" aria-hidden="true"></i>\n\
                                &nbsp; &nbsp; &nbsp;<i class="fa fa-envelope-o" aria-hidden="true"></i>\n\
                            </div>\n\
                        </div>'
               + findivrow
           ;
        }
        
        if (articulo.red_social == 'instagram') {
            if (count == 1) {
                inirow = '';
                findivrow = '</div>';
               count--;
           }else {
                inirow = '<div class="row center-block">';
                findivrow = '';
               count++;
           }

           string_return_instagram = string_return_instagram 
               + inirow
               + '<div class="col-lg-6">\n\
                    <div class="row">\n\
                        <div class="card__author">\n\
                            <img src="http://lorempixel.com/40/40/sports/" alt="user">\n\
                            <div class="card__author-content">\n\
                                <b>'+articulo.titulo+'</b>\n\
                                <br/>\n\
                                '+articulo.date_format+' \n\
                                <br/>\n\
                                &nbsp; &nbsp; &nbsp;<i class="fa fa-comment-o" aria-hidden="true"></i>\n\
                                &nbsp; &nbsp; &nbsp;<i class="fa fa-heart-o" aria-hidden="true" style="cursor: pointer"></i>\n\
                            </div>\n\
                        </div>\n\
                    </div>\n\
                    <div class="row mt-10 mb-10" style="margin-right: 10px; border-width: 20px">\n\
                        <img src="'+articulo.path_source+'" width="100%" height="600">\n\
                    </div>\n\
                </div>'
               + findivrow
           ;
        }
        
    });
    
    return {
        facebook_view : string_return_facebook
        , twitter_view : string_return_twitter
        , instagram_view : string_return_instagram
        };
}

function viewContentSeriesCompradas(objSeries)
{
    var string_return = '';
    
    $.each(objSeries, function(key, articulo){
        
    });
    
    return string_return;
}

