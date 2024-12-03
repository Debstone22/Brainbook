<?php
session_start();
include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $id_curso = htmlspecialchars($_POST['editId']);
    $nombre_curso = htmlspecialchars($_POST['nombre_curso']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $status = htmlspecialchars($_POST['status']);
    $version = htmlspecialchars($_POST['version']);

    // Verificar si se sube una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $target_dir = "../uploads/";

        // Verificar si el directorio existe
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $filename = basename($_FILES["imagen"]["name"]);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["imagen"]["tmp_name"]);
        if ($check !== false) {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
                // Preparar la ruta relativa que se guardará en la base de datos
                $relative_path = "uploads/" . $filename;

                // Preparar la consulta SQL para actualizar el curso con nueva imagen
                $query = "UPDATE cursos SET nombre_curso = :nombre_curso, descripcion = :descripcion, status = :status, version = :version, imagen = :imagen WHERE id_curso = :id_curso";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nombre_curso', $nombre_curso);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':version', $version);
                $stmt->bindParam(':imagen', $relative_path);
                $stmt->bindParam(':id_curso', $id_curso);
            } else {
                $_SESSION['mensaje'] = "Lo siento, hubo un error al subir la imagen.";
                $_SESSION['tipo_mensaje'] = "danger";
                header("Location: ../../dashboard/indexCursos.php");
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "El archivo no es una imagen.";
            $_SESSION['tipo_mensaje'] = "danger";
            header("Location: ../../dashboard/indexCursos.php");
            exit();
        }
    } else {
        // Preparar la consulta SQL para actualizar el curso sin cambiar la imagen
        $query = "UPDATE cursos SET nombre_curso = :nombre_curso, descripcion = :descripcion, status = :status, version = :version WHERE id_curso = :id_curso";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre_curso', $nombre_curso);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':version', $version);
        $stmt->bindParam(':id_curso', $id_curso);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Curso actualizado exitosamente!";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al actualizar curso.";
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
