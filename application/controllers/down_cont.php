<?php

require '../models/session.php';

if (isset($_POST['get_data_tendencias'])) {
    
    $resultado_desc = '';
    $resultado_nodesc = '';
    $ini_container = '<div class="container">';    
    $end_container = '</div><!--separar--><div class="clearfix">...</div>';
    $ini_container_nodesc = '<div class="container mt-20">';    
    $end_container_nodesc = '</div><!--separar--><div class="clearfix">...</div>';
    $count1 = 0;
    $count2 = 0;
    
    $data_content_tendencias = getDataTendencias($connection, $_SESSION);
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
    $data_content_tendencias_nodesc = getDataTendenciasNoDesc($connection, $_SESSION);
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
    echo json_encode($resultado_array);
    die;
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