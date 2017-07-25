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
        console.log($('form').serialize());

        $.ajax({
            type: 'post',
            url: '../controllers/up_cont.php',
            data: {data_up: 1},
            success: function (respuesta) {
                console.log(respuesta);
                alert('form was submitted');
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