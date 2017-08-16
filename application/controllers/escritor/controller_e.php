<?php

require '../../models/session.php';

if (isset($_POST['get_series'])) {
    
    echo json_encode(getDataSeriesEscritor($connection, $_SESSION));
    die;
}

if (isset($_POST['editContent'])) {
    $query = mysql_query("select tc.id as id_contenido, tc.path_source, tc.titulo, tc.post_to_enmbedded_text, tc.red_social, tc.estatus as estatus_cont, tc.referencias, tc.created_date "
            . ", tu.nombre as nameuser, tu.apellido as apellidouser"
            . ", tto.id as id_topico, tto.nombre as nametopico "
            . "from tbl_usuario tu "
            . "inner join tbl_contenido_escritor tc on tu.id = tc.id_usuario "
            . "right join tbl_topicos tto on tc.id_topico = tto.id "
            . "where tc.id = " . $_POST['value_edit']
            . " and tu.id =" . $_SESSION['id_user'], $connection) or die(mysql_error());
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[] = $data_array;
    }

    echo json_encode($array_resultado);
    die;
}

if (isset($_POST['deleteContent'])) {

    $q = "delete "
            . "from tbl_contenido_escritor "
            . "where id= " . $_POST['value_delete'];

    //Run Query
    $result_insert = mysql_query($q) or die(mysql_error());
    /**
     * obtener datos una ves insertado
     */
    $resultado = '';
    if ($result_insert) {
        echo getDataEscritor($connection, $_SESSION);
    }
    die;
}

if (isset($_POST['deleteContentSerie'])) {
    $q = "delete "
        . "from tbl_contenido_escritor "
        . "where id_serie_escritor= " . $_POST['id_serie_delete'];

    //Run Query
    $result_insert = mysql_query($q) or die(mysql_error());
    /**
     * obtener datos una ves insertado
     */
    $resultado = '';
    if ($result_insert) {
        deleteSerie($connection, $_SESSION, $_POST['id_serie_delete']);
    }
    echo getDataEscritor($connection, $_SESSION);
    die;
}

function deleteSerie($connection, $SESSION, $idSerie)
{
    $q = "delete "
        . "from tbl_serie_escritor "
        . "where id= " . $idSerie;

    //Run Query
    $result = mysql_query($q) or die(mysql_error());
    /**
     * obtener datos una ves insertado
     */
    
    return $result;
}

if (isset($_POST['get_topicos'])) {
    $query = mysql_query("select * from tbl_topicos top "
            . "where top.id > 0 ", $connection);
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[] = $data_array;
    }
    echo json_encode($array_resultado);
    die;
}

if (isset($_POST['get_data'])) {
    echo getDataEscritor($connection, $_SESSION);
    die;
}

