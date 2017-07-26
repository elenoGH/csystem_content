<?php

require '../models/session.php';

if (isset($_POST['data_up'])) {

    $data_file = null;

    if (isset($_FILES["file_update"])) {
        //tipo de archivo
        //x = mime_content_type($_FILES["file_update"]);
//        $finfo = new finfo(FILEINFO_MIME_TYPE);
//        if (false === $ext = array_search(
//                $finfo->file($_FILES['file_update']['tmp_name']), array(
//            'jpg' => 'image/jpeg',
//            'png' => 'image/png',
//            'gif' => 'image/gif',
//                ), true
//                )) {
//            throw new RuntimeException('Invalid file format.');
//        }

        if (isset($_FILES['file_update']['tmp_name'])) {
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES['file_update']['tmp_name']);
            if ($mime == 'application/msword') {
                //Its a doc format do something
            }
            finfo_close($finfo);
        }
        
        if (!is_dir('../../assets/media/dir_source')) {
            mkdir('../../assets/media/dir_source', 0755, true);
            if (is_dir('../../assets/media/dir_source')) {
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

    $id_usuario = $_SESSION['id_user'];
    $titulo_cont = $_POST['titulo_content'];
    $descripcion = $_POST['description_content'];
    $url = 'http://php.net';
    $path_source = $data_file['image_path'] . $data_file['image_name'];
    $red_social = json_encode($_POST['red_social']);
    $tipo_source = 'Imagen';
    $categoria = 'Social';
    $etiquetas = json_encode(array('biologia'=>'bilogia', 'hurbanismo'=>'hurbanismo', 'tecnologi'=>'tecnologia'));
    
    $q = "INSERT INTO `tbl_contenido` (`id_usuario`, `titulo`, `descripcion`, `url`, `path_source`, `red_social`, `tipo_source`, `categoria`, `etiquetas`) "
            . " VALUES ('$id_usuario','$titulo_cont', '$descripcion','$url','$path_source','$red_social','$tipo_source','$categoria','$etiquetas')";
    
    //Run Query
    $result_insert = mysql_query($q) or die(mysql_error());
    /**
     * obtener datos una ves insertado
     */
    $resultado = '';
    if ($result_insert == 1) {
        $resultado = get_data_tendencias($connection, $_SESSION);
    }
    
    echo $resultado;
    die;
}

function get_data_tendencias($connection, $SESSION) {
    
    $resultado_desc = '';
    $resultado_nodesc = '';
    $ini_container = '<div class="container">';    
    $end_container = '</div><!--separar--><div class="clearfix">...</div>';
    $ini_container_nodesc = '<div class="container mt-20">';    
    $end_container_nodesc = '</div><!--separar--><div class="clearfix">...</div>';
    $count1 = 0;
    $count2 = 0;
    
    $data_content_tendencias = getDataTendencias($connection, $SESSION);
    foreach ($data_content_tendencias as $key => $itemArray1) {
        if ($count1 == 0) {
            $resultado_desc = $resultado_desc.$ini_container
                    . getStructureContentInfo($itemArray1);
            $count1++;
        } else  {
            $resultado_desc = $resultado_desc
                    . getStructureContentInfo($itemArray1)
                    . '<hr />'
                    .$end_container;
            $count1--;
        }
    }
    $data_content_tendencias_nodesc = getDataTendenciasNoDesc($connection, $SESSION);
    foreach ($data_content_tendencias_nodesc as $key => $itemArray2) {
        if ($count2 == 0) {
            $resultado_nodesc = $resultado_nodesc.$ini_container_nodesc
                    . getStructureContentNoDesc($itemArray2);
            $count2++;
        } else if ($count2>0 && $count2<4) {
            $resultado_nodesc = $resultado_nodesc
                    . getStructureContentNoDesc($itemArray2);
            $count2++;
        } else  {
            $resultado_nodesc = $resultado_nodesc
                    . getStructureContentNoDesc($itemArray2)
                    .$end_container_nodesc;
            $count2 = 0;
        }
    }
    
    $resultado_array = array(
        'tendencia_con_desc' => $resultado_desc
        , 'tendencia_sin_desc' => $resultado_nodesc
    );
    return json_encode($resultado_array);
}
function getStructureContentNoDesc($itemArray2)
{
    $structureCINoDesc = 
    '<div class="col-md-3"><img  src="'.$itemArray2['path_source'].'" width="100%" ></div>';
    return $structureCINoDesc;
}
function getStructureContentInfo($itemArray)
{
    $structureCI = 
    '<div class="col-lg-2">'
        . '<img src="'.$itemArray['path_source'].'" class="img-thumbnail" width="100%" height="100%">'
    . '</div>'
    . '<div class="col-lg-4 ">'
        . '<h4>'.$itemArray['titulo'].'</h4>'
        . $itemArray['descripcion']
        . '<footer class="mt-20">'
            . '<cite title="Source Title">'
                . '<b>Autor:</b>'
                . '<a href="#">'.$itemArray['email'].'</a>'
            . '</cite>'
            . '<span class="label label-warning"> 20 Documentos</span>'
        . '</footer>'
    . '</div>';
    return $structureCI;
}

function getDataTendencias($connection, $SESSION)
{
    $query = mysql_query("select * from tbl_usuario tu "
            . "inner join tbl_contenido tc on tu.id = tc.id_usuario "
            . "where tc.id > 0 "
            . "and tc.descripcion != ''", $connection);
    $array_resultado = array();
    while($data_array = mysql_fetch_array($query, MYSQL_ASSOC)){
        $array_resultado[] = $data_array;
    }
    
    return $array_resultado;
}

function getDataTendenciasNoDesc($connection, $SESSION)
{
    $query = mysql_query("select * from tbl_usuario tu "
            . "inner join tbl_contenido tc on tu.id = tc.id_usuario "
            . "where tc.id > 0 "
            . "and tc.descripcion = ''", $connection);
    $array_resultado = array();
    while($data_array = mysql_fetch_array($query, MYSQL_ASSOC)){
        $array_resultado[] = $data_array;
    }
    
    return $array_resultado;
}

function createSource($file, $param_array) {
    $dataComent = array();

    $target_dir = "../../assets/media/dir_source/";
    $name_image_candidato = 'img_source_' . $param_array['user'] . '_' . time();
    $imageFileTypeextension = pathinfo($target_dir . basename($file["name"]), PATHINFO_EXTENSION);

    $dataComent['image_path'] = $target_dir;
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
