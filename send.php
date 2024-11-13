<?php

include("conexion.php");

if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    
    if (
        strlen($_POST['phone']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['password']) >= 1 &&
        strlen($_POST['nombre']) >= 1 &&
        strlen($_POST['apellido']) >= 1
    ) {
        
        
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        
        
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        
        $queryUser = "INSERT INTO usuarios (phone, email, password) VALUES (?, ?, ?)";
        
        if ($stmtUser = mysqli_prepare($conex, $queryUser)) {
            mysqli_stmt_bind_param($stmtUser, "sss", $phone, $email, $hashedPassword);
            
            if (mysqli_stmt_execute($stmtUser)) {
                
                $user_id = mysqli_insert_id($conex);

                
                $queryProfile = "INSERT INTO perfiles (user_id, nombre, apellido) VALUES (?, ?, ?)";
                
                if ($stmtProfile = mysqli_prepare($conex, $queryProfile)) {
                    mysqli_stmt_bind_param($stmtProfile, "iss", $user_id, $nombre, $apellido);
                    
                    if (mysqli_stmt_execute($stmtProfile)) {
                        echo "¡Registro exitoso y perfil creado!";
                        echo "<script>window.location.href = 'http://localhost/paginapelis';</script>";
                        exit;
                    } else {
                        echo "Error al crear el perfil: " . mysqli_error($conex);
                    }
                    
                    mysqli_stmt_close($stmtProfile);
                } else {
                    echo "Error en la preparación de la consulta de perfil: " . mysqli_error($conex);
                }
            } else {
                echo "Error al registrar usuario: " . mysqli_error($conex);
            }
            
            mysqli_stmt_close($stmtUser);
        } else {
            echo "Error en la preparación de la consulta de usuario: " . mysqli_error($conex);
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

if ($conex) {
    mysqli_close($conex);
}
?>
