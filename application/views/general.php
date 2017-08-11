<?php
include('../../application/models/session.php');
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
        <title>Sistema de contenido</title>

        <link href="../../assets/css/style.css" rel="stylesheet" type="text/css">
        <script src="../../assets/js/jquery.min.js"></script>
        <script src="../../assets/js/escritor/script_e.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/starter-template.css">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
        <!-- Custom styles for this template -->
        <link href="../../assets/css/cover2.css" rel="stylesheet">

        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-extras-margins-padding.css">

        <script src="https://use.fontawesome.com/ddec08f0ce.js"></script>

    </head>

    <body>
        <div id="fb-root"></div>
        <div id="loading" class="hide">
            <div id="loading-content">
                <div class="load">
                    <div  class="bar"></div>
                    <div  class="bar"></div>
                    <div  class="bar"></div>
                </div>
            </div>
        </div>
        <nav class="navbar pleca navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"> </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                    <!--a class="navbar-brand" href="#">Project name</a--> 
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img class="avatar"  src="../../assets/images/autor_avatar.jpg" width="34" height="34"> Hola <?php echo $login_session; ?>
                                <!--span class="badge alert-danger">42</span></a-->
                                <ul class="dropdown-menu">
                                    <li><a href="../../application/controllers/logout.php">Cerrar</a></li>
                                </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse --> 
            </div>
        </nav>
        <!-- /Fixed navbar -->
        <!--iconos de redes-->
        <section>
            <div class="container mt-20">
                <!---->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#misarticulos" aria-controls="misarticulos" role="tab" data-toggle="tab">
                            Artículos
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#misseries" aria-controls="misseries" role="tab" data-toggle="tab">
                            Series
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="misarticulos">
                        <div id="load-datos-contenido">
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="misseries">
                        <div id="load-datos-series">
                        </div>
                    </div>
                </div>
                <!---->
            </div>
        </section>
        <footer class="footer pleca mt-80">
            <div class="container ">
                <p class="mt-20"  style="color:#FFF;">Aureacode</p>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
            ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

        <script src="../../assets/js/bootstrap.min.js"></script> 
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
        <script src="../../assets/js/bootbox.min.js"></script>
    </body>
</html>
