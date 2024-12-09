<?php
include '../../config/Database.php';

$database = new Database();
$conn = $database->getConnection();

// Leer y decodificar datos JSON enviados
$data = json_decode(file_get_contents("php://input"), true);

// Validar si todos los datos requeridos están presentes
if (
    isset($data['id_usuario']) &&
    isset($data['id_curso']) &&
    isset($data['id_semana']) &&
    isset($data['id_estado'])
) {
    // Asignar variables
    $id_usuario = $data['id_usuario'];
    $id_curso = $data['id_curso'];
    $id_semana = $data['id_semana'];
    $id_estado = $data['id_estado'];

    // Consulta para actualizar el estado
    $query = "UPDATE progreso 
              SET id_estado = :id_estado 
              WHERE id_usuario = :id_usuario 
                AND id_curso = :id_curso 
                AND id_semana = :id_semana";

    $stmt = $conn->prepare($query);

    // Vincular parámetros
    $stmt->bindParam(':id_estado', $id_estado, PDO::PARAM_INT);
    $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
    $stmt->bindParam(':id_semana', $id_semana, PDO::PARAM_INT);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => "Error al actualizar el estado."]);
    }
} else {
    // Responder con un mensaje de error si faltan datos
    echo json_encode(["success" => false, "error" => "Datos incompletos."]);
}
?>
