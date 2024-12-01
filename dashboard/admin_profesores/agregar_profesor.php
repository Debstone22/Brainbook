<?php
session_start();
include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $id = htmlspecialchars($_POST['editId']);
    $nombres = htmlspecialchars($_POST['nombres']);
    $apellidos = htmlspecialchars($_POST['apellidos']);
    $edad = htmlspecialchars($_POST['edad']);
    $telefono = htmlspecialchars($_POST['telefono']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $rol = htmlspecialchars($_POST['rol']);

    // Hashear la contraseña para mayor seguridad
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Preparar la consulta SQL
    $query = "INSERT INTO usuarios ( id_rol,nombre, apellido, email, password, edad,celular) VALUES 
    (:rol, :nombres, :apellidos,:email,  :password, :edad, :telefono)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':rol', $rol);
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':apellidos', $apellidos);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':edad', $edad);
    $stmt->bindParam(':telefono', $telefono);
    
    
    
    

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Usuario agregado exitosamente!";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar usuario.";
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
