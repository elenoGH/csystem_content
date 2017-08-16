<?php

require '../../models/session.php';

if (isset($_POST['get_all_autores'])) {
    $array_autores = getAllAutores($connection, $_SESSION);
    $structure_view = getGenerateViewListAutores($array_autores);
    
    $data_array = array(
        'array_autores' => $array_autores
        , 'structure_view' => $structure_view
    );
    
    echo json_encode($data_array);
    die;
}

function getAllAutores($connection, $SESSION)
{
    $query = mysql_query("select tu.id as id_usuario, tu.username, tu.email, tu.nombre as nameUser, tu.fecha_nac_timestamp, tu.perfil_image_path, tu.descripcion_corta "
            . " from tbl_usuario tu "
            . " where tu.id > 0 "
            . " and rol = 2 "
            . " order by tu.id asc "
            , $connection) or die(mysql_error());
    
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[$data_array['id_usuario']]['generales_autor'] = $data_array;
        $query_articulos = mysql_query("select * "
            . " from tbl_contenido_escritor "
            . " where id > 0 "
            . " and id_usuario =".$data_array['id_usuario']
            . " and id_serie_escritor = 0 "
            , $connection) or die(mysql_error());
        while ($articulos_array = mysql_fetch_array($query_articulos, MYSQL_ASSOC)) {
            $array_resultado[$data_array['id_usuario']]['articulos_usuario'][] = $articulos_array;
        }
        $query_series = mysql_query("select * "
            . " from tbl_serie_escritor "
            . " where id > 0 "
            . " and id_usuario =".$data_array['id_usuario']
            , $connection) or die(mysql_error());
        $count_articulos_by_series = 0;
        while ($series_array = mysql_fetch_array($query_series, MYSQL_ASSOC)) {
            $array_resultado[$data_array['id_usuario']]['series_usuario'][] = $series_array;
            $query_articulos_series = mysql_query("select * "
                . " from tbl_contenido_escritor "
                . " where id > 0 "
                . " and id_usuario =".$data_array['id_usuario']
                . " and id_serie_escritor = ".$series_array['id']
                , $connection) or die(mysql_error());
            $array_articulos_series = array();
            while ($articulos_by_serie_array = mysql_fetch_array($query_articulos_series, MYSQL_ASSOC)) {
                $array_articulos_series[] = $articulos_by_serie_array;
            }
            $array_resultado[$data_array['id_usuario']]['series_usuario'][$count_articulos_by_series]['articulos_by_serie'] = $array_articulos_series;
            $count_articulos_by_series++;
        }
    }
    return $array_resultado;
}

function getGenerateViewListAutores($array_autores)
{
    $string_value = '';
    
    foreach ($array_autores as $key => $autor) {
        $articulos = '';
        $series = '';
        $json_articulos_usuario = '';
        $json_series_usuario = '';
        if(isset($autor['articulos_usuario'])){
            foreach ($autor['articulos_usuario'] as $articulo) {
                $articulos = $articulos.', '.$articulo['titulo'];
            }
            $json_articulos_usuario = encriptar(json_encode($autor['articulos_usuario']));
        }
        if (isset($autor['series_usuario'])) {
            foreach ($autor['series_usuario'] as $serie) {
                $series = $series.', '.$serie['titulo'];
            }
            $json_series_usuario = encriptar(json_encode($autor['series_usuario']));
        }
        $json_generales_autor = encriptar(json_encode($autor['generales_autor']));
        
        
        $string_value = $string_value
            .'<div class="container mt-20">'
                . '<div class="col-lg-1">'
                    . '<img src="../../assets/images/autor_avatar.jpg" alt="avatar" class="img-circle" width="50" height="50">'
                . '</div>'
                . '<div class="col-lg-11">'
//                    . '<b>Nombre: &nbsp;</b>'. $autor['generales_autor']['nameUser']
//                    . '<p style="font-size:14px"><b>Sobre él: &nbsp;</b>'
//                        . $autor['generales_autor']['descripcion_corta']
//                    . '</p>'
                    . '<footer class="mt-20">'
                        . '<cite title="Source Title">'
                            . '<b>Nombre: &nbsp;</b>'. $autor['generales_autor']['nameUser']
                        . '</cite>'
                            . '<br/>'
                        . '<cite title="Source Title">'
                            . '<b>Artículos: &nbsp;</b>'. $articulos
                        . '</cite>'
                            . '<br/>'
                        . '<cite title="Source Title">'
                            . '<b>Series: &nbsp;</b>'. $series
                        . '</cite>'
                            . '<br/>'
                        . '<cite title="Source Mas">'
                            . 'Ver Más &nbsp;<i class="fa fa-eye" aria-hidden="true" style="cursor: pointer" data-toggle="modal" data-target=".preview-redsocial" '
                                . 'onclick="viewContentAutor(\'' . $json_generales_autor . '\', \'' . $json_articulos_usuario . '\', \'' . $json_series_usuario . '\')"></i>'
                        . '</cite>'
                    . '</footer>'
                . '</div>'
            . '</div>';
    }
            
    return $string_value;
}

if (isset($_POST['getMD5info'])) {
    $md5enc_generales_autor = $_POST['md5info_generales_autor'];
    $md5enc_articulos_usuario = $_POST['md5info_articulos_usuario'];
    $md5enc_series_usuario = $_POST['md5info_series_usuario'];
    
    echo json_encode(
            array(
                'generales_autor' => desencriptar($md5enc_generales_autor)
                , 'articulos_usuario' => desencriptar($md5enc_articulos_usuario)
                , 'series_usuario' => desencriptar($md5enc_series_usuario)
            )
        );
    die;
}

function encriptar($cadena) {
    $key = '';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    return $encrypted; //Devuelve el string encriptado
}

function desencriptar($cadena) {
    $key = '';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    return $decrypted;  //Devuelve el string desencriptado
}