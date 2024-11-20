<?php
session_start(); // Iniciar sesión

include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busqueda = htmlspecialchars($_POST['busqueda']);

    // Si no hay término de búsqueda, selecciona todos los usuarios
    if (empty($busqueda)) {
        $query = "SELECT * FROM usuarios";
    } else {
        $query = "SELECT * FROM usuarios WHERE nombre LIKE :busqueda OR apellido LIKE :busqueda OR email LIKE :busqueda";
    }

    $stmt = $conn->prepare($query);

    if (!empty($busqueda)) {
        $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
    }

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

        // Convertir ID de rol a nombre de rol $roleName = ''; 
        switch ($fila['id_rol']) {
            case 1:
                $roleName = 'Usuario';
                break;
            case 2:
                $roleName = 'Profesor';
                break;
            case 3:
                $roleName = 'Administrador';
                break;
            default:
                $roleName = 'Desconocido';
                break;
        }
        $output .= '<td>' . htmlspecialchars($roleName) . '</td>';
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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const editButtons = document.querySelectorAll('.edit');
        const deleteButtons = document.querySelectorAll('.delete');

        //rellenar el formulario de editar con los datos de la fila
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const userId = button.getAttribute('data-id');
                const userNombres = button.getAttribute('data-nombres');
                const userApellidos = button.getAttribute('data-apellidos');
                const userEdad = button.getAttribute('data-edad');
                const userTelefono = button.getAttribute('data-telefono');
                const userEmail = button.getAttribute('data-email');
                const userRol = button.getAttribute('data-rol');

                console.log(userEmail); // log para verificar xd
                console.log(userRol); // log para verificar xd

                document.getElementById('editNombres').value = userNombres;
                document.getElementById('editApellidos').value = userApellidos;
                document.getElementById('editEdad').value = userEdad;
                document.getElementById('editTelefono').value = userTelefono;
                document.getElementById('editEmail').value = userEmail;
                document.getElementById('editRol').value = userRol;
                document.getElementById('editId').value = userId;

                let userIdInput = document.getElementById('user_id_input');
                if (!userIdInput) {
                    userIdInput = document.createElement('input');
                    userIdInput.type = 'hidden';
                    userIdInput.id = 'user_id_input';
                    userIdInput.name = 'id_usuario';
                    document.getElementById('crearUsuarioForm').appendChild(userIdInput);
                }
                userIdInput.value = userId;
            });
        });

        //rellenar el formulario de editar con los datos de la fila
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const deleteUserId = button.getAttribute('data-id');
                console.log("recibi la informacion para borrar")
                console.log(deleteUserId); // log para verificar xd

                document.getElementById('borrarId').value = deleteUserId;
            });
        });
    });
</script>