<?php
include '../../config/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener y sanitizar los datos del formulario
    $id_usuario = filter_input(INPUT_POST, 'id_usuario', FILTER_VALIDATE_INT);
    $id_curso = filter_input(INPUT_POST, 'id_curso', FILTER_VALIDATE_INT);
    $id_semana = filter_input(INPUT_POST, 'id_semana', FILTER_VALIDATE_INT);
    $id_estado = filter_input(INPUT_POST, 'id_estado', FILTER_VALIDATE_INT);

    // Validar que los campos no estén vacíos
    if ($id_usuario && $id_curso && $id_semana && $id_estado) {
        try {
            // Crear instancia de la base de datos y obtener conexión
            $db = new Database();
            $conn = $db->getConnection();

            // Preparar la consulta
            $sql = "INSERT INTO progreso (id_usuario, id_curso, id_semana, id_estado) 
                    VALUES (:id_usuario, :id_curso, :id_semana, :id_estado)";
            $stmt = $conn->prepare($sql);

            // Ejecutar la consulta con los datos
            $stmt->execute([
                ':id_usuario' => $id_usuario,
                ':id_curso' => $id_curso,
                ':id_semana' => $id_semana,
                ':id_estado' => $id_estado,
            ]);

            // Redirigir en caso de éxito
            header("Location: indexProgreso.php?success=1");
            exit();
        } catch (PDOException $e) {
            // Manejo de errores con PDO
            echo "Error al agregar el progreso: " . $e->getMessage();
        }
    } else {
        echo "Por favor, completa todos los campos correctamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Progreso</title>
</head>
<body>
    <h1>Agregar Progreso</h1>

    <?php
    // Mostrar un mensaje si hay un error o éxito
    if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo "<p style='color: green;'>Progreso agregado exitosamente.</p>";
    }
    ?>

    <form action="" method="POST">
        <label for="id_usuario">ID Usuario:</label>
        <input type="number" name="id_usuario" id="id_usuario" required><br>
        
        <label for="id_curso">ID Curso:</label>
        <input type="number" name="id_curso" id="id_curso" required><br>
        
        <label for="id_semana">ID Semana:</label>
        <input type="number" name="id_semana" id="id_semana" required><br>
        
        <label for="id_estado">ID Estado:</label>
        <input type="number" name="id_estado" id="id_estado" required><br>
        
        <button type="submit">Agregar</button>
    </form>

    <a href="indexProgreso.php">Volver</a>
</body>
</html>