if (isset($_POST['data_up'])) {
    $data_file = null;

    if (isset($_FILES["file_update"])) {

        if (isset($_FILES['file_update']['tmp_name'])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES['file_update']['tmp_name']);
            if ($mime == 'application/msword') {
                //Its a doc format do something
            }
            finfo_close($finfo);
        }

        if (!is_dir('../../../assets/media/dir_source')) {
            mkdir('../../../assets/media/dir_source', 0755, true);
            if (is_dir('../../../assets/media/dir_source')) {
                $param_array = array(
                    'user' => $_SESSION['login_user']
                );
                $data_file = createSource($_FILES["file_update"], $param_array);
            }
        } else {
            $param_array = array(
                'user' => $_SESSION['login_user']
            );
            $data_file = createSource($_FILES["file_update"], $param_array);
        }
    }
    if (isset($data_file) && !empty($data_file)) {
        $path_source = $data_file['image_path'] . $data_file['image_name'];
    } else {
        $path_source = $_POST['url_other_image'];
    }


    $id_usuario = $_SESSION['id_user'];
    $titulo_cont = $_POST['titulo_content'];
    $post_to_enmbedded_text = $_POST['post_to_enmbedded_text'];
    $url = 'http://php.net';
    $red_social = $_POST['red_social'];
    $tipo_source = 'Imagen';
    $categoria = 'Social';
    $etiquetas = json_encode(array('biologia' => 'bilogia', 'hurbanismo' => 'hurbanismo', 'tecnologi' => 'tecnologia'));
    $id_topico = $_POST['id_topico'];
    $referencias = $_POST['referencias'];
    //al generar el contenido del escritor queda por primera ves en espera para la venta
    $estatus = 'espera';
    $id_contenido = $_POST['id_contenido'];
    $id_serie = $_POST['id_serie'];
    $es_articulo = $_POST['esarticulo'];
    $valor_precio = 0;
    if (is_numeric($_POST['valor_precio'])) {
        $valor_precio = $_POST['valor_precio'];
    }
    
    if ($es_articulo == 'true') {
        if (!empty($id_contenido)) {
            $modified_date = time();
            $q = " update tbl_contenido_escritor "
                    . " set id_topico = " . $id_topico
                    . " , titulo = '" . $titulo_cont . "'"
                    . " , post_to_enmbedded_text = '" . $post_to_enmbedded_text . "'"
                    . " , url = '" . $url . "'"
                    . " , path_source = '" . $path_source . "'"
                    . " , red_social = '" . $red_social . "'"
                    . " , tipo_source = '" . $tipo_source . "'"
                    . " , categoria = '" . $categoria . "'"
                    . " , etiquetas = '" . $etiquetas . "'"
                    . " , referencias = '" . $referencias . "'"
                    . " , estatus = '" . $estatus . "'"
                    . " , modified_date = '" . $modified_date . "'"
                    . " , id_serie_escritor = '" . $id_serie . "'"
                    . " , precio_contenido = '" . $valor_precio . "'"
                    . " where id = " . $id_contenido;
        } else {
            $created_date = time();
            $modified_date = time();
            $q = "INSERT INTO `tbl_contenido_escritor` (`id_usuario`, `id_topico`, `titulo`"
                    . ", `post_to_enmbedded_text`, `url`, `path_source`, `red_social`"
                    . ", `tipo_source`, `categoria`, `etiquetas`, `referencias`, `estatus`, `created_date`, `modified_date`"
                    . ", `id_serie_escritor`, `precio_contenido`) "
                    . " VALUES ('$id_usuario','$id_topico' ,'$titulo_cont'"
                    . ", '$post_to_enmbedded_text','$url','$path_source','$red_social'"
                    . ", '$tipo_source','$categoria','$etiquetas','$referencias','$estatus','$created_date','$modified_date'"
                    . ", '$id_serie', '$valor_precio')";
        }
    }
    else {
        $created_date = time();
        $modified_date = time();
        $q = "INSERT INTO `tbl_serie_escritor` (`id_usuario`, `id_topico`, `titulo`"
                . ", `post_to_enmbedded_text`, `url`, `path_source`, `red_social`"
                . ", `tipo_source`, `categoria`, `etiquetas`, `referencias`, `estatus`, `created_date`, `modified_date`, `precio_serie`) "
                . " VALUES ('$id_usuario','$id_topico' ,'$titulo_cont'"
                . ", '$post_to_enmbedded_text','$url','$path_source','$red_social'"
                . ", '$tipo_source','$categoria','$etiquetas','$referencias','$estatus','$created_date','$modified_date','$valor_precio')";
    }

    //Run Query
    $result_insert = mysql_query($q) or die(mysql_error());
    /**
     * obtener datos una ves insertado
     */
    $resultado = '';
    if ($result_insert) {
        $resultado = getDataEscritor($connection, $_SESSION);
    }

    echo $resultado;
    die;
}
/**
 * 
 * @param type $file
 * @param type $param_array
 * @return string
 */
