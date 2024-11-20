<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturamos los datos enviados desde el formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Conexión a la base de datos
    include '../config/database.php'; 

    // Crear instancia de la clase Database y obtener la conexión
    $database = new Database();
    $conn = $database->getConnection();

    // Preparar la consulta
    $query = "SELECT id_usuario, id_rol, nombre, password FROM Usuarios WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    // Verificar si el usuario existe
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id_usuario = $row['id_usuario'];
        $id_rol = $row['id_rol'];
        $nombre_usuario = $row['nombre'];
        $stored_password = $row['password'];

        // Verificar si la contraseña almacenada es un hash
        if (password_verify($password, $stored_password)) {
            // Contraseña hasheada verificada
            session_start();
            $_SESSION['usuario'] = $nombre_usuario;
            $_SESSION['rol'] = $id_rol;
            header("Location: index.php"); // Redirecciona a un dashboard o página principal
            exit();
        } elseif ($stored_password === $password) {
            // Contraseña en texto plano verificada, actualizar a un hash
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $update_query = "UPDATE Usuarios SET password = :hashed_password WHERE id_usuario = :id_usuario";
            $update_stmt = $conn->prepare($update_query);
            $update_stmt->bindParam(':hashed_password', $hashed_password);
            $update_stmt->bindParam(':id_usuario', $id_usuario);
            $update_stmt->execute();

            session_start();
            $_SESSION['usuario'] = $nombre_usuario;
            $_SESSION['rol'] = $id_rol;
            header("Location: index.php"); // Redirecciona a un dashboard o página principal
            exit();
        } else {
            echo "<p>Contraseña incorrecta. Por favor, intenta de nuevo.</p>";
        }
    } else {
        echo "<p>Correo electrónico no encontrado. Por favor, intenta de nuevo.</p>";
    }
}
?>
