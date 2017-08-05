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
        <!--div id="fb-root">para facebook</div>
        <div class="fb-post" data-href="https://www.facebook.com/20531316728/posts/10154009990506729/" data-width="500" data-show-text="true">
            <blockquote cite="https://www.facebook.com/20531316728/posts/10154009990506729/" class="fb-xfbml-parse-ignore">
                Publicado por <a href="https://www.facebook.com/facebook/">Facebook</a> 
                en&nbsp;<a href="https://www.facebook.com/20531316728/posts/10154009990506729/">
                    Jueves, 27 de agosto de 2015
                </a>
            </blockquote>
        </div-->
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
                            <div class="col-md-4" id="count-contenido">
                                <b>Contendio </b><br/>0
                            </div>
                            <div class="col-md-4"><b>Ventas</b><br/>
                                0</div>
                            <div class="col-md-4"><b>Clientes</b><br/>
                                0</div>
                        </div>
                    </div>
                    <div class="thumbnail">
                        <h3 class="mb-40 text-center">Solicitar Editor</h3>
                        <div class="container mb-40">
                            <div class="col-md-10"><b>Empresa</b>
                                <br/>
                                Aureacode<br/>
                                Gestor de Contenidos S.A. de C.V.<br/>
                            </div>
                            <!--div class="col-md-3"><b>Ventas</b><br/>
                                32<br/>
                            </div-->
                            <div class="col-md-2"><b></b>
                                <br/>
                                <i class="fa fa-address-book" aria-hidden="true" style="cursor: pointer"></i><br/>
                                <i class="fa fa-address-book" aria-hidden="true" style="cursor: pointer"></i><br/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div> 
                        <form>
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li>
                                    <input type="radio" id="cb1" name="red_social" value="facebook" checked="checked">
                                    <label for="cb1"><img src="../../assets/images/icon-fb2.png" width="44" height="44"></label>
                                </li>
                                <li>
                                    <input type="radio" id="cb2" name="red_social" value="twitter">
                                    <label for="cb2"><img src="../../assets/images/icon-twitter2.png" width="44" height="44"></label>
                                </li>
                                <li>
                                    <input type="radio" id="cb3" name="red_social" value="instagram">
                                    <label for="cb3"><img src="../../assets/images/icon-instagram2.png" width="44" height="44"></label>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="profile">
                                    <div class="container mt-20"> 
                                        <!--etiquetas-->
                                        <input type="text" class="form-control" 
                                               placeholder="Título de la publicación" 
                                               id="titulo_content" name="titulo_content"
                                               required>
                                        <!--end etiquetas--> 
                                    </div>
                                    <div class="container mt-20 collapse" id="div-textarea-id">
                                        <textarea class="form-control" rows="3" 
                                                  placeholder="Escribe la idea principal de tu post"
                                                  name="post_to_enmbedded_text" id="post_to_enmbedded_text"
                                                  maxlength="140"></textarea>
                                        <span id="count-caracter" class=""><strong>250</strong></span>
                                    </div>
                                    <div class="container mt-20">
                                        <div id="previewImgPerfil">
                                            <img id="idImagenPerfil" src="https://placehold.it/300x200" alt="Imagen" style="height: 200px; width: 300px;">
                                        </div>
                                    </div>
                                    <div class="container mt-20">
                                        <div class="col-sm-6">
                                            <label for="" class="" style="">Tamaño maximo recomendado 300 por 200 pixeles.</label>
                                            <label class="btn btn-default btn-file">
                                                Examinar
                                                <input type="file" name="file_up" id="file_up" style="display: none;">
                                            </label>
                                        </div>
                                        <div class="col-sm-6">
                                            <select class="form-control" id="id_topico"
                                                    name="id_topico" required>
                                                <option value="">-- Topicos</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="container mt-20">
                                        <input type="text" class="form-control" placeholder="Referencias" 
                                               id="referencias" name="referencias">
                                    </div>
                                    <div class="container mt-20">
                                        <div class="col-md-4 mt-15">
                                            <button type="submit" value="Submit" 
                                                    class="btn btn-default btn-sm active">
                                                Añadir
                                            </button>&nbsp;
                                            <button type="button" value="0" 
                                                    class="btn btn-default btn-sm active">
                                                Preview
                                            </button>
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
                    <h4>Mis articulos</h4>
                </div>
                <div class="col-md-6"></div>
                <div class="clearfix">...</div>
                <hr />
            </div>
            <!--noticias pekes-->
            <!--ini modulo-->
            <div id="load-datos-contenido">
            </div>
            <!--end modulo-->
            <!--div id="load-datos-contenido-nodescripcion">
            </div-->
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
