<?php
include('../../../application/models/session.php');
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

        <link href="../../../assets/css/style.css" rel="stylesheet" type="text/css">
        <script src="../../../assets/js/jquery.min.js"></script>
        <script src="../../../assets/js/cliente/compras_c.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="../../../assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../../assets/css/starter-template.css">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap.css">
        <!-- Custom styles for this template -->
        <link href="../../../assets/css/cover2.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../../../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../../assets/js/ie-emulation-modes-warning.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../assets/css/bootstrap-extras-margins-padding.css">

        <script src="https://use.fontawesome.com/ddec08f0ce.js"></script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
    </head>

    <body>
        <div id="loading" class="hide">
            <div id="loading-content">
                <div class="load">
                    <div  class="bar"></div>
                    <div  class="bar"></div>
                    <div  class="bar"></div>
                </div>
            </div>
        </div>
        <!-- Fixed navbar -->
        <nav class="navbar pleca navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only"> </span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                <img src="../../../assets/images/autor_avatar.jpg" alt="avatar" 
                                     class="img-circle" width="34" height="34" style="margin-bottom: 0px;">
                                Hola <?php echo $login_session; ?>
                                <span class="badge alert-danger"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="../../../application/views/cliente/cliente.php">
                                        Perfil
                                    </a>
                                </li>
                                <li><a href="../../../application/controllers/logout.php">Cerrar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse --> 
            </div>
        </nav>

        <div class="container">
            <div class="starter-template">
                <h1>Estas son tus compras</h1>
            </div>
        </div>
        <section>
            <div class="container mt-60">
                <div class="">
                    <h4 class="mb-10">
                        <img src="../../../assets/images/fb.png" width="21" height="21">
                        Publicación para Facebook
                    </h4>
                    <div id='load-datos-articulos-facebook'>
                        
                    </div>
                    <h4 class="mt-40 mb-10">
                        <img src="../../../assets/images/tw.png" width="21" height="21">
                        Publicación para Twitter
                    </h4>
                    <div id='load-datos-articulos-twitter'>

                    </div>
                    <h4 class="mt-40">
                        <img src="../../../assets/images/in.png" width="21" height="21">
                        Publicación para Instagram
                    </h4>
                    <hr class="pull-left" style="width:90%;" />
                    <div id='load-datos-articulos-instagram'>
                        
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade preview-redsocial" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-dialog" role="">
                <!---->
                <div class="wrapper">
                    <div class="card radius shadowDepth1">
                        <div class="card__action">

                            <div class="card__author">
                                <img src="http://lorempixel.com/40/40/sports/" alt="user">
                                <div class="card__author-content">
                                    Creado por <a href="#"><?php echo $login_session; ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="card__content card__padding">
                            <article class="card__article">
                                <!--this put title and description of content-->
                            </article>
                        </div>
                        <div class="card__image border-tlr-radius">
                            <!--put the image via ajax-->
                        </div>
                        <div class="card__content card__padding">
                            <div class="card__meta">
                                <!--add time and reference-->
                            </div>
                        </div>
                    </div>
                </div>
                <!---->
            </div>
        </div>
        <footer class="footer pleca mt-80">
            <div class="container ">
                <p class="mt-20"  style="color:#FFF;">Aureacode</p>
            </div>
        </footer>
        <!-- Bootstrap core JavaScript
            ================================================== --> 
        <!-- Placed at the end of the document so the pages load faster --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 

        <script src="../../../assets/js/bootstrap.min.js"></script> 
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug --> 
        <script src="../../../assets/js/ie10-viewport-bug-workaround.js"></script>
        <script src="../../../assets/js/bootbox.min.js"></script>
    </body>
</html>
