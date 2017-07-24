<?php
include('login.php'); // Includes Login Script

if (isset($_SESSION['login_user'])) {
    header("location: profile.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="style.css" rel="stylesheet" type="text/css">
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