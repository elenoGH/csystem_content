<?php

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
    if (empty($_POST['inputEmail']) || empty($_POST['inputPassword'])) {
        $error = "Correo o contraseña incorrecta!";
    } else {
// Define $username and $password
        $username = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysql_real_escape_string($username);
        $password = mysql_real_escape_string($password);
// Selecting Database
        $db = mysql_select_db("csystem", $connection);
// SQL query to fetch information of registerd users and finds user match.
        $query = mysql_query("select * from tbl_usuario where password='$password' AND email='$username'", $connection);
        $rows = mysql_num_rows($query);
        if ($rows == 1) {
            $_SESSION['login_user'] = $username; // Initializing Session
            
            $res = mysql_fetch_array($query, MYSQL_ASSOC);
            $rol = $res['rol'];
            $_SESSION['rol_user'] = $rol;
            if ($rol == 0) {
                header("location: application/views/up_contenido.php"); // Redirecting To Other Page
            }else if ($rol == 1) {
                header("location: application/views/down_contenido.php"); // Redirecting To Other Page
            }
            
        } else {
            $error = "Usuario o contraseña Invalida";
        }
        mysql_close($connection); // Closing Connection
    }
}
