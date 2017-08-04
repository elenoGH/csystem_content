<?php

require '../../models/session.php';

if (isset($_POST['get_topicos'])) {
    $query = mysql_query("select * from tbl_topicos top "
            . "where top.id > 0 ", $connection);
    $array_resultado = array();
    while($data_array = mysql_fetch_array($query, MYSQL_ASSOC)){
        $array_resultado[] = $data_array;
    }
    echo json_encode($array_resultado);
    die;
}
        
if (isset($_POST['get_data']))
{
    echo getDataEscritor($connection, $_SESSION);
    die;
}

if (isset($_POST['data_up']))
{
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

    $id_usuario = $_SESSION['id_user'];
    $titulo_cont = $_POST['titulo_content'];
    $post_to_enmbedded_text = $_POST['post_to_enmbedded_text'];
    $url = 'http://php.net';
    $path_source = $data_file['image_path'] . $data_file['image_name'];
    $red_social = $_POST['red_social'];
    $tipo_source = 'Imagen';
    $categoria = 'Social';
    $etiquetas = json_encode(array('biologia'=>'bilogia', 'hurbanismo'=>'hurbanismo', 'tecnologi'=>'tecnologia'));
    $id_topico = $_POST['id_topico'];
    $referencias = $_POST['referencias'];
    //al generar el contenido del escritor queda por primera ves en espera para la venta
    $estatus = 'espera';
    
    $q = "INSERT INTO `tbl_contenido_escritor` (`id_usuario`, `id_topico`, `titulo`"
            . ", `post_to_enmbedded_text`, `url`, `path_source`, `red_social`"
            . ", `tipo_source`, `categoria`, `etiquetas`, `referencias`, `estatus`) "
            . " VALUES ('$id_usuario','$id_topico' ,'$titulo_cont'"
            . ", '$post_to_enmbedded_text','$url','$path_source','$red_social'"
            . ",'$tipo_source','$categoria','$etiquetas','$referencias','$estatus')";
    
    //Run Query
    $result_insert = mysql_query($q) or die(mysql_error());
    /**
     * obtener datos una ves insertado
     */
    $resultado = '';
    if ($result_insert == 1) {
        $resultado = getDataEscritor($connection, $_SESSION);
    }
    
    echo $resultado;
    die;
}

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

function getDataEscritor($connection, $SESSION)
{
    $resultado_desc = '';
    $ini_container = '<div class="container">';    
    $end_container = '</div><!--separar--><div class="clearfix">...</div>';
    $count = 0;
    $count_contenido = 0;
    $data_content_tendencias = getDataContenidoEscritor($connection, $SESSION);
    foreach ($data_content_tendencias as $key => $itemArray) {
        if ($count == 0) {
            $resultado_desc = $resultado_desc.$ini_container
                    . getStructureContentInfo($itemArray);
            $count++;
        } else  {
            $resultado_desc = $resultado_desc
                    . getStructureContentInfo($itemArray)
                    . '<hr />'
                    .$end_container;
            $count--;
        }
        $count_contenido++;
    }
    
    $resultado_array = array(
        'contenido_con_desc' => $resultado_desc
            , 'total_contenido' => '<b>Contendio </b><br/>'.$count_contenido
    );
    return json_encode($resultado_array);
}

function getDataContenidoEscritor($connection, $SESSION)
{
    $query = mysql_query("select tc.path_source, tc.titulo, tc.post_to_enmbedded_text, tc.red_social, tc.estatus as estatus_cont, tc.referencias"
            . ", tu.nombre as nameuser, tu.apellido as apellidouser"
            . ", tto.nombre as nametopico "
            . "from tbl_usuario tu "
            . "inner join tbl_contenido_escritor tc on tu.id = tc.id_usuario "
            . "right join tbl_topicos tto on tc.id_topico = tto.id "
            . "where tc.id > 0 "
            . "and tu.id =".$SESSION['id_user'], $connection);
    $array_resultado = array();
    while($data_array = mysql_fetch_array($query, MYSQL_ASSOC)){
        $array_resultado[] = $data_array;
    }
    
    return $array_resultado;
}
function getStructureContentInfo($itemArray)
{
    $structureCI = 
    '<div class="col-lg-2">'
        . '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
        . '<img src="'.$itemArray['path_source'].'" class="img-thumbnail" width="100%" height="100%">'
    . '</div>'
    . '<div class="col-lg-4 ">'
        . '<h4>'.$itemArray['titulo'].'</h4>'
        . $itemArray['post_to_enmbedded_text']
        . '<footer class="mt-20">'
            . '<cite title="Source Title">'
                . '<b>Autor: &nbsp;</b>'
                . '<a href="#">'.$itemArray['nameuser'].' '.$itemArray['apellidouser'].'</a>'
            . '</cite><br>'
            . '<cite title="Source Topico">'
                . '<b>Topico: &nbsp;</b>'
                . '<a href="#">'.$itemArray['nametopico'].'</a>'
            . '</cite><br>'
            . '<cite title="Source Red Social">'
                . '<b>Red Social: &nbsp;</b>'
                . '<a href="#">'.$itemArray['red_social'].'</a>'
            . '</cite><br>'
            . '<cite title="Source Estatus">'
                . '<b>Estatus: &nbsp;</b>'
                . '<a href="#">'.$itemArray['estatus_cont'].'</a>'
            . '</cite><br>'
            . '<i class="fa fa-pencil" aria-hidden="true" style="cursor: pointer"></i>&nbsp;<i class="fa fa-eye" aria-hidden="true" style="cursor: pointer"></i>'
            . '&nbsp;<a href="'.$itemArray['referencias'].'" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true" style="cursor: pointer"></i></a>'
        . '</footer>'
    . '</div>';
    return $structureCI;
}