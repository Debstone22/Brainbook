<?php
session_start();
include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database-> getConnection();

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del curso del formulario
    $id_curso = htmlspecialchars($_POST['borrarId']);

    // Preparar la consulta SQL
    $query = "DELETE FROM cursos WHERE id_curso = :id_curso";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_curso', $id_curso);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Curso eliminado exitosamente!";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar curso.";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    
    // Redirigir al dashboard
    header("Location: ../../dashboard/indexCursos.php");
    exit();
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header("Location: ../../dashboard/indexCursos.php");
    exit();
}
?>
