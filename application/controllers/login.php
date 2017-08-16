<?php

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['login'])) {
    if (empty($_POST['inputEmail']) || empty($_POST['inputPassword']) || empty($_POST['selectTypeUser'])) {
        $error = "Completa Todos los Campos!";
    } else {
// Define $username and $password
        $username = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];
        $tipoUser = $_POST['selectTypeUser'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysql_connect("localhost", "root", "");
        //$connection = mysql_connect("localhost", "csystem", "csystem");
// To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
// Selecting Database
        $db = mysql_select_db("csystem", $connection);
// SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("select * from tbl_usuario where password='$password' AND email='$username' or username='".$username."'", $connection);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
            
            $_SESSION['login_user'] = $username; // Initializing Session
            
            $res = mysql_fetch_array($query, MYSQL_ASSOC);
            $_SESSION['rol_user'] = $res['rol'];
            $_SESSION['id_user'] = $res['id'];
            $_SESSION['name_user'] = $res['username'];
            $_SESSION['rol_user'] = $res['rol'];
            $_SESSION['tipoUserx'] = $tipoUser;
            
            if ($_SESSION['rol_user'] == 1) {
                if ($tipoUser == 2) {
                    header("location: application/views/autor.php"); // Redirecting To Other Page
                } else {
                    header("location: application/views/cliente.php"); // Redirecting To Other Page
                }
            }
//            else if ($_SESSION['rol_user'] == 1) {
//                header("location: application/views/down_contenido.php"); // Redirecting To Other Page
//            }
            
        } else {
            $error = "Usuario o contraseña Invalida";
        }
        mysql_close($connection); // Closing Connection
    }
}
else if (isset ($_POST['registrar'])) {
    if (empty($_POST['nombreCompleto']) || empty($_POST['inputEmail']) || empty($_POST['inputPassword']) || empty($_POST['nombreUsuario']) || empty($_POST['selectTypeUser'])) {
        $error = "Completa todos los campos!";
    } else {
        $connection = mysql_connect("localhost", "root", "");
        //$connection = mysql_connect("localhost", "csystem", "csystem");
        $db = mysql_select_db("csystem", $connection);
        
        $nombreCompleto = $_POST['nombreCompleto'];
        $inputEmail = $_POST['inputEmail'];
        $inputPassword = $_POST['inputPassword'];
        $nombreUsuario = $_POST['nombreUsuario'];
        $selectTypeUser = $_POST['selectTypeUser'];
        
        $q = "INSERT INTO `tbl_usuario` (`username`, `password`, `rol`"
                . ", `email`, `nombre`) "
                . " VALUES ('$nombreUsuario','$inputPassword' ,'$selectTypeUser'"
                . ", '$inputEmail','$nombreCompleto')";
        
        $result_insert = mysql_query($q) or die(mysql_error());
        /**
         * obtener datos una ves insertado
         */
        if ($result_insert) {
            
            $query = mysql_query("select * from tbl_usuario where password='$inputPassword' AND email='$inputEmail' or username='".$nombreUsuario."'", $connection) or die(mysql_error());
            $rows = mysql_num_rows($query);
            if ($rows == 1) {

                $_SESSION['login_user'] = $nombreUsuario;

                $res = mysql_fetch_array($query, MYSQL_ASSOC);
                $_SESSION['rol_user'] = $res['rol'];
                $_SESSION['id_user'] = $res['id'];
                $_SESSION['name_user'] = $res['username'];
                $_SESSION['rol_user'] = $res['rol'];

                if ($_SESSION['rol_user'] == 2) {
                    header("location: application/views/autor.php");
                } else {
                    header("location: application/views/cliente.php");
                }

            } else {
                $error = "Usuario o contraseña Invalida";
            }
            mysql_close($connection); // Closing Connection
        
        }
    }
}
