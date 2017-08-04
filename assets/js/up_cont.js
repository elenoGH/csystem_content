
$(document).on("ready", up_c);

function up_c(event)
{
    $("#loading").addClass('hide');

    get_data_tendencias();

    function get_data_tendencias()
    {
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
                    $("#loading").addClass('hide');
                    //location.reload();
                    var obj = JSON.parse(respuesta);

                    $('#load-datos-tendencias').html(obj.tendencia_con_desc);
                    $('#load-datos-tendencias-nodescripcion').html(obj.tendencia_sin_desc);
                    
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
        data.append('description_content', $('#description_content').val());
        data.append('file_update', $('input[type=file]')[0].files[0]);
        data.append('red_social', $(this).find('input[name=red_social]:checked').val());
        
        $.ajax({
            url: '../controllers/up_cont.php',
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

                    $('#load-datos-tendencias').html(obj.tendencia_con_desc);
                    $('#load-datos-tendencias-nodescripcion').html(obj.tendencia_sin_desc);
                    bootbox.alert("Acción Satisfactoria!", function(){
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

    $('#description_content').on('keyup', function (e) {
        var limit = 140;
        var value = e.target.value.length
        var result = limit - value;
        result = (result <= 0) ? result = 0 : result;
        if (result <= 0) {
            $('#count-caracter').html(result).append('&nbsp;<i class="fa fa-check" aria-hidden="true"></i>').css('color', 'red');
        } else {
            $('#count-caracter').html(result).append('&nbsp;<i class="fa fa-times" aria-hidden="true"></i>').css('color', 'green');
        }
    });
}