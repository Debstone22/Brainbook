<?php
include '../../config/Database.php';

// Conexión con la base de datos
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuario = $_POST['id_usuario'];
    $id_curso = $_POST['id_curso'];
    $numero_semana = $_POST['numero_semana'];
    $id_estado = $_POST['id_estado'];

    // Validar que los datos no estén vacíos
    if (!isset($id_usuario, $id_curso, $numero_semana, $id_estado)) {
        echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
        exit();
    }

    // Actualizar el valor de id_estado en la tabla progreso
    $sql = "UPDATE progreso 
            SET id_estado = :id_estado 
            WHERE id_usuario = :id_usuario AND id_curso = :id_curso AND numero_semana = :numero_semana";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->bindParam(':id_curso', $id_curso);
    $stmt->bindParam(':numero_semana', $numero_semana);
    $stmt->bindParam(':id_estado', $id_estado);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Estado actualizado exitosamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método no permitido']);
}
