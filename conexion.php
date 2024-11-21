<?php
$host = "localhost";  
$user = "root";  
$password = "";  
$dbname = "formulario";
$port = 3307;
// Crea la conexión
$conex = mysqli_connect($host, $user, $password, $dbname , $port);

// Verifica la conexión
if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>