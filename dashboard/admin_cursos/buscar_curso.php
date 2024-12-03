<?php
session_start(); // Iniciar sesión

include '../../config/Database.php';

// Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection();

$registros_por_pagina = 5;
$pagina_actual = isset($_POST['pagina']) ? $_POST['pagina'] : 1;
$offset = ($pagina_actual - 1) * $registros_por_pagina;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $busqueda = htmlspecialchars($_POST['busqueda']);

    // Si no hay término de búsqueda, selecciona todos los cursos
    if (empty($busqueda)) {
        $query = "SELECT * FROM cursos LIMIT :offset, :registros_por_pagina";
    } else {
        $query = "SELECT * FROM cursos WHERE nombre_curso LIKE :busqueda OR descripcion LIKE :busqueda LIMIT :offset, :registros_por_pagina";
    }

    $stmt = $conn->prepare($query);

    if (!empty($busqueda)) {
        $stmt->bindValue(':busqueda', '%' . $busqueda . '%');
    }
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);

    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generar el HTML para los resultados
    $output = '';
    foreach ($resultado as $fila) {
        $output .= '<tr>';
        $output .= '<td>' . htmlspecialchars($fila['id_curso']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['nombre_curso']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['descripcion']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['status']) . '</td>';
        $output .= '<td>' . htmlspecialchars($fila['version']) . '</td>';
        $output .= '<td>';
        if (!empty($fila['imagen'])) {
            $output .= '<img src="' . htmlspecialchars($fila['imagen']) . '" alt="Imagen del Curso" width="50" height="50" class="img-thumbnail">';
        } else {
            $output .= 'No hay imagen';
        }
        $output .= '</td>';
        $output .= '<td align="center">';
        if ($_SESSION['rol'] == 3) {
            $output .= '<a class="edit" href="#editCourseModal" data-toggle="modal"';
            $output .= ' data-id="' . htmlspecialchars($fila['id_curso']) . '"';
            $output .= ' data-nombre="' . htmlspecialchars($fila['nombre_curso']) . '"';
            $output .= ' data-descripcion="' . htmlspecialchars($fila['descripcion']) . '"';
            $output .= ' data-status="' . htmlspecialchars($fila['status']) . '"';
            $output .= ' data-version="' . htmlspecialchars($fila['version']) . '"';
            $output .= ' data-imagen="' . htmlspecialchars($fila['imagen']) . '">';
            $output .= '<i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
            $output .= '<a class="delete" href="#deleteCourseModal" data-toggle="modal"';
            $output .= ' data-id="' . htmlspecialchars($fila['id_curso']) . '">';
            $output .= '<i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
        } else {
            $output .= '<a href="indexCursos.php" class="dashboard">';
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

        // Rellenar el formulario de editar con los datos de la fila
        editButtons.forEach(button => {
            button.addEventListener('click', () => {
                const cursoId = button.getAttribute('data-id');
                const cursoNombre = button.getAttribute('data-nombre');
                const cursoDescripcion = button.getAttribute('data-descripcion');
                const cursoStatus = button.getAttribute('data-status');
                const cursoVersion = button.getAttribute('data-version');
                const cursoImagen = button.getAttribute('data-imagen');

                document.getElementById('editId').value = cursoId;
                document.getElementById('editNombreCurso').value = cursoNombre;
                document.getElementById('editDescripcion').value = cursoDescripcion;
                document.getElementById('editStatus').value = cursoStatus;
                document.getElementById('editVersion').value = cursoVersion;
                document.getElementById('editImagen').value = '';

                let cursoIdInput = document.getElementById('curso_id_input');
                if (!cursoIdInput) {
                    cursoIdInput = document.createElement('input');
                    cursoIdInput.type = 'hidden';
                    cursoIdInput.id = 'curso_id_input';
                    cursoIdInput.name = 'id_curso';
                    document.getElementById('editarCursoForm').appendChild(cursoIdInput);
                }
                cursoIdInput.value = cursoId;
            });
        });

        // Rellenar el formulario de eliminar con los datos de la fila
        deleteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const deleteCursoId = button.getAttribute('data-id');
                console.log("recibi la informacion para borrar");
                console.log(deleteCursoId); // log para verificar xd

                document.getElementById('borrarId').value = deleteCursoId;
            });
        });
    });
</script>
