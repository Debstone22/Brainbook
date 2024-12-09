<?php
include '../../config/Database.php';

session_start();
$database = new Database();
$conn = $database->getConnection(); // Establece la conexión

// Consulta para obtener los datos de la tabla progreso
$sql = "SELECT * FROM progreso ORDER BY id_progreso";
$result = $conn->query($sql);

if (!$result) {
    die("Error al ejecutar la consulta: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Progresos</title>
</head>
<body>
    <h1>Gestión de Progresos</h1>
    
    <a href="agregar_progreso.php">Agregar Progreso</a>
    <table border="1">
        <tr>
            <th>ID Progreso</th>
            <th>ID Usuario</th>
            <th>ID Curso</th>
            <th>ID Semana</th>
            <th>ID Estado</th>
            <th>Acciones</th>
        </tr>
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?php echo $row['id_progreso']; ?></td>
                <td><?php echo $row['id_usuario']; ?></td>
                <td><?php echo $row['id_curso']; ?></td>
                <td><?php echo $row['id_semana']; ?></td>
                <td><?php echo $row['id_estado']; ?></td>
                <td>
                    <a href="editar_progreso.php?id=<?php echo $row['id_progreso']; ?>">Editar</a>
                    <a href="eliminar_progreso.php?id=<?php echo $row['id_progreso']; ?>">Eliminar</a>
                </td>
            </tr>
        <?php } ?>

    </table>
</body>
</html>

