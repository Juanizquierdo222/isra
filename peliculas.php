<!-- peliculas.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <link rel="stylesheet" href="style.css"> <!-- Tu archivo de estilos si lo tienes -->
</head>
<body>

    <h2>Películas Disponibles</h2>

    <div class="peliculas-container">
        <?php
        include("conexion.php"); // Incluye la conexión a la base de datos

        // Realiza una consulta para obtener las películas
        $query = "SELECT id, titulo, trailer_url FROM peliculas";
        $result = mysqli_query($conex, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $titulo = $row['titulo'];
                $trailer_url = $row['trailer_url'];

                // Muestra el título de la película y un enlace para ver el tráiler
                echo "<div class='movie'>
                        <h3>$titulo</h3>
                        <a href='$trailer_url' target='_blank' class='btn-trailer'>Ver Tráiler</a>
                        </div>";
            }
        } else {
            echo "No hay películas disponibles.";
        }
        ?>
    </div>

</body>
</html>
