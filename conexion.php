<?php
$host = "localhost";  
$user = "root";  
$password = "";  
$dbname = "formulario";

// Crea la conexión
$conex = mysqli_connect($host, $user, $password, $dbname);

// Verifica la conexión
if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>