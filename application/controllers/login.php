<?php

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['login'])) {
    if (empty($_POST['inputEmail']) || empty($_POST['inputPassword']) || empty($_POST['selectTypeUser_login'])) {
        $error = "Completa Todos los Campos!";
    } else {
        
        $tipoUser = $_POST['selectTypeUser_login'];
        
        $connection = mysql_connect("localhost", "root", "");
        //$connection = mysql_connect("localhost", "csystem", "csystem");
        
        $username = mysql_real_escape_string(stripslashes($_POST['inputEmail']));
        $password = mysql_real_escape_string(stripslashes($_POST['inputPassword']));
        
        $db = mysql_select_db("csystem", $connection);
        
        $query = mysql_query("select * from "
                . "tbl_usuario "
                . "where password='$password' "
                . " AND email='$username' or username='".$username."' or nickname= '".$username."' "
                , $connection);
        
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
            
            $_SESSION['login_user'] = $username; // Initializing Session
            
            $res = mysql_fetch_array($query, MYSQL_ASSOC);
            $_SESSION['rol_user'] = $res['rol'];
            $_SESSION['id_user'] = $res['id'];
            $_SESSION['name_user'] = ($selectTypeUser==2?$res['nickname']:$res['username']);
            $_SESSION['rol_user'] = $res['rol'];
            $_SESSION['tipoUserx'] = $tipoUser;
            
            if ($_SESSION['rol_user'] == 1) {
                if ($tipoUser == 2) {
                    header("location: application/views/autor/autor.php"); // Redirecting To Other Page
                } else {
                    header("location: application/views/cliente/cliente.php"); // Redirecting To Other Page
                }
            }
        } else {
            $error = "Usuario o contraseña Invalida";
        }
        mysql_close($connection); // Closing Connection
    }
}
else if (isset ($_POST['registrar'])) {
    if (empty($_POST['nombreCompleto']) || empty($_POST['inputEmail']) || empty($_POST['inputPassword']) || empty($_POST['nombreUsuario']) || empty($_POST['selectTypeUser_registro'])) {
        $error = "Completa todos los campos!";
    } else {
        $connection = mysql_connect("localhost", "root", "");
        //$connection = mysql_connect("localhost", "csystem", "csystem");
        $db = mysql_select_db("csystem", $connection);
        
        $nombreCompleto = $_POST['nombreCompleto'];
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $nombreUsuario = $_POST['nombreUsuario'];
        $selectTypeUser = $_POST['selectTypeUser_registro'];
        
        if ($selectTypeUser == 2) {
            $q = "INSERT INTO `tbl_usuario` (`nickname`, `password`, `rol`"
                . ", `email`, `nombre`) "
                . " VALUES ('$nombreUsuario','$inputPassword' ,'$selectTypeUser'"
                . ", '$inputEmail','$nombreCompleto')";
        } else {
            $q = "INSERT INTO `tbl_usuario` (`username`, `password`, `rol`"
                . ", `email`, `nombre`) "
                . " VALUES ('$nombreUsuario','$inputPassword' ,'$selectTypeUser'"
                . ", '$inputEmail','$nombreCompleto')";
        }
        
        $result_insert = mysql_query($q) or die(mysql_error());
        /**
         * obtener datos una ves insertado
         */
        if ($result_insert) {
            
            $query = mysql_query(" select * "
                    . " from tbl_usuario "
                    . " where password='$inputPassword' "
                    . " AND email='$inputEmail' or username='".$nombreUsuario."' or nickname= '".$nombreUsuario."' "
                    , $connection) or die(mysql_error());
            
            $rows = mysql_num_rows($query);
            if ($rows == 1) {

                $_SESSION['login_user'] = $nombreUsuario;

                $res = mysql_fetch_array($query, MYSQL_ASSOC);
                $_SESSION['rol_user'] = $res['rol'];
                $_SESSION['id_user'] = $res['id'];
                $_SESSION['name_user'] = ($selectTypeUser==2?$res['nickname']:$res['username']);
                $_SESSION['rol_user'] = $res['rol'];

                if ($_SESSION['rol_user'] == 2) {
                    header("location: application/views/autor/autor.php");
                } else {
                    header("location: application/views/cliente/cliente.php");
                }

            } else {
                $error = "Usuario o contraseña Invalida";
            }
            mysql_close($connection); // Closing Connection
        
        }
    }
}
