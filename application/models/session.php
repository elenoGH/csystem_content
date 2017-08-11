<?php

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
//$connection = mysql_connect("localhost", "csystem", "csystem");
$connection = mysql_connect("localhost", "root", "");
// Selecting Database
$db = mysql_select_db("csystem", $connection);
session_start(); // Starting Session
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = mysql_query("select nombre, apellido from tbl_usuario where email='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session = $row['nombre'];
if (!isset($login_session)) {
    mysql_close($connection); // Closing Connection
    header('Location: ../../index.php'); // Redirecting To Home Page
}
if (!mysql_set_charset('utf8',$connection)) {
//    printf("Error cargando el conjunto de caracteres utf8: %s\n", mysqli_error($con));
    exit();
} else {
//    printf("Conjunto de caracteres actual: %s\n", mysqli_character_set_name($con));
}
