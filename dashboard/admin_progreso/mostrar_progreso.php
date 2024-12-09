<?php
session_start(); // Inicia la sesión para acceder al id_usuario

// Verificar si el usuario está logueado
if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["error" => "Usuario no logueado"]);
    exit();
}

// Obtener el id_usuario de la sesión
$id_usuario = $_SESSION['id_usuario'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "brainbook3";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(["error" => "Error de conexión: " . $conn->connect_error]));
}

// Consulta para obtener el progreso del usuario logueado
$sql = "SELECT id_estado FROM progreso WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$total = 0;
$completados = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $total++;
        if ($row['id_estado'] == 1) { // Contar solo los estados '1'
            $completados++;
        }
    }
}

// Calcular el porcentaje de progreso
$porcentaje = ($total > 0) ? ($completados / $total) * 100 : 0;

// Cerrar la conexión a la base de datos
$stmt->close();
$conn->close();

// Enviar el porcentaje como respuesta JSON
header('Content-Type: application/json');
echo json_encode(['porcentaje' => round($porcentaje)]);
?>