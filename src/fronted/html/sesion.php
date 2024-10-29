<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Capturamos los datos enviados desde el formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Leemos el archivo JSON de usuarios
    $json_data = file_get_contents("usuarios.json");
    $usuarios = json_decode($json_data, true);

    // Variable para indicar si el login fue exitoso
    $login_exitoso = false;

    // Recorrer los usuarios y verificar las credenciales
    foreach ($usuarios as $usuario) {
        if ($usuario['email'] === $email && $usuario['password'] === $password) {
            $login_exitoso = true;
            $nombre_usuario = $usuario['nombre'];
            $id_rol = $usuario['id_rol'];
            break;
        }
    }

    if ($login_exitoso) {
        // Redireccionar al usuario según su rol
        session_start();
        $_SESSION['usuario'] = $nombre_usuario;
        $_SESSION['rol'] = $id_rol;
        header("Location: index.php"); // Redirecciona a un dashboard o página principal
        exit();
    } else {
        echo "<p>Credenciales incorrectas. Por favor, intenta de nuevo.</p>";
    }
}
?>