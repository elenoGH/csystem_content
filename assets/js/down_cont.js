
$(document).on("ready", down_c);

function down_c(event)
{
    $("#loading").hide();
    /**
     * get all data
     */
    event.preventDefault();
    var data = new FormData();
    data.append('get_data_tendencias', true);
    
    $.ajax({
        url: '../controllers/down_cont.php',
        type: "POST",
        data: data,
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {
//            console.log(respuesta);
            setTimeout(function () {
                $("#loading").hide();
                //location.reload();
                var obj = JSON.parse(respuesta);
                
                $('#load-datos-tendencias').html(obj.tendencia_con_desc);
                $('#load-datos-tendencias-nodescripcion').html(obj.tendencia_sin_desc);
                
                $('#load-datos-tendencias1').html(obj.tendencia_con_desc);
                $('#load-datos-tendencias-nodescripcion1').html(obj.tendencia_sin_desc);
                
                $('#load-datos-tendencias2').html(obj.tendencia_con_desc);
                $('#load-datos-tendencias-nodescripcion2').html(obj.tendencia_sin_desc);
            }, 1000);
        },
        error: function (result)
        {
            alert(JSON.stringify(result));
        },
        fail: function (status) {
        },
        beforeSend: function (d) {
            $("#loading").show();
        }
    });
}