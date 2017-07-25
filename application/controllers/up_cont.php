<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../models/session.php';

    if (isset($_POST['data_up'])) {
    //    echo 'hola';
    //    $query = mysql_query("select * from user", $connection);
    //    
    //    while ($row = mysql_fetch_assoc($query)) { 
    //     foreach($row as $field => $value) { 
    //          //do something with $field and $val 
    //        } 
    //    } 
    //
    //    die;
        $id_usuario = 1;
        $descripcion = 'descripcion de prueba dos';
        $url = 'http://localhost/dashboard/';
        $path_source = 'path/';
        $red_social = '{"1":"faceboock", "2":"twitter", "3":"instagram"}';
        
        $q = "INSERT INTO `tbl_contenido` (`id_usuario`, `descripcion`, `url`, `path_source`, `red_social`) VALUES ('$id_usuario', '$descripcion','$url','$path_source','$red_social')";

       //Run Query
       $result = mysql_query($q) or die(mysql_error());
       
       return $result;

    }