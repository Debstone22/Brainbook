<?php
session_start(); // Iniciar sesión

include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busqueda = htmlspecialchars($_POST['busqueda']);
    $pagina_actual = isset($_POST['pagina']) ? (int)$_POST['pagina'] : 1;
    $registros_por_pagina = 5;
    $offset = ($pagina_actual - 1) * $registros_por_pagina;

    // Construir consulta SQL con búsqueda, paginación y filtro por rol de usuario (id_rol 1 y 3)
    if (empty($busqueda)) {
        $query = "SELECT * FROM usuarios WHERE id_rol IN (1, 3) LIMIT :offset, :registros_por_pagina";
    } else {
        $query = "SELECT * FROM usuarios WHERE id_rol IN (1, 3) AND (nombre LIKE :busqueda OR apellido LIKE :busqueda OR email LIKE :busqueda) LIMIT :offset, :registros_por_pagina";
    }

    $stmt = $conn->prepare($query);

    if (!empty($busqueda)) {
        $stmt->bindValue(':busqueda', '%' . $busqueda . '%', PDO::PARAM_STR);
    }
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);

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

        // Convertir ID de rol a nombre de rol
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

    // Calcular el total de registros encontrados
    if (empty($busqueda)) {
        $query_total = "SELECT COUNT(*) as total FROM usuarios WHERE id_rol IN (1, 3)";
    } else {
        $query_total = "SELECT COUNT(*) as total FROM usuarios WHERE id_rol IN (1, 3) AND (nombre LIKE :busqueda OR apellido LIKE :busqueda OR email LIKE :busqueda)";
    }

    $stmt_total = $conn->prepare($query_total);

    if (!empty($busqueda)) {
        $stmt_total->bindValue(':busqueda', '%' . $busqueda . '%', PDO::PARAM_STR);
    }
    
    $stmt_total->execute();
    $total_registros = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];
    $total_paginas = ceil($total_registros / $registros_por_pagina);

    // Generar HTML para la paginación
    // Generar HTML para la paginación
    
    $output .= '</ul></nav></td></tr>';

    echo $output;
    
}
?>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const editButtons = document.querySelectorAll('.edit');
        const deleteButtons = document.querySelectorAll('.delete');

        // Rellenar el formulario de editar con los datos de la fila
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

        // Rellenar el formulario de eliminar con los datos de la fila
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const deleteUserId = button.getAttribute('data-id');
                console.log("recibi la informacion para borrar")
                console.log(deleteUserId); // log para verificar xd

                document.getElementById('borrarId').value = deleteUserId;
            });
        });
    });

    function buscarUsuarios(pagina) {
        var query = $("#busqueda").val();
        console.log("Consulta: " + query); // Para depuración
        $.ajax({
            url: 'admin_usuarios/buscar_usuario.php',
            type: 'POST',
            data: { busqueda: query, pagina: pagina },
            success: function (response) {
                console.log("Respuesta del servidor: " + response); // Para depuración de errores
                $("#userTable").html(response); // Asegúrate de usar el ID correcto de la tabla
                attachEvents(); // Re-adjuntar eventos a los nuevos elementos (editar y eliminar)
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error); // Para depuración
            }
        });
    }
</script>
