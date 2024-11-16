<?php
// Datos de conexión
$servidor = "localhost";
$usuario = "root";  // Este es el usuario por defecto en XAMPP
$password = "";  // En XAMPP, la contraseña de root es vacía por defecto
$base_de_datos = "brainbook";

// Crear la conexión
$conn = new mysqli($servidor, $usuario, $password, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

echo "Conexión exitosa a la base de datos";
?>
