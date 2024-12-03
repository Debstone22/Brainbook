<!doctype html>
<?php
require_once __DIR__ . '/../config/Database.php';
session_start(); // Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection(); // Verifica si el usuario ha iniciado sesión 
if (isset($_SESSION['usuario'])) {
    $nombre_usuario = $_SESSION['usuario'];
    $rol_usuario = $_SESSION['rol']; // Asumiendo que el rol del usuario también se almacena en la sesión // Verifica si el usuario tiene el rol adecuado (rol 3 en este caso)
    if ($rol_usuario != 3) { // Si el usuario no tiene rol 3, redirige a una página de acceso denegado 
        header("Location: ../views/index.php");
        exit();
    }
} else { // Si el usuario no ha iniciado sesión, redirige a la página de login 
    header("Location: ../views/index.php");
    exit();
} // Aquí puedes colocar el contenido del dashboard echo "<h1>Bienvenido al Admin Dashboard, $nombre_usuario</h1>";el contenido del dashboard echo "echo "<h1>Bienvenido al Admin Dashboard, .$nombre_usuario .</h1>";"; 


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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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

    </div>
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
                <li class="active">
                    <a href="indexUsuarios.php" class="dashboard"><i class="material-icons">group</i>Usuarios</a>
                </li>
                <li class="">
                    <a href="indexProfesores.php" class=""><i class="material-icons">school</i>Profesores</a>
                </li>
                <li class="">
                    <a href="indexCursos.php" class=""><i class="material-icons">collections_bookmark</i>Cursos</a>
                </li>
                <li class="">
                    <a href="indexModulos.php" class=""><i class="material-icons">chrome_reader_mode</i>Modulos</a>
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
                            <div class="xp-menubar"> <span class="material-icons text-white">signal_cellular_alt</span>
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
                                                    src="logobrainbook.jpeg" style="width:40px; border-radius:50%;" />
                                                <span class="xp-user-live"></span> </a>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="navbarDropdown"> <a class="dropdown-item"
                                                    href="perfil.php"> <span
                                                        class="material-icons">person_outline</span> Perfil </a> <a
                                                    class="dropdown-item" href="../views/logout.php"> <span
                                                        class="material-icons">logout</span> Cerrar sesión </a> </div>
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
            <!------main-content-start----------->
            <div class="main-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                        <h2 class="ml-lg-2">Administrar usuarios</h2>
                                    </div>
                                    <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                            <i class="material-icons">person_add</i>
                                            <span>Agregar nuevo usuario</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            //include_once '../dashboard/admin_usuarios/funciones.php';                         
                            
                            // Configuración de pagina
                            $registros_por_pagina = 6;

                            if (isset($_GET['pagina'])) {
                                $pagina_actual = $_GET['pagina'];
                            } else {
                                $pagina_actual = 1;
                            }

                            // Calcula el offset
                            $offset = ($pagina_actual - 1) * $registros_por_pagina;

                            // Crear instancia de la clase Database y obtener la conexión
                            require_once __DIR__ . '/../config/Database.php';
                            $database = new Database();
                            $conn = $database->getConnection();

                            // Consulta SQL con límite y offset para la paginacion
                            $consulta = "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.apellido, usuarios.email, usuarios.celular, usuarios.edad, usuarios.id_rol, roles.nombre_rol FROM usuarios LEFT JOIN roles ON usuarios.id_rol = roles.id_rol LIMIT :offset, :registros_por_pagina";

                            $stmt = $conn->prepare($consulta);
                            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                            $stmt->bindParam(':registros_por_pagina', $registros_por_pagina, PDO::PARAM_INT);
                            $stmt->execute();

                            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            // se obtiene el numero total de registros
                            $resultado_total = $conn->query("SELECT COUNT(*) AS total FROM usuarios");
                            $row_total = $resultado_total->fetch(PDO::FETCH_ASSOC);
                            $total_registros = $row_total['total'];

                            // Calcula el número total de páginas
                            $total_paginas = ceil($total_registros / $registros_por_pagina);
                            ?>

                            <!DOCTYPE html>
                            <html lang="es">

                            <head>
                                <!-- Otros meta tags y enlaces aquí -->
                            </head>

                            <body>
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombres</th>
                                            <th>Apellidos</th>
                                            <th>Correo</th>
                                            <th>Edad</th>
                                            <th>Teléfono</th>
                                            <th>Rol</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="employeeTable">
                                        <?php
                                        foreach ($resultado as $fila) {
                                            ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($fila['id_usuario']); ?></td>
                                                <td><?php echo htmlspecialchars($fila['nombre']); ?></td>
                                                <td><?php echo htmlspecialchars($fila['apellido']); ?></td>
                                                <td><?php echo htmlspecialchars($fila['email']); ?></td>
                                                <td><?php echo htmlspecialchars($fila['edad']); ?></td>
                                                <td><?php echo htmlspecialchars($fila['celular']); ?></td>
                                                <td><?php echo htmlspecialchars($fila['nombre_rol']); ?></td>
                                                <td align="center">
                                                    <?php
                                                    // Verifica si el usuario actual admin y el usuario en la fila no es super admin
                                                    if ($_SESSION['rol'] == 3 && $fila['id_rol'] != 3) {
                                                        // Si el usuario es admin y el usuario en la fila no lo es , muestra los botones de editar y eliminar
                                                        ?>
                                                        <a class="edit" href="#editEmployeeModal" data-toggle="modal"
                                                            data-id="<?php echo htmlspecialchars($fila['id_usuario']); ?>"
                                                            data-nombres="<?php echo htmlspecialchars($fila['nombre']); ?>"
                                                            data-apellidos="<?php echo htmlspecialchars($fila['apellido']); ?>"
                                                            data-edad="<?php echo htmlspecialchars($fila['edad']); ?>"
                                                            data-telefono="<?php echo htmlspecialchars($fila['celular']); ?>"
                                                            data-email="<?php echo htmlspecialchars($fila['email']); ?>"
                                                            data-rol="<?php echo htmlspecialchars($fila['id_rol']); ?>"> <i
                                                                class="material-icons" data-toggle="tooltip"
                                                                title="Edit">&#xE254;</i> </a>
                                                        <a class="delete" href="#deleteEmployeeModal" data-toggle="modal"
                                                            data-id="<?php echo htmlspecialchars($fila['id_usuario']); ?>"
                                                            data-toggle="tooltip" title="Delete"> <i class="material-icons"
                                                                data-toggle="tooltip" title="Delete">&#xE872;</i> </a>
                                                        <?php
                                                        // Si no se cumplen las condiciones anteriores, se muestra un icono de bloqueo.
                                                    } else {
                                                        ?>
                                                        <a href="indexUsuarios.php" class="dashboard">
                                                            <i class="material-icons">lock</i>

                                                        </a>

                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </body>

                            </html>

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
                                            <a href="?pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <?php if ($pagina_actual < $total_paginas): ?>
                                        <li class="page-item"><a href="?pagina=<?php echo $pagina_actual + 1; ?>"
                                                class="page-link">Siguiente</a></li>
                                    <?php else: ?>
                                        <li class="page-item disabled"><a href="#" class="page-link">Siguiente</a></li>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </div>
                        <!-- Modal de Crear Usuario -->
                        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog"
                            aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEmployeeModalLabel">Crear Usuario</h5> <button
                                            type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                                aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <form id="crearUsuarioForm" action="admin_usuarios/agregar_Usuario.php"
                                        method="POST">
                                        <div class="modal-body">
                                            <div class="form-group"> <label for="nombres"
                                                    class="form-label">Nombres:</label> <input type="text" id="nombres"
                                                    name="nombres" class="form-control" required> </div>
                                            <div class="form-group"> <label for="apellidos"
                                                    class="form-label">Apellidos:</label> <input type="text"
                                                    id="apellidos" name="apellidos" class="form-control" required>
                                            </div>
                                            <div class="form-group"> <label for="edad" class="form-label">Edad:</label>
                                                <input type="text" id="edad" name="edad" class="form-control" required>
                                            </div>
                                            <div class="form-group"> <label for="telefono"
                                                    class="form-label">Teléfono:</label> <input type="tel" id="telefono"
                                                    name="telefono" class="form-control" required> </div>
                                            <div class="form-group"> <label for="email"
                                                    class="form-label">Correo:</label> <input type="text" id="email"
                                                    name="email" class="form-control" required> </div>
                                            <div class="form-group"> <label for="password"
                                                    class="form-label">Contraseña:</label> <input type="password"
                                                    id="password" name="password" class="form-control" required> </div>
                                            <div class="form-group"> <label for="rol" class="form-label">Rol de usuario
                                                    *</label> <select id="rol" name="rol" class="form-control" required>
                                                    <option value="1" selected>Usuario</option>
                                                    <?php if ($_SESSION['rol'] == 3): ?>
                                                        <!-- Si el usuario actual es super admin, se muestran las opciones de administrador y super admin -->
                                                        <option value="2">Profesor</option>
                                                        <option value="3">Administrador</option> <?php endif; ?>
                                                </select> </div> <input type="hidden" name="action"
                                                value="crear_registro">
                                        </div>
                                        <div class="modal-footer"> <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button> <button type="submit"
                                                class="btn btn-success">Crear</button> </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para editar Usuario -->
                        <div class="modal fade" id="editEmployeeModal" tabindex="-1" role="dialog"
                            aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editEmployeeModalLabel">Editar Usuario</h5> <button
                                            type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                                aria-hidden="true">&times;</span> </button>
                                    </div>
                                    <form id="editarUsuarioForm" action="admin_usuarios/editar_Usuario.php"
                                        method="POST">
                                        <div class="modal-body">
                                            <!-- input ID oculto para enviarlo a editar_Usuario-->
                                            <input type="hidden" id="editId" name="editId" class="form-control">
                                            <div class="form-group"> <label for="nombres"
                                                    class="form-label">Nombres:</label>
                                                <input type="text" id="editNombres" name="nombres" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group"> <label for="apellidos"
                                                    class="form-label">Apellidos:</label>
                                                <input type="text" id="editApellidos" name="editApellidos"
                                                    class="form-control" required>
                                            </div>
                                            <div class="form-group"> <label for="edad" class="form-label">Edad:</label>
                                                <input type="text" id="editEdad" name="edad" class="form-control"
                                                    required>
                                            </div>
                                            <div class="form-group"> <label for="telefono"
                                                    class="form-label">Teléfono:</label> <input type="tel"
                                                    id="editTelefono" name="telefono" class="form-control" required>
                                            </div>
                                            <div class="form-group"> <label for="editEmail"
                                                    class="form-label">Correo:</label> <input type="text" id="editEmail"
                                                    name="editEmail" class="form-control" required> </div>

                                            <div class="form-group"> <label for="rol" class="form-label">Rol de usuario
                                                    *</label> <select id="editRol" name="rol" class="form-control"
                                                    required>
                                                    <option value="1" selected>Usuario</option>
                                                    <?php if ($_SESSION['rol'] == 3): ?>
                                                        <!-- Si el usuario actual es super admin, se muestran las opciones de administrador y super admin -->
                                                        <option value="2">Profesor</option>
                                                        <option value="3">Administrador</option> <?php endif; ?>
                                                </select> </div> <input type="hidden" name="action"
                                                value="crear_registro">
                                        </div>
                                        <div class="modal-footer"> <button type="submit"
                                                class="btn btn-success">Guardar</button> </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal de Eliminación -->

                        <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteEmployeeModalLabel">Eliminar Usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estas seguro sobre esta eliminación del registro?</p>
                                        <p class="text-danger"><small>Esta acción no se puede revertir.</small></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="admin_usuarios/eliminar_Usuario.php" method="POST">
                                            <!-- input ID oculto para enviarlo a editar_Usuario-->

                                            <input type="hidden" id="borrarId" name="borrarId" class="form-control">

                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-danger">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Fin del Modal de Eliminación -->


                        <!----edit-modal end--------->

                        <!----delete-modal start--------->

                        <!----delete-modal end--------->
                    </div>
                </div>
                <!------main-content-end----------->

            </div>

            <!----footer-design------------->

        </div>
        <!--        <script>
            function handleSubmit() {
                alert("El usuario ha sido creado con éxito.");
                window.location.href = "../../dashboard/indexUsuarios.php";
            }
        </script>-->
        <script src="sources/js/jquery-3.3.1.slim.min.js"></script>
        <script src="sources/js/popper.min.js"></script>
        <script src="sources/js/bootstrap.min.js"></script>
        <script src="sources/js/jquery-3.3.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
            $(document).ready(function () {
                function attachEvents() {
                    const editButtons = document.querySelectorAll('.edit');
                    const deleteButtons = document.querySelectorAll('.delete');

                    editButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const userId = button.getAttribute('data-id');
                            const userNombres = button.getAttribute('data-nombres');
                            const userApellidos = button.getAttribute('data-apellidos');
                            const userEdad = button.getAttribute('data-edad');
                            const userTelefono = button.getAttribute('data-telefono');
                            const userEmail = button.getAttribute('data-email');
                            const userRol = button.getAttribute('data-rol');

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

                    deleteButtons.forEach(button => {
                        button.addEventListener('click', () => {
                            const deleteUserId = button.getAttribute('data-id');
                            console.log(deleteUserId); // Para depuración

                            document.getElementById('borrarId').value = deleteUserId;
                        });
                    });
                }

                $("#busqueda").on("input", function () {
                    var query = $(this).val();
                    console.log("Consulta: " + query); // Para depuración
                    $.ajax({
                        url: 'admin_usuarios/buscar_usuario.php',
                        type: 'POST',
                        data: { busqueda: query },
                        success: function (response) {
                            console.log("Respuesta del servidor: " + response); // Para depuracion de errores
                            $("#employeeTable").html(response);
                            attachEvents(); // Re-adjuntar eventos a los nuevos elementos (editar y eliminar)
                        },
                        error: function (xhr, status, error) {
                            console.error("Error: " + error); // Para depuracion
                        }
                    });
                });

                // Adjuntar eventos inicialmente
                attachEvents();
            });
        </script>


        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>








</body>

</html>