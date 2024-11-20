<?php
session_start(); // Iniciar sesión

include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busqueda = htmlspecialchars($_POST['busqueda']);
    $query = "SELECT * FROM usuarios WHERE nombre LIKE :busqueda OR apellido LIKE :busqueda OR email LIKE :busqueda";
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generar el HTML para los resultados
    $output = '';
    foreach ($resultado as $fila) {
        $output .= '<tr>';
        $output .= '<td>' . htmlspecialchars($fila['id_usuario']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['nombre']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['apellido']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['email']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['edad']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['celular']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['nombre_rol']) . '</td>';
        $output .= '<td align="center">';
        if ($_SESSION['rol'] == 3 && $fila['id_rol'] != 3) {
            $output .= '<a class="edit" href="#editEmployeeModal" data-toggle="modal"';
            $output .= ' data-id="' . htmlspecialchars($fila['id_usuario']) . '"';
            $output .= ' data-nombres="' . htmlspecialchars($fila['nombre']) . '"';
            $output .= ' data-apellidos="' . htmlspecialchars($fila['apellido']) . '"';
            $output .= ' data-edad="' . htmlspecialchars($fila['edad']) . '"';
            $output .= ' data-telefono="' . htmlspecialchars($fila['celular']) . '"';
            $output .= ' data-email="' . htmlspecialchars($fila['email']) . '"';
            $output .= ' data-rol="' . htmlspecialchars($fila['id_rol']) . '">';
            $output .= '<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
            $output .= '<a class="delete" href="#deleteEmployeeModal" data-toggle="modal"';
            $output .= ' data-id="' . htmlspecialchars($fila['id_usuario']) . '">';
            $output .= '<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
        } else {
            $output .= '<a href="indexUsuarios.php" class="dashboard">';
            $output .= '<i class="material-icons">lock</i></a>';
        }
        $output .= '</td>';
        $output .= '</tr>';
    }

    echo $output;
}
?>
