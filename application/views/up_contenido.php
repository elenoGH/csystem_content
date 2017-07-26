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
        <script src="../../assets/js/up_cont.js"></script>

        <!-- Bootstrap core CSS -->
        <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/starter-template.css">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
        <!-- Custom styles for this template -->
        <link href="../../assets/css/cover2.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="../../assets/css/miestilo.css">
        <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
        <!--[if lt IE 9]><script src="../../../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
        <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
        <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap-extras-margins-padding.css">

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
                                <img class="avatar"  src="../../assets/images/user.png" width="34" height="34"> Hola <?php echo $login_session; ?>
                                <span class="badge alert-danger">42</span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Publicar</a></li>
                                <li><a href="#">Notificaciones <span class="badge alert-danger">42</span></a></li>
                                <li><a href="../../application/controllers/logout.php">Cerrar</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!--/.nav-collapse --> 
            </div>
        </nav>
        <!-- /Fixed navbar --> 
        <!--Titulo-->
        <div class="jumbotron">
            <div class="container">
                <div class="col-md-4">
                    <div class="thumbnail text-center ">
                        <div class="col-md-12 mb-20 well-sm well "><img src="../../assets/images/avatar.jpg" alt="avatar" class="img-circle" width="100" height="100" style="margin-bottom: -30px;"></div>
                        <div class="clearfix">...</div>
                        <h3 class="mb-40">Jesús Santoveña</h3>
                        <div class="container text-center mb-40">
                            <div class="col-md-4"><b>Contendio </b><br/>
                                32</div>
                            <div class="col-md-4"><b>Ventas</b><br/>
                                32</div>
                            <div class="col-md-4"><b>Clientes</b><br/>
                                32</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div> 
                        <form>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li>
                                    <input type="checkbox" id="cb1" name="red_social[facebook]" value="facebook">
                                    <label for="cb1"><img src="../../assets/images/icon-fb2.png" width="44" height="44"></label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb2" name="red_social[twitter]" value="twitter">
                                    <label for="cb2"><img src="../../assets/images/icon-instagram2.png" width="44" height="44"></label>
                                </li>
                                <li>
                                    <input type="checkbox" id="cb3" name="red_social[instagram]" value="instagram">
                                    <label for="cb3"><img src="../../assets/images/icon-twitter2.png" width="44" height="44"></label>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--div id="recargar-nuevos-datos">
                                </div-->


                                <div role="tabpanel" class="tab-pane active" id="profile">

                                    <div class="container mt-20"> 
                                        <!--etiquetas-->
                                        <input type="text" class="form-control" placeholder="Título de la publicación" id="titulo_content" name="titulo_content">
                                        <!--end etiquetas--> 

                                    </div>
                                    <div class="container mt-20">
                                        <textarea class="form-control" rows="5" 
                                                  placeholder="Escribe el contenido"
                                                  name="description_content" id="description_content"></textarea>
                                        <span id="count-caracter" class="">140</span>

                                    </div>
                                    <div class="container mt-20">
                                        <input type="file" class="" name="file_up" id="file_up">
                                    </div>
                                    <div class="container mt-20"> 
                                        <!--etiquetas-->
                                        <input type="text" class="form-control" placeholder="Añadir etiquetas separadas con comas">
                                        <!--end etiquetas--> 

                                    </div>
                                    <div class="container mt-20">
                                        <div class="col-md-4 mt-15 text-left">
                                            <select class="form-control input-sm">
                                                <option value="">Seleccionar</option>
                                                <option value="">Política</option>
                                                <option value="">Educación</option>
                                                <option value="">Planeta</option>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                                Político </label>
                                        </div>
                                        <div class="col-md-2">
                                            <label class="radio-inline">
                                                <input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                                Explícito </label>
                                        </div>
                                        <div class="col-md-4 mt-15">
                                            <button type="submit" value="Submit" class="btn btn-default btn-sm active">Añadir</button>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--end título --> 

        <!--iconos de redes-->

        <section>
            <div class="container mt-20">
                <div class="col-md-6 text-uppercase">
                    <h4>tendencias</h4>
                </div>
                <div class="col-md-6"></div>
                <div class="clearfix">...</div>
                <hr />
            </div>
            <!--noticias pekes-->
            <!--ini modulo-->
            <div id="load-datos-tendencias">

            </div>
            <!--end modulo-->
            <div id="load-datos-tendencias-nodescripcion">

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
    </body>
</html>
