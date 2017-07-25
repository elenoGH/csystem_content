<?php
include('../../application/models/session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Subir Contenido</title>
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
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
                        <input type="checkbox" id="cb1" />
                        <label for="cb1"><img src="http://lorempixel.com/100/100" /></label>
                    </li>
                    <li>    
                        <input type="checkbox" id="cb2" />
                        <label for="cb2"><img src="http://lorempixel.com/101/101" /></label>
                    </li>
                    <li>
                        <input type="checkbox" id="cb3" />
                        <label for="cb3"><img src="http://lorempixel.com/102/102" /></label>
                    </li>
                </ul>
                <!--label>
                    <input type="checkbox" id="cbox1" value="1_checkbox"> Facebook
                </label>
                <label>
                    <input type="checkbox" id="cbox2" value="2_checkbox"> Twitter
                </label>
                <label>
                    <input type="checkbox" id="cbox3" value="3_checkbox"> Instagram
                </label-->
                <br>
                    <span id="count-caracter" class="">140</span>
                    <textarea rows="4" cols="50" name="description_content" id="description_content">
                    </textarea>
                    Archivo: <input type="file" name="file"><br>
                    <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>