<?php
include '../config/Database.php';
session_start();

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_usuario'];
    $id_curso = $_POST['id_curso'];
    $id_semana = $_POST['id_semana'];
    $contenido = $_POST['contenido'];

    // Verificar que el id_usuario y el id_semana existan en las tablas correspondientes
    $query_verificar_usuario = "SELECT COUNT(*) FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt_verificar_usuario = $conn->prepare($query_verificar_usuario);
    $stmt_verificar_usuario->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt_verificar_usuario->execute();
    $usuario_existe = $stmt_verificar_usuario->fetchColumn();

    $query_verificar_semana = "SELECT COUNT(*) FROM semana WHERE id_semana = :id_semana";
    $stmt_verificar_semana = $conn->prepare($query_verificar_semana);
    $stmt_verificar_semana->bindParam(':id_semana', $id_semana, PDO::PARAM_INT);
    $stmt_verificar_semana->execute();
    $semana_existe = $stmt_verificar_semana->fetchColumn();

    if ($usuario_existe > 0 && $semana_existe > 0) {
        // Comprobar si ya existe un resumen para este usuario, curso y semana
        $query_verificar_resumen = "SELECT COUNT(*) FROM resumen WHERE id_usuario = :id_usuario AND id_curso = :id_curso AND id_semana = :id_semana";
        $stmt_verificar_resumen = $conn->prepare($query_verificar_resumen);
        $stmt_verificar_resumen->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt_verificar_resumen->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
        $stmt_verificar_resumen->bindParam(':id_semana', $id_semana, PDO::PARAM_INT);
        $stmt_verificar_resumen->execute();
        $resumen_existe = $stmt_verificar_resumen->fetchColumn();

        if ($resumen_existe > 0) {
            // Actualizar el resumen existente
            $query = "UPDATE resumen SET contenido = :contenido WHERE id_usuario = :id_usuario AND id_curso = :id_curso AND id_semana = :id_semana";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':contenido', $contenido, PDO::PARAM_STR);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->bindParam(':id_semana', $id_semana, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Redirigir a la página anterior
                header("Location: frontedcurse.php?id_curso=$id_curso");
                exit();
            } else {
                echo "Error al actualizar el resumen.";
            }
        } else {
            // Insertar un nuevo resumen
            $query = "INSERT INTO resumen (id_usuario, id_curso, id_semana, contenido) VALUES (:id_usuario, :id_curso, :id_semana, :contenido)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
            $stmt->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
            $stmt->bindParam(':id_semana', $id_semana, PDO::PARAM_INT);
            $stmt->bindParam(':contenido', $contenido, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Redirigir a la página anterior
                header("Location: frontedcurse.php?id_curso=$id_curso");
                exit();
            } else {
                echo "Error al guardar el resumen.";
            }
        }
    } else {
        echo "El usuario o la semana no existen.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
