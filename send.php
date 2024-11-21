<?php

include("conexion.php");

if (!$conex) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    if (
        !empty($_POST['phone']) &&
        !empty($_POST['email']) &&
        !empty($_POST['password']) &&
        !empty($_POST['nombre']) &&
        !empty($_POST['apellido'])
    ) {
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);

        // Validación de email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Correo inválido.";
            exit;
        }

        // Encriptar contraseña
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Inserción en la tabla usuarios
        $queryUser = "INSERT INTO usuarios (phone, email, password) VALUES (?, ?, ?)";
        if ($stmtUser = mysqli_prepare($conex, $queryUser)) {
            mysqli_stmt_bind_param($stmtUser, "sss", $phone, $email, $hashedPassword);
            if (mysqli_stmt_execute($stmtUser)) {
                $user_id = mysqli_insert_id($conex);

                // Inserción en la tabla perfiles
                $queryProfile = "INSERT INTO perfiles (user_id, nombre, apellido) VALUES (?, ?, ?)";
                if ($stmtProfile = mysqli_prepare($conex, $queryProfile)) {
                    mysqli_stmt_bind_param($stmtProfile, "iss", $user_id, $nombre, $apellido);
                    if (mysqli_stmt_execute($stmtProfile)) {
                        // Redirección tras el registro exitoso
                        header("Location: http://localhost/paginapelis");
                        exit;
                    } else {
                        echo "Error al crear el perfil: " . mysqli_error($conex);
                    }
                    mysqli_stmt_close($stmtProfile);
                } else {
                    echo "Error al preparar consulta para perfil: " . mysqli_error($conex);
                }
            } else {
                echo "Error al registrar usuario: " . mysqli_error($conex);
            }
            mysqli_stmt_close($stmtUser);
        } else {
            echo "Error al preparar consulta para usuario: " . mysqli_error($conex);
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

mysqli_close($conex);
?>
