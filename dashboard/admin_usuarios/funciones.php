<?php
include '../config/database.php'; 
require_once $_SERVER['DOCUMENT_ROOT'] . '/Brainbook/config/Database.php';
//global $conn;

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'editar_registro':
            editar_registro($conn); // Pasar la variable $conn como argumento
            break;

        case 'eliminar_registro':
            eliminar_registro($conn); // Pasar la variable $conn como argumento
            break;

        case 'crear_registro':
            crear_registro($conn);
            break;

        case 'buscar_registro':
            buscar_registro($conn);
            break;
    }
}

function crear_registro($conn) {
    extract($_POST);
    if (telefono_existe($conn, $telefono)) {
        echo '<script>
                alert("El número de teléfono ya está registrado.");
                window.location.href = "../../dashboard/indexUsuarios.php";
              </script>';
        exit();
    }
    if (email_existe($conn, $email)) {
        echo '<script>
                alert("El correo electrónico ya está registrado.");
                window.location.href = "../../dashboard/indexUsuarios.php";
              </script>';
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $consulta = "INSERT INTO usuario (nombres, apellidos, telefono, email, id_rol, password) VALUES ('$nombres', '$apellidos', '$telefono', '$email', '$rol', '$hashed_password')";
    if (mysqli_query($conn, $consulta)) {
        header('Location: ../../dashboard/indexUsuarios.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function editar_registro($conn) { // Recibir $conn como argumento
    extract($_POST);
    $consulta = "UPDATE usuario SET id_rol = '$rol' WHERE id_usuario = '$id'";
    if (mysqli_query($conn, $consulta)) {
        header('Location: ../../dashboard/indexUsuarios.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function eliminar_registro($conn) { // Recibir $conn como argumento
    extract($_POST);
    $id = $_POST['id'];
    $consulta = "DELETE FROM usuario WHERE id_usuario= $id";
    if (mysqli_query($conn, $consulta)) {
        header('Location: ../../dashboard/indexUsuarios.php');
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

function buscar_registro($conn) {
    // Verificar si el campo de búsqueda está vacío
    if (empty($_POST['busqueda'])) {
        echo '
            <script>
                alert("Por favor ingrese un criterio de busqueda.");
                window.location.href="../../dashboard/indexUsuarios.php";
            </script>
        ';
    }

    $busqueda = $_POST['busqueda'];
    $consulta = "SELECT usuario.id_usuario, usuario.nombres, usuario.apellidos, usuario.telefono, usuario.email, bd_rol.titulo_rol, usuario.id_rol 
                                            FROM usuario 
                                            LEFT JOIN bd_rol ON usuario.id_rol = bd_rol.id_rol 
                                            WHERE usuario.nombres LIKE '%$busqueda%' 
                                            OR usuario.apellidos LIKE '%$busqueda%' 
                                            OR usuario.email LIKE '%$busqueda%' 
                                            OR usuario.telefono LIKE '%$busqueda%'";
    $resultado = mysqli_query($conn, $consulta);

    // Recoger los resultados en un array
    $resultados = array();
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $resultados[] = $fila;
    }

    return $resultados;
}

//Funciones de validaciones para administrar usuarios:

function telefono_existe($conn, $telefono) {
    $consulta = "SELECT * FROM usuario WHERE telefono = '$telefono'";
    $resultado = mysqli_query($conn, $consulta);
    return mysqli_num_rows($resultado) > 0;
}

function email_existe($conn, $email) {
    $consulta = "SELECT * FROM usuario WHERE email = '$email'";
    $resultado = mysqli_query($conn, $consulta);
    return mysqli_num_rows($resultado) > 0;
}
