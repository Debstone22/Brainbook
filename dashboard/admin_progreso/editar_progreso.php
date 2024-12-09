<?php
include '../../config/Database.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar si todos los datos requeridos están presentes
    if (!isset($_POST['id_usuario'], $_POST['id_curso'], $_POST['id_semana'], $_POST['id_estado'])) {
        die("Error: Faltan datos requeridos para realizar la operación.");
    }

    // Capturar los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $id_curso = $_POST['id_curso'];
    $id_semana = $_POST['id_semana'];
    $id_estado = $_POST['id_estado'];

    // Validar si los valores tienen el formato correcto
    if (!is_numeric($id_usuario) || !is_numeric($id_curso) || !is_numeric($id_semana) || !is_numeric($id_estado)) {
        die("Error: Todos los valores deben ser números válidos.");
    }

    // Consulta para verificar si el registro existe
    $sql_check = "SELECT * FROM progreso WHERE id_usuario = :id_usuario AND id_curso = :id_curso AND id_semana = :id_semana";
    $stmt_check = $conn->prepare($sql_check);

    $stmt_check->execute([
        ':id_usuario' => $id_usuario,
        ':id_curso' => $id_curso,
        ':id_semana' => $id_semana
    ]);

    if ($stmt_check->rowCount() > 0) {
        // Si el registro existe, actualiza el estado
        $sql_update = "UPDATE progreso SET id_estado = :id_estado WHERE id_usuario = :id_usuario AND id_curso = :id_curso AND id_semana = :id_semana";
        $stmt_update = $conn->prepare($sql_update);

        // Ejecutar la actualización
        if ($stmt_update->execute([
            ':id_estado' => $id_estado,
            ':id_usuario' => $id_usuario,
            ':id_curso' => $id_curso,
            ':id_semana' => $id_semana
        ])) {
            echo "Estado actualizado exitosamente.";
        } else {
            echo "Error: No se pudo actualizar el estado. Inténtalo nuevamente.";
        }
    } else {
        echo "Error: No se encontró un registro que coincida con los criterios especificados.";
    }
} else {
    echo "Error: El método de solicitud debe ser POST.";
}
?>

