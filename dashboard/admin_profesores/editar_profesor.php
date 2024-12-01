<?php
session_start();
include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $id_usuario = htmlspecialchars($_POST['editId']);
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellidos = htmlspecialchars($_POST['editApellidos']);
    $edad = htmlspecialchars($_POST['edad']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = htmlspecialchars($_POST['editEmail']);
    $rol = htmlspecialchars($_POST['rol']);

    // Preparar la consulta SQL
    $query = "UPDATE usuarios SET nombre = :nombres, apellido = :apellidos, edad = :edad, celular = :telefono, email = :email, id_rol = :rol WHERE id_usuario = :id_usuario";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':rol', $rol);
    $stmt->bindParam(':id_usuario', $id_usuario);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Usuario actualizado exitosamente!";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar usuario.";
        $_SESSION['tipo_mensaje'] = "danger";
    }
    
    // Redirigir al dashboard
    header("Location: ../../dashboard/indexProfesores.php");
    exit();
} else {
    // Si no es una solicitud POST, redirigir al formulario
    header("Location: ../../dashboard/indexProfesores.php");
    exit();
}
?>