/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).on("ready", up_c);

function up_c()
{
    $('form').on('submit', function (e) {
        
        e.preventDefault();
        var data = new FormData();
        data.append('data_up', true);
        data.append('description_content', $('#description_content').val());
        data.append('file_update', $('input[type=file]')[0].files[0]);
        
        var checkbox = $(this).find("input[type=checkbox]");
        $.each(checkbox, function(key, val){
           if($(this).is(":checked")){
               data.append($(val).attr('name'), true);
            }else{
              data.append($(val).attr('name'), false);
            }
        });
        $.ajax({
            url: '../controllers/up_cont.php',
            type: "POST",             
            data: data,
            contentType: false,       
            cache: false,             
            processData:false,
            success: function (respuesta) {
                console.log(respuesta);
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
    })
}