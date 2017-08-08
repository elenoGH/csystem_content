<?php
include('application/controllers/login.php'); // Includes Login Script

if (isset($_SESSION['login_user'])) {
    if (isset($_SESSION['rol_user'])) {
        if ($_SESSION['rol_user'] == 1) {
            header("location: application/views/autor.php");
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="#">

        <title>Sistema de contenido </title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

        <!--css general-->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <!-- Custom styles for this template -->
        <link href="assets/css/cover.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="assets/css/miestilo.css">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="assets/js/ie-emulation-modes-warning.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="site-wrapper" style="background:url(assets/images/bg.jpg) no-repeat;">
            <div class="site-wrapper-inner">
                <div class="cover-container ">
                    <form class="form-signin" action="" method="post">
                        <label for="inputEmail" class="sr-only">Correo electrónico</label>
                        <input type="email" id="inputEmail" name="inputEmail" 
                               class="form-control" placeholder="Correo electrónico" 
                               required autofocus>
                        <br />
                        <label for="inputPassword" class="sr-only">Contraseña</label>
                        <input type="password" id="inputPassword" name="inputPassword"
                               class="form-control" placeholder="Contraseña" 
                               required>
                        <!--div class="checkbox">
                            <label>
                                <input type="checkbox" value="remember-me"> Recuérdame
                            </label>
                        </div-->
                        <br>
                        <p class="lead">
                            <input name="submit" type="submit" value="Iniciar" class="btn btn-lg btn-default">
                        </p>
                        <span><?php echo $error; ?></span>
                    </form>
                    
                    <div class="inner cover">
                        <h1 class="cover-heading">Sistema de contenido.</h1>
                        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae diam lobortis, imperdiet libero non, faucibus velit. Donec ullamcorper dictum nibh vel tincidunt.</p>
                        <hr />

                    </div>
                    <div class=" row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="btnRed"><button class="fb"></button></div>
                            <div class="btnRed"><button class="tw"></button></div>
                            <div class="btnRed"><button class="int"></button></div>
                        </div>
                        <div class="col-md-2"></div>         
                    </div>
                    <div class="mastfoot">
                        <div class="inner">
                            <p>Sitios diseñado por  <a href="#">Aureacode</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="assets/js/jquery.min.js"><\/script>')</script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
