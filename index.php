<?php
include('application/controllers/login.php'); // Includes Login Script

if (isset($_SESSION['login_user'])) {
    if (isset($_SESSION['rol_user'])) {
        if ($_SESSION['rol_user'] == 1) {
            header("location: application/views/down_contenido.php");
        }else {
            header("location: application/views/up_contenido.php");
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="main">
            <h1>Contenido</h1>
            <div id="login">
                <h2>Login</h2>
                <form action="" method="post">
                    <label>Usuario :</label>
                    <input id="name" name="username" placeholder="Usuario" type="text">
                    <label>Contraseña :</label>
                    <input id="password" name="password" placeholder="**********" type="password">
                    <input name="submit" type="submit" value=" Login ">
                    <span><?php echo $error; ?></span>
                </form>
            </div>
        </div>
    </body>
</html>