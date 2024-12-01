<?php
session_start();
include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $nombre_curso = htmlspecialchars($_POST['nombre_curso']);
    $descripcion = htmlspecialchars($_POST['descripcion']);
    $status = htmlspecialchars($_POST['status']);
    $version = htmlspecialchars($_POST['version']);
    
    // Verificar si se sube una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $target_dir = "../uploads/"; // Subir a la carpeta uploads en dashboard
        
        // Verificar si el directorio existe y crearlo si no
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
                
                // Preparar la consulta SQL
                $query = "INSERT INTO cursos (nombre_curso, descripcion, status, version, imagen) VALUES 
                (:nombre_curso, :descripcion, :status, :version, :imagen)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':nombre_curso', $nombre_curso);
                $stmt->bindParam(':descripcion', $descripcion);
                $stmt->bindParam(':status', $status);
                $stmt->bindParam(':version', $version);
                $stmt->bindParam(':imagen', $relative_path);
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
        // Si no se sube una imagen, insertar null en la columna imagen
        $query = "INSERT INTO cursos (nombre_curso, descripcion, status, version, imagen) VALUES 
        (:nombre_curso, :descripcion, :status, :version, NULL)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre_curso', $nombre_curso);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':version', $version);
    }

    // Ejecutar la consulta
    if ($stmt->execute()) {
        $_SESSION['mensaje'] = "Curso agregado exitosamente!";
        $_SESSION['tipo_mensaje'] = "success";
    } else {
        $_SESSION['mensaje'] = "Error al agregar curso.";
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
