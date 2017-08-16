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
        <script src="../../assets/js/cliente/script_c.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/starter-template.css">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
        <!-- Custom styles for this template -->
        <link href="../../assets/css/cover2.css" rel="stylesheet">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-extras-margins-padding.css">

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

        <div class="jumbotron">
            <div class="container">
                <div class="col-md-4">
                    <div class="thumbnail text-center ">
                        <div class="col-md-12 mb-20 well-sm well ">
                            <img src="../../assets/images/autor_avatar.jpg" alt="avatar" 
                                 class="img-circle" width="100" height="100" 
                                 style="margin-bottom: -30px;">
                        </div>
                        <div class="clearfix">...</div>
                        <h3 class="mb-40"><?php echo $login_session; ?></h3>
                        <div class="container text-center">
                            <div class="col-md-6" id="count-articulos">
                                <b>Artículos </b><br/>0
                            </div>
                            <div class="col-md-6" id="count-series">
                                <b>Series</b><br/>0
                            </div>
                        </div>
                        <div class="starter-template">
                            En esta sección puedes encontrar 
                            <br/>
                            Usuarios con Artículos y Series destacadas.
                            <br/>
                            <div class="row">
                                <div class="col-md-12">
                                    <form class="form-inline mt-25">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="exampleInputName2" placeholder="Buscar...">
                                        </div>
                                        <button type="" class="btn btn-default">Buscar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <ul>
                                        <li>
                                            <input type="checkbox" id="cb1" />
                                            <label for="cb1"><img src="../../assets/images/filtro-fb.png" width="48" height="45"></label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="cb2" />
                                            <label for="cb2"><img src="../../assets/images/filtro-in.png" width="48" height="45"></label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="cb3" />
                                            <label for="cb3"><img src="../../assets/images/filtro-tw.png" width="48" height="45"></label>
                                        </li>
                                        <!--li>
                                            <input type="checkbox" id="cb4" />
                                            <label for="cb4"><img src="../../assets/images/filtro-gif.png" width="48" height="45"></label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="cb5" />
                                            <label for="cb5"><img src="../../assets/images/filtro-img.png" width="48" height="45"></label>
                                        </li>
                                        <li>
                                            <input type="checkbox" id="cb6" />
                                            <label for="cb6"><img src="../../assets/images/filtro-video.png" width="48" height="45"></label>
                                        </li-->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="container">
                        <!--div class="starter-template">
                            <h4>Bienvenido al Sistema de contenidos</h4>
                        </div-->
                        <div class="row">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#autores" aria-controls="autores" role="tab" data-toggle="tab" id="count-autores">
                                        Autores &nbsp;
                                        <span class="badge">0</span>
                                    </a>
                                </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="autores">
                                    <div id="load-datos-autores">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <section id="section-view-articulos">
            
        </section>
        <section id="section-view-series">
            
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
