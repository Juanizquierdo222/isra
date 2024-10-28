<?php

include("conexion.php");


if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}


if (isset($_POST['send'])) {
    
    if (
        strlen($_POST['phone']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1
    ) {
        
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $query = "INSERT INTO usuarios (phone, email, password) VALUES (?, ?, ?)";

        
        if ($stmt = mysqli_prepare($conex, $query)) {
            // Vincular los parámetros
            mysqli_stmt_bind_param($stmt, "sss", $phone, $email, $hashedPassword);
            
            
            if (mysqli_stmt_execute($stmt)) {
                echo "¡Registro exitoso!";
                // Redirigir después de un registro exitoso
                echo "<script>window.location.href = 'http://localhost/paginapelis';</script>";
                exit; // Detiene la ejecución del script para evitar cerrar la conexión
            } else {
                echo "Error al registrar usuario: " . mysqli_error($conex);
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($conex);
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}


if ($conex) {
    mysqli_close($conex);
}
?>
