<!doctype html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Brainbook/config/Database.php';
session_start(); // Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection(); // Verifica si el usuario ha iniciado sesión 
if (isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['usuario'];
    $rol_usuario = $_SESSION['rol']; // Verifica si el usuario tiene el rol adecuado (rol 3 en este caso)A
    if ($rol_usuario != 3) { // Si el usuario no tiene rol 3, redirige a una página de acceso denegado 
        header("Location: ../views/index.php");
        exit();
    }
} else { // Si el usuario no ha iniciado sesión, redirige a la página de login 
    header("Location: ../views/index.php");
    exit();
}

function obtenerTituloRol($rol_usuario)
{
    switch ($rol_usuario) {
        case 1:
            return 'Usuario';
        case 2:
            return 'Profesor';
        case 3:
            return 'Administrador';
        default:
            return 'Desconocido';
    }
}
?>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Administración</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../dashboard/sources/css/bootstrap.min.css">
    <!----css3---->
    <link rel="stylesheet" href="../dashboard/sources/css/custom.css">
    <!--google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!--google material icon-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">

    <style>
        /* modal para agregar usuario */
        .modal-content {
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 20);

        }

        .form-control {
            border: 2px solid #007bff;
        }

        /* estilos para las waves del footer*/
        .bg-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: url('wavi.svg') no-repeat center center/cover;
        }

        .content {
            position: relative;
            z-index: 1;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="bg-svg">
        <div class="wrapper">
            <div class="body-overlay"></div>
            <!-------sidebar--design------------>
            <div id="sidebar">
                <div class="sidebar-header">
                    <a href="../views/index.php">
                        <h3><img src="logobrainbook.jpeg" class="img-fluid" /><span>BrainBook</span></h3>
                    </a>
                </div>
                <ul class="list-unstyled component m-0">
                    <li class="">
                        <a href="indexUsuarios.php" class="dashboard"><i class="material-icons">group</i>Usuarios</a>
                    </li>
                    <li class="">
                        <a href="indexProfesores.php" class=""><i class="material-icons">school</i>Profesores</a>
                    </li>
                    <li class="active">
                        <a href="indexCursos.php" class=""><i class="material-icons">collections_bookmark</i>Cursos</a>
                    </li>
                    <li class="">
                        <a href="indexSolicitudes.php" class=""><i
                                class="material-icons">chrome_reader_mode</i>Rubricas</a>
                    </li>
                </ul>
            </div>
            <!-------sidebar--design- close----------->
            <!-------page-content start----------->
            <div id="content">
                <!------top-navbar-start----------->
                <div class="top-navbar">
                    <div class="xd-topbar">
                        <div class="row">
                            <div class="col-2 col-md-1 col-lg-1 order-2 order-md-1 align-self-center">
                                <div class="xp-menubar"> <span
                                        class="material-icons text-white">signal_cellular_alt</span>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-3 order-3 order-md-2">
                                <div class="xp-searchbar">
                                    <div class="input-group">
                                        <input type="search" id="busqueda" class="form-control" placeholder="Buscar...">
                                        <div class="input-group-append"> <button class="btn" type="submit"
                                                id="button-addon2">🔎</button> </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                                <div class="xp-profilebar text-right">
                                    <nav class="navbar p-0">
                                        <ul class="nav navbar-nav flex-row ml-auto">
                                            <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#"
                                                    id="navbarDropdown" role="button" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"> <img
                                                        src="logobrainbook.jpeg"
                                                        style="width:40px; border-radius:50%;" />
                                                    <span class="xp-user-live"></span> </a>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="navbarDropdown"> <a class="dropdown-item"
                                                        href="perfil.php"> <span
                                                            class="material-icons">person_outline</span> Perfil </a> <a
                                                        class="dropdown-item" href="../views/logout.php"> <span
                                                            class="material-icons">logout</span> Cerrar sesión </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="xp-breadcrumbbar text-center">
                            <h4 class="page-title">Dashboard</h4>
                            <?php //obtiene el titulo y el rol del usuario activo
                            if (isset($_SESSION['usuario']) && isset($_SESSION['rol'])) {
                                $titulo_rol = obtenerTituloRol($_SESSION['rol']);
                                echo '<ol class="breadcrumb"> <li class="breadcrumb-item active">Bienvenido</li> <li class="breadcrumb-item active" aria-current="page">' . $titulo_rol . ' ' . htmlspecialchars($nombre_usuario) . '</li> </ol>';
                            } ?>
                        </div>
                    </div>
                </div> <!------top-navbar-end----------->
                <!------top-navbar-end----------->
                <!------main-content-start----------->
                <div class="main-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                            <h2 class="ml-lg-2">Administrar Cursos</h2>
                                        </div>
                                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                                <i class="material-icons">&#xE147;</i>
                                                <span>Agregar nueva Curso</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <?php // Configuración de la paginación 
                                $registros_por_pagina = 5; 
                                if (isset($_GET['pagina'])) {
                                    $pagina_actual = $_GET['pagina'];
                                } else {
                                    $pagina_actual = 1;
                                } // Calcula el offset 
                                $offset = ($pagina_actual - 1) * $registros_por_pagina; // Crear instancia de la clase Database y obtener la conexión 
                                require_once $_SERVER['DOCUMENT_ROOT'] . '/Brainbook/config/Database.php';
                                $database = new Database();
                                $conn = $database->getConnection(); // Consulta SQL con límite y offset para la paginación 
                                $consulta = "SELECT cursos.id_curso, cursos.nombre_curso, cursos.descripcion, cursos.status, cursos.version, cursos.imagen, (SELECT COUNT(*) FROM curso_estudiante WHERE curso_estudiante.id_curso = cursos.id_curso) AS usuarios_inscritos FROM cursos LIMIT :offset, :registros_por_pagina";
                                $stmt = $conn->prepare($consulta);
                                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                                $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
                                $stmt->execute();
                                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC); // Se obtiene el número total de registros 
                                $resultado_total = $conn->query("SELECT COUNT(*) AS total FROM cursos");
                                $row_total = $resultado_total->fetch(PDO::FETCH_ASSOC);
                                $total_registros = $row_total['total']; // Calcula el número total de páginas 
                                $total_paginas = ceil($total_registros / $registros_por_pagina); ?>
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre del Curso</th>
                                                <th>Descripción</th>
                                                <th>Status</th>
                                                <th>Versión</th>
                                                <th>Imagen</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="courseTable"> <?php foreach ($resultado as $fila) { ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($fila['id_curso']); ?></td>
                                                    <td><?php echo htmlspecialchars($fila['nombre_curso']); ?></td>
                                                    <td><?php echo htmlspecialchars($fila['descripcion']); ?></td>
                                                    <td><?php echo htmlspecialchars($fila['status']); ?></td>
                                                    <td><?php echo htmlspecialchars($fila['version']); ?></td>
                                                    <td> <?php if (!empty($fila['imagen'])) { // Codificar datos binarios de la imagen en base64 
                                                                $imagenData = base64_encode($fila['imagen']); // Determinar el tipo MIME de la imagen 
                                                                $finfo = new finfo(FILEINFO_MIME_TYPE);
                                                                $mimeType = $finfo->buffer($fila['imagen']);
                                                                echo '<img src="data:' . $mimeType . ';base64,' . $imagenData . '" alt="Imagen del Curso" width="50" height="50">';
                                                            } else {
                                                                echo 'No hay imagen';
                                                            } ?>
                                                    </td>
                                                    <td align="center"> <!-- Botones de editar y eliminar --> <a
                                                            class="edit" href="#editCourseModal" data-toggle="modal"
                                                            data-id="<?php echo htmlspecialchars($fila['id_curso']); ?>"
                                                            data-nombre="<?php echo htmlspecialchars($fila['nombre_curso']); ?>"
                                                            data-descripcion="<?php echo htmlspecialchars($fila['descripcion']); ?>"
                                                            data-status="<?php echo htmlspecialchars($fila['status']); ?>"
                                                            data-version="<?php echo htmlspecialchars($fila['version']); ?>"
                                                            data-imagen="<?php echo htmlspecialchars($fila['imagen']); ?>">
                                                            <i class="material-icons" data-toggle="tooltip"
                                                                title="Edit">&#xE254;</i> </a> <a class="delete"
                                                            href="#deleteCourseModal" data-toggle="modal"
                                                            data-id="<?php echo htmlspecialchars($fila['id_curso']); ?>"> <i
                                                                class="material-icons" data-toggle="tooltip"
                                                                title="Delete">&#xE872;</i> </a> </td>
                                                </tr> <?php } ?>
                                        </tbody>
                                    </table>
                                    <!-- Paginación -->
                                    <div class="clearfix">
                                        <div class="hint-text">Mostrando
                                            <b><?php echo min(count($resultado), $registros_por_pagina); ?></b> de
                                            <b><?php echo $total_registros; ?></b>
                                        </div>
                                        <ul class="pagination">
                                            <?php if ($pagina_actual > 1): ?>
                                                <li class="page-item"><a href="?pagina=<?php echo $pagina_actual - 1; ?>"
                                                        class="page-link">Atrás</a></li>
                                            <?php else: ?>
                                                <li class="page-item disabled"><a href="#" class="page-link">Atrás</a></li>
                                            <?php endif; ?>
                                            <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                                <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                                                    <a href="?pagina=<?php echo $i; ?>"
                                                        class="page-link"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <?php if ($pagina_actual < $total_paginas): ?>
                                                <li class="page-item"><a href="?pagina=<?php echo $pagina_actual + 1; ?>"
                                                        class="page-link">Siguiente</a></li>
                                            <?php else: ?>
                                                <li class="page-item disabled"><a href="#" class="page-link">Siguiente</a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>

                            </div>
                        </div>
                        <!-- Modal Agregar curso -->


                        <!-- Modal para editar Curso -->
                        <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog"
                            aria-labelledby="editCourseModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editCourseModalLabel">Editar Cursoasd</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="editarCursoForm" action="admin_cursos/editar_curso.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <!-- input ID oculto para enviarlo a editar_Curso -->
                                            <input type="hidden" id="editId" name="editId" class="form-control">
                                            <div class="form-group">
                                                <label for="nombre_curso" class="form-label">Nombre del Curso:</label>
                                                <input type="text" id="editNombreCurso" name="nombre_curso"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="descripcion" class="form-label">Descripción:</label>
                                                <textarea id="editDescripcion" name="descripcion" class="form-control"
                                                    required></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="status" class="form-label">Status:</label>
                                                <input type="text" id="editStatus" name="status" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="version" class="form-label">Versión:</label>
                                                <input type="text" id="editVersion" name="version" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="imagen" class="form-label">Imagen:</label>
                                                <input type="file" id="editImagen" name="imagen" class="form-control"
                                                    accept="image/png, image/jpeg, image/jpg" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!----modal para eliminar curso--------->

                        
                    </div>
                </div>
                <!------main-content-end----------->
            </div>
        </div>
        <!-------complete html----------->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="sources/js/jquery-3.3.1.slim.min.js"></script>
        <script src="sources/js/popper.min.js"></script>
        <script src="sources/js/bootstrap.min.js"></script>
        <script src="sources/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".xp-menubar").on('click', function () {
                    $("#sidebar").toggleClass('active');
                    $("#content").toggleClass('active');
                });
                $('.xp-menubar,.body-overlay').on('click', function () {
                    $("#sidebar,.body-overlay").toggleClass('show-nav');
                });

            });
        </script>
        <script>
            $(document).ready(function () {
                function attachEvents() {
                    const editButtons = document.querySelectorAll('.edit');
                    const deleteButtons = document.querySelectorAll('.delete');

                    editButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const cursoId = button.getAttribute('data-id');
                            const cursoNombre = button.getAttribute('data-nombre');
                            const cursoDescripcion = button.getAttribute('data-descripcion');
                            const cursoStatus = button.getAttribute('data-status');
                            const cursoVersion = button.getAttribute('data-version');
                            const cursoImagen = button.getAttribute('data-imagen');
                            const cursoIdUsuario = button.getAttribute('data-id_usuario');

                            document.getElementById('editId').value = cursoId;
                            document.getElementById('editNombreCurso').value = cursoNombre;
                            document.getElementById('editDescripcion').value = cursoDescripcion;
                            document.getElementById('editStatus').value = cursoStatus;
                            document.getElementById('editVersion').value = cursoVersion;
                            document.getElementById('editImagen').value = '';

                            // Comprueba si el elemento existe antes de intentar establecer su valor
                            const idUsuarioInput = document.getElementById('editIdUsuario');
                            if (idUsuarioInput) {
                                idUsuarioInput.value = cursoIdUsuario;
                            } else {
                                console.warn('El elemento con ID "editIdUsuario" no existe en el DOM.');
                            }
                        });
                    });

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const deleteCursoId = button.getAttribute('data-id');
                            console.log(deleteCursoId); // Para depuración

                            document.getElementById('deleteId').value = deleteCursoId;
                        });
                    });
                }

                // Inicializar los eventos al cargar la página
                attachEvents();
            });
        </script>


</body>

</html>