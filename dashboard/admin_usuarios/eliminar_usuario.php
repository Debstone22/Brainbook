<?php
session_start();
include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener el ID del usuario del formulario
    $id_usuario = htmlspecialchars($_POST['borrarId']);

    // Preparar la consulta SQL
    $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_usuario', $id_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Usuario eliminado exitosamente!";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al eliminar usuario.";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    
    // Redirigir al dashboard
    header("Location: ../../dashboard/indexUsuarios.php");
    exit();
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header("Location: ../../dashboard/indexUsuarios.php");
    exit();
}
?>
