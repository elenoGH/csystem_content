<?php
include('../../application/models/session.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Subir Contenido</title>
        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="profile">
            <b id="welcome">Bienvenido : <i><?php echo $login_session; ?></i></b>
            <b id="logout"><a href="../../application/controllers/logout.php">Log Out</a></b>
        </div>
        <h1>Agrega tu contenido</h1>
        <div id="subir-contenido">
            <form action="../controllers/up_cont.php" method="POST">
                <label>
                    <input type="checkbox" id="cbox1" value="1_checkbox"> Facebook
                </label>
                <label>
                    <input type="checkbox" id="cbox2" value="2_checkbox"> Twitter
                </label>
                <label>
                    <input type="checkbox" id="cbox3" value="3_checkbox"> Instagram
                </label>
                <br>
                 <textarea rows="4" cols="50" name="contenido_pots">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam in nisl libero. Morbi maximus
                    , lectus et feugiat bibendum, metus nunc cursus mi, sit amet fermentum lorem tellus ut risus.
                     Aliquam fermentum, nibh a laoreet tristique, odio massa blandit sapien, et sodales nunc dui ut enim. 
                    Nunc volutpat, ligula in tristique molestie, lacus risus accumsan tortor, quis lacinia tellus neque et felis. 
                    Nulla nec felis massa. Duis ut posuere nisi. Cras justo orci, condimentum in viverra sed, aliquam quis risus.
                     Ut tempor erat odio, a pulvinar mauris suscipit vel. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; 
                    Duis est erat, condimentum ac leo vel, pellentesque varius nunc. 
                </textarea>
                    Archivo: <input type="file" name="file"><br>
                    <input type="submit" value="Submit">
            </form>
        </div>
    </body>
</html>