function createSource($file, $param_array) {
    $dataComent = array();

    $target_dir = "../../../assets/media/dir_source/";
    $name_image_candidato = 'img_source_' . $param_array['user'] . '_' . time();
    $imageFileTypeextension = pathinfo($target_dir . basename($file["name"]), PATHINFO_EXTENSION);

    $dataComent['image_path'] = '../../assets/media/dir_source/';
    $dataComent['image_name'] = $name_image_candidato . '.' . $imageFileTypeextension;

    //$target_file = $target_dir . basename($_FILES["image-perfil-candidato"]["name"]);
    $target_file = $target_dir . $name_image_candidato . '.' . $imageFileTypeextension;
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $dataComent[0] = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $dataComent[1] = "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        $dataComent[2] = "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    //if ($_FILES["image-perfil-candidato"]["size"] > 500000) {
    //    echo "Sorry, your file is too large.";
    //    $uploadOk = 0;
    //}
    // Allow certain file formats
    if ($imageFileTypeextension != "jpg" && $imageFileTypeextension != "png" && $imageFileTypeextension != "jpeg" && $imageFileTypeextension != "gif") {
        $dataComent[3] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $dataComent[4] = "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            $dataComent[5] = "The file " . basename($file["name"]) . " has been uploaded.";
        } else {
            $dataComent[6] = "Sorry, there was an error uploading your file.";
        }
    }

    return $dataComent;
}

/**
 * 
 * @param type $connection
 * @param type $SESSION
 * @return type
 */
function getDataEscritor($connection, $SESSION) {
    $resultado_desc = '';
    $ini_container = '<div class="container">';
    $end_container = '</div>';
    $count = 0;
    $count_contenido = 0;
    $data_content_tendencias = getDataContenidoEscritor($connection, $SESSION);
    foreach ($data_content_tendencias as $key => $itemArray) {
        if ($count == 0) {
            $resultado_desc = $resultado_desc . $ini_container
                    . getStructureContentInfo($itemArray);
            $count++;
        } else {
            $resultado_desc = $resultado_desc
                    . getStructureContentInfo($itemArray)
                    . '<hr />'
                    . $end_container;
            $count--;
        }
        $count_contenido++;
    }

    $data_series_escritor = getDataSeriesEscritor($connection, $SESSION);
    
    $resultado_array = array(
        'contenido_con_desc' => $resultado_desc
        , 'total_contenido' => '<b>Contendio </b><br/>' . $count_contenido
        , 'series_escritor' => $data_series_escritor
    );
    return json_encode($resultado_array);
}

/**
 * 
 * @param type $connection
 * @param type $SESSION
 * @return type
 */
function getDataSeriesEscritor($connection, $SESSION)
{
    $query = mysql_query("select ts.id as id_serie, ts.id_usuario, ts.id_topico, ts.titulo as titulo_serie, ts.post_to_enmbedded_text as desc_serie, ts.url as url_serie, ts.path_source, ts.red_social, ts.tipo_source "
            . " , ts.categoria, ts.etiquetas, ts.referencias, ts.estatus, ts.created_date, ts.modified_date "
            . " , tu.nombre as nombreUser, tu.apellido as apUser, tu.email "
            . " , tto.nombre as nameTopico "
            . " from tbl_serie_escritor ts "
            . " inner join tbl_usuario tu on tu.id = ts.id_usuario "
            . " right join tbl_topicos tto on ts.id_topico = tto.id "
            . " where ts.id > 0 "
            . " and ts.id_usuario = " . $SESSION['id_user']
            , $connection) or die(mysql_error());
    
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[] = $data_array;
    }
    
    $array_resultado = getContenidoSeries($connection, $SESSION, $array_resultado);
    
    return $array_resultado;
}

/**
 * 
 * @param type $connection
 * @param type $SESSION
 * @param type $array_resultado
 * @return type
 */
