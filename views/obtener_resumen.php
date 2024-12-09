<?php
include '../config/Database.php';
session_start();

$database = new Database();
$conn = $database->getConnection();

$id_usuario = $_GET['id_usuario'];
$id_curso = $_GET['id_curso'];
$id_semana = $_GET['id_semana'];

// Consulta para obtener el resumen del usuario para la semana y curso actuales
$query_resumen = "SELECT contenido FROM resumen WHERE id_usuario = :id_usuario AND id_curso = :id_curso AND id_semana = :id_semana";
$stmt_resumen = $conn->prepare($query_resumen);
$stmt_resumen->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
$stmt_resumen->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
$stmt_resumen->bindParam(':id_semana', $id_semana, PDO::PARAM_INT);
$stmt_resumen->execute();
$resumen = $stmt_resumen->fetch(PDO::FETCH_ASSOC);

echo $resumen ? $resumen['contenido'] : '';
?>
