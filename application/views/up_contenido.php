<?php
include('../../application/models/session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Subir Contenido</title>
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/up_cont.js"></script>
    </head>
    <body>
        <div id="profile">
            <b id="welcome">Bienvenido : <i><?php echo $login_session; ?></i></b>
            <b id="logout"><a href="../../application/controllers/logout.php">Log Out</a></b>
        </div>
        <h1>Agrega tu contenido</h1>
        <div id="subir-contenido">
            <form>
                <ul>
                    <li>
                        <input type="checkbox" id="cb1" name="red_social[facebook]" value="facebook">
                        <label for="cb1"><img src="http://lorempixel.com/100/100" /></label>
                    </li>
                    <li>    
                        <input type="checkbox" id="cb2" name="red_social[twitter]" value="twitter">
                        <label for="cb2"><img src="http://lorempixel.com/101/101" /></label>
                    </li>
                    <li>
                        <input type="checkbox" id="cb3" name="red_social[instagram]" value="instagram">
                        <label for="cb3"><img src="http://lorempixel.com/102/102" /></label>
                    </li>
                </ul>
                <br>
                    <span id="count-caracter" class="">140</span>
                    <textarea rows="4" cols="50" name="description_content" id="description_content">
                    </textarea>
                    Archivo: <input type="file" name="file_up" id="file_up"><br>
                    <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>