function getContenidoSeries($connection, $SESSION, $array_resultado)
{
    $array_data_ret = array();
    foreach ($array_resultado as $key => $obj_item) {
        $array_resultado_by_serie = array();
        $query = mysql_query("select tc.id as id_contenido, tc.path_source, tc.titulo, tc.post_to_enmbedded_text, tc.red_social, tc.estatus as estatus_cont, tc.referencias, tc.created_date "
                . ", tu.nombre as nameuser, tu.apellido as apellidouser"
                . ", tto.nombre as nametopico "
                . "from tbl_usuario tu "
                . "inner join tbl_contenido_escritor tc on tu.id = tc.id_usuario "
                . "right join tbl_topicos tto on tc.id_topico = tto.id "
                . "where tc.id > 0 "
                . " and tu.id =" . $SESSION['id_user']
                . " and tc.id_serie_escritor = ".$obj_item['id_serie'], $connection);
        $temp_cont = 0;
        while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
            $array_resultado_by_serie[] = $data_array;
            $array_resultado_by_serie[$temp_cont]['json_by_series_content'] = encriptar(json_encode($data_array));
            $temp_cont++;
        }
        $array_resultado[$key]['data_by_serie'] = $array_resultado_by_serie;
    }
    return $array_resultado;
}

function getDataContenidoEscritor($connection, $SESSION) {
    $query = mysql_query("select tc.id as id_contenido, tc.path_source, tc.titulo, tc.post_to_enmbedded_text, tc.red_social, tc.estatus as estatus_cont, tc.referencias, tc.created_date "
            . ", tu.nombre as nameuser, tu.apellido as apellidouser"
            . ", tto.nombre as nametopico "
            . "from tbl_usuario tu "
            . "inner join tbl_contenido_escritor tc on tu.id = tc.id_usuario "
            . "right join tbl_topicos tto on tc.id_topico = tto.id "
            . "where tc.id > 0 "
            . " and id_serie_escritor = 0 "
            . " and tu.id =" . $SESSION['id_user'], $connection);
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[] = $data_array;
    }

    return $array_resultado;
}

function getStructureContentInfo($itemArray) {
    $json = encriptar(json_encode($itemArray));
    $structureCI = '<div class="col-lg-2">'
                    . '<button type="button" class="close" data-dismiss="modal" onclick="deleteContenido(' . $itemArray['id_contenido'] . ')" aria-label="Close">'
                        . '<span aria-hidden="true">&times;</span>'
                    . '</button>'
                    . '<img src="' . $itemArray['path_source'] . '" class="img-thumbnail" width="100%" height="100%">'
                . '</div>'
                . '<div class="col-lg-4 ">'
                    . '<h4>' . $itemArray['titulo'] . '</h4>'
                    . $itemArray['post_to_enmbedded_text']
                    . '<footer class="mt-20">'
                        . '<cite title="Source Title">'
                            . '<b>Autor: &nbsp;</b>'
                            . '<a href="#">' . $itemArray['nameuser'] . ' ' . $itemArray['apellidouser'] . '</a>'
                        . '</cite><br>'
                        . '<cite title="Source Topico">'
                            . '<b>Topico: &nbsp;</b>'
                            . '<a href="#">' . $itemArray['nametopico'] . '</a>'
                        . '</cite><br>'
                        . '<cite title="Source Red Social">'
                            . '<b>Red Social: &nbsp;</b>'
                            . '<a href="#">' . $itemArray['red_social'] . '</a>'
                        . '</cite><br>'
                        . '<cite title="Source Estatus">'
                            . '<b>Estatus: &nbsp;</b>'
                            . '<a href="#">' . $itemArray['estatus_cont'] . '</a>'
                        . '</cite><br>'
                        . '<a class="gototop gototop-button" href="#">'
                            . '<i class="fa fa-pencil" aria-hidden="true" style="cursor: pointer" onclick="editContent(' . $itemArray['id_contenido'] . ')"></i>'
                        . '</a>'
                        . '&nbsp;<i class="fa fa-eye" aria-hidden="true" style="cursor: pointer" data-toggle="modal" data-target=".preview-redsocial" onclick="modalPreview(\'' . $json . '\')"></i>'
                        . '&nbsp;<a href="' . $itemArray['referencias'] . '" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true" style="cursor: pointer"></i></a>'
                    . '</footer>'
                . '</div>';
    return $structureCI;
}

if (isset($_POST['getMD5info'])) {
    $md5enc = $_POST['md5info'];
    echo desencriptar($md5enc);
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
