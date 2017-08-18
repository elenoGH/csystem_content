<?php

require '../../models/session.php';

if (isset($_POST['get_all_compras_cliente'])) {
        
    $array_articulos_comprados = getAllDataArticulosComprados($connection, $_SESSION);
    $array_series_compradas = getAllDataSeriesComprados($connection, $_SESSION);
    
    $data_array = array(
        'array_data_articulos' => $array_articulos_comprados
         , 'array_data_series' => $array_series_compradas
    );
    
    echo json_encode($data_array);
    die;
}

function getAllDataArticulosComprados($connection, $SESSION)
{
    $query = mysql_query(" select tcc.id as id_compra, tcc.*, tce.*, tto.*, tu.nombre as nombreAutor, tu.email
            from tbl_compras_cliente tcc
            inner join tbl_contenido_escritor tce on tce.id = tcc.id_contenido_as
            right join tbl_topicos tto on tce.id_topico = tto.id 
            right join tbl_usuario tu on tu.id = tce.id_usuario
            where tcc.id > 0 
            and tcc.id_cliente = ".$_SESSION['id_user']."
            and tcc.tipo_contenido_comprado = 'articulo' "
            , $connection) or die(mysql_error());
    
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[] = $data_array;
    }
    return $array_resultado;
}

function getAllDataSeriesComprados($connection, $SESSION)
{
    $query = mysql_query(" select tcc.*, tse.*
        from tbl_compras_cliente tcc
        inner join tbl_serie_escritor tse on tse.id = tcc.id_contenido_as
        where tcc.id > 0 
        and tcc.id_cliente = ".$_SESSION['id_user']."
        and tcc.tipo_contenido_comprado = 'serie' "
            , $connection) or die(mysql_error());
    
    $array_resultado = array();
    while ($data_array = mysql_fetch_array($query, MYSQL_ASSOC)) {
        $array_resultado[] = $data_array;
    }
    return $array_resultado;
}