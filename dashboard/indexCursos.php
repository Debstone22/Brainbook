<!doctype html>
<?php
include '../config/Database.php';
global $conn;
session_start();
error_reporting(0);
$user_id = $_SESSION['idUser'];
$user_name = $_SESSION['nombreUser'];
$pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
$validar = $_SESSION['nombreUser'];

/*if ($validar == null || $validar = '') {
    header("Location: ../index.php");
    die();
}

$validarID = $_SESSION['id_rol'];

if ($validarID === 1) {
    header("Location: ../index.php");
    die();
}*/


function obtenerTituloRol($id_rol) {
    switch ($id_rol) {
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
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons"rel="stylesheet">
    </head>
    <body>
        <div class="wrapper">
            <div class="body-overlay"></div>
            <!-------sidebar--design------------>
            <div id="sidebar">
                <div class="sidebar-header">
                    <a href="../views/index.php">
                        <h3><img src="logobrainbook.jpeg" class="img-fluid"/><span>BrainBook</span></h3>
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
                        <a href="indexSolicitudes.php" class=""><i class="material-icons">chrome_reader_mode</i>Rubricas</a>
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
                                <div class="xp-menubar">
                                    <span class="material-icons text-white">signal_cellular_alt</span>
                                </div>
                            </div>
                            <div class="col-md-5 col-lg-3 order-3 order-md-2">
                                <div class="xp-searchbar">
                                    <form action="admin_mascotas/buscar_mascota.php" method="POST">
                                        <div class="input-group">
                                            <input type="search" name="busqueda" class="form-control" placeholder="Buscar por nombre..." value="<?php echo isset($_POST['busqueda']) ? htmlspecialchars($_POST['busqueda'], ENT_QUOTES) : ''; ?>">
                                            <div class="input-group-append">
                                                <button class="btn" type="submit" id="button-addon2">🔎</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-10 col-md-6 col-lg-8 order-1 order-md-3">
                                <div class="xp-profilebar text-right">
                                    <nav class="navbar p-0">
                                        <ul class="nav navbar-nav flex-row ml-auto">
                                            <?php
                                            /*
                                            $select = mysqli_query($conn, "SELECT * FROM usuario WHERE id_usuario = '$user_id'") or die('query failed');
                                            if (mysqli_num_rows($select) > 0) {
                                                $fetch = mysqli_fetch_assoc($select);
                                                // Extraer la ruta de la imagen del usuario de la fila obtenida de la base de datos
                                                $imagen_usuario = $fetch['image'];
                                            }

                                            // Verificar si la imagen del usuario está vacía o no existe
                                            if (empty($imagen_usuario)) {
                                                $imagen_usuario = 'default-avatar.png'; // Imagen por defecto
                                            } else {
                                                $imagen_usuario = 'uploaded_img/' . $imagen_usuario;
                                            }

                                            echo '<li class="dropdown nav-item">
                                                        <a class="nav-link" href="#" data-toggle="dropdown">
                                                            <img src="../assets/img/' . $imagen_usuario . '" style="width:40px; border-radius:50%;"/>
                                                            <span class="xp-user-live"></span>
                                                        </a>
                                                        <ul class="dropdown-menu small-menu">
                                                            <li><a href="/PatitasSOSPiuraOficial/view/perfil.php">
                                                                    <span class="material-icons">person_outline</span>
                                                                    Perfil
                                                                </a></li>
                                                            <li><a href="/PatitasSOSPiuraOficial/dataAccess/cerrar_sesion.php">
                                                                    <span class="material-icons">logout</span>
                                                                    Cerrar sesión
                                                                </a></li>
                                                        </ul>
                                                      </li>';*/
                                            ?>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="xp-breadcrumbbar text-center">
                            <h4 class="page-title">Dashboard</h4>
                            <?php
                            if (isset($_SESSION['nombreUser']) && isset($_SESSION['id_rol'])) {
                                $titulo_rol = obtenerTituloRol($_SESSION['id_rol']);
                                echo '<ol class="breadcrumb">
                                    <li class="breadcrumb-item active">Bienvenido</li>
                                    <li class="breadcrumb-item active" aria-current="page">' . $titulo_rol . ' ' . $_SESSION['nombreUser'] . '</li>
                                  </ol>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!------top-navbar-end-----------> 
                <!------main-content-start-----------> 
                <div class="main-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-wrapper">
                                <div class="table-title">
                                    <div class="row">
                                        <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                                            <h2 class="ml-lg-2">Administrar mascotas</h2>
                                        </div>
                                        <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                                                <i class="material-icons">&#xE147;</i>
                                                <span>Agregar nueva mascota</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Configuración de paginación
                                $registros_por_pagina = 5;

                                if (isset($_GET['pagina'])) {
                                    $pagina_actual = $_GET['pagina'];
                                } else {
                                    $pagina_actual = 1;
                                }

                                // Calcula el offset
                                $offset = ($pagina_actual - 1) * $registros_por_pagina;

                                // Consulta SQL con límite y offset
                                $consulta = "SELECT bd_mascota.id_mascota, 
                                                        bd_mascota.nombre_mascota, 
                                                        bd_mascota.fecha_nacimiento, 
                                                        bd_mascota.sexo, 
                                                        bd_mascota.largo_pelo, 
                                                        bd_mascota.tamano, 
                                                        bd_mascota.esterilizado, 
                                                        bd_mascota.peso, 
                                                        bd_especie.nombre_especie AS nombre_especie, 
                                                        bd_mascota.descripcion, 
                                                        bd_mascota.foto_mascota, 
                                                        bd_mascota.estado_adopcion, 
                                                        bd_mascota.estado_medico 
                                                 FROM bd_mascota 
                                                 INNER JOIN bd_especie ON bd_mascota.id_especie = bd_especie.id_especie
                                                  LIMIT $offset, $registros_por_pagina";

                                $resultado = mysqli_query($conn, $consulta);

                                // Obtén el número total de registros
                                $resultado_total = mysqli_query($conn, "SELECT COUNT(*) AS total FROM bd_mascota");
                                $row = mysqli_fetch_assoc($resultado_total);
                                $total_registros = $row['total'];

                                // Calcula el número total de páginas
                                $total_paginas = ceil($total_registros / $registros_por_pagina);
                                ?>

                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Especie</th>
<!--                                            <th>URL Imagen</th>-->
                                            <th>Nombre</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Sexo</th>
                                            <th>Peso (KG)</th>
                                            <th>Tamaño</th>
                                            <th>Esterili...</th>
                                            <th>Largo de pelo</th>
                                            <th>Estado médico</th>
<!--                                            <th>Descripción</th>-->
                                            <th>Estado adopción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody id="employeeTable">
                                        <?php
                                        while ($fila = mysqli_fetch_array($resultado)) {
                                            ?>
                                            <tr>
                                                <td><?php echo truncateString($fila['id_mascota'], 8); ?></td>
                                                <td><?php echo truncateString($fila['nombre_especie'], 8); ?></td>
    <!--                                                <td><?php // echo truncateString($fila['foto_mascota'], 8);  ?></td>-->
                                                <td><?php echo truncateString($fila['nombre_mascota'], 8); ?></td>
                                                <td><?php echo truncateString($fila['fecha_nacimiento'], 11); ?></td>
                                                <td><?php echo truncateString($fila['sexo'], 8); ?></td>
                                                <td><?php echo truncateString($fila['peso'], 8); ?></td>
                                                <td><?php echo truncateString($fila['tamano'], 8); ?></td>
                                                <td><?php echo $fila['esterilizado'] == 1 ? 'Si' : 'No'; ?></td>
                                                <td><?php echo truncateString($fila['largo_pelo'], 8); ?></td>
                                                <td><?php echo truncateString($fila['estado_medico'], 6); ?></td>
    <!--                                                <td><?php // echo truncateString($fila['descripcion'], 8);  ?></td>-->
                                                <td><?php echo $fila['estado_adopcion'] == 0 ? 'Libre' : 'Adoptado'; ?></td>
                                                <td>
                                                    <?php
                                                    if ($_SESSION['id_rol'] != 1) {
                                                        ?>
                                                        <a class="edit" href="admin_mascotas/editar_mascota.php?id=<?php echo $fila['id_mascota']; ?>" data-toggle="tooltip" title="Edit">
                                                            <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                                        </a>
                                                        <a class="delete" href="admin_mascotas/eliminar_mascota.php?id=<?php echo $fila['id_mascota']; ?>" data-toggle="tooltip" title="Delete">
                                                            <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                                        </a>
                                                        <?php
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php

                                // Función para truncar una cadena a una longitud específica
                                function truncateString($string, $length) {
                                    if (strlen($string) > $length) {
                                        $string = substr($string, 0, $length) . '...';
                                    }
                                    return $string;
                                }
                                ?>
                                <!-- Paginación -->
                                <div class="clearfix">
                                    <div class="hint-text">Mostrando <b><?php echo min(mysqli_num_rows($resultado), $registros_por_pagina); ?></b> de <b><?php echo $total_registros; ?></b></div>
                                    <ul class="pagination">
                                        <?php if ($pagina_actual > 1): ?>
                                            <li class="page-item"><a href="?pagina=<?php echo $pagina_actual - 1; ?>" class="page-link">Atrás</a></li>
                                        <?php else: ?>
                                            <li class="page-item disabled"><a href="#" class="page-link">Atrás</a></li>
                                        <?php endif; ?>

                                        <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                                            <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>"><a href="?pagina=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a></li>
                                        <?php endfor; ?>

                                        <?php if ($pagina_actual < $total_paginas): ?>
                                            <li class="page-item"><a href="?pagina=<?php echo $pagina_actual + 1; ?>" class="page-link">Siguiente</a></li>
                                        <?php else: ?>
                                            <li class="page-item disabled"><a href="#" class="page-link">Siguiente</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>                            
                            </div>
                        </div>
                        <!-- Modal de Crear MASCOTA -->
                        <div class="modal fade" id="addEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addEmployeeModalLabel">Crear Publicación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="agregarMascotaForm" action="admin_mascotas/funciones.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="id_especie" class="form-label">Especie:</label>
                                                <select id="id_especie" name="id_especie" class="form-control" required>
                                                    <option value="1">Gato</option>
                                                    <option value="2">Perro</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="foto_mascota" class="form-label">URL de la imagen:</label>
                                                <input type="text" id="foto_mascota" name="foto_mascota" class="form-control" required oninput="loadImagePreview()">
                                                <div class="text-center mt-3">
                                                    <img id="imagePreview" src="" alt="Vista previa de la imagen" style="width: 340px; display: none;">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sexo" class="form-label">Sexo:</label>
                                                <select id="sexo" name="sexo" class="form-control" required>
                                                    <option value="Macho">Macho</option>
                                                    <option value="Hembra">Hembra</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="nombre_mascota" class="form-label">Nombre:</label>
                                                <input type="text" id="nombre_mascota" name="nombre_mascota" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="largo_pelo" class="form-label">Largo de pelo:</label>
                                                <select id="largo_pelo" name="largo_pelo" class="form-control" required>
                                                    <option value="Corto">Corto</option>
                                                    <option value="Mediano">Mediano</option>
                                                    <option value="Largo">Largo</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tamano" class="form-label">Tamaño:</label>
                                                <select id="tamano" name="tamano" class="form-control" required>
                                                    <option value="Pequeño">Pequeño</option>
                                                    <option value="Mediano">Mediano</option>
                                                    <option value="Grande">Grande</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="esterilizado" class="form-label">Esterilizado:</label>
                                                <select id="esterilizado" name="esterilizado" class="form-control" required>
                                                    <option value="1">Si</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="peso" class="form-label">Peso (en KG):</label>
                                                <input type="number" id="peso" name="peso" class="form-control" step="0.01" required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="descripcion" class="form-label">Descripción:</label>
                                                <textarea id="descripcion" name="descripcion" class="form-control"></textarea>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="estado_medico" class="form-label">Estado médico:</label>
                                                <textarea id="estado_medico" name="descripcion" class="form-control"></textarea>
                                            </div>
                                            
                                            <!-- Otros campos -->
                                            <input type="hidden" name="action" value="crear_registro">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="submit" onclick="handleSubmit()" class="btn btn-success">Agregar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!----add-modal end--------->

                        <!----edit-modal start--------->

                        <!----edit-modal end--------->

                        <!----delete-modal start--------->

                        <!----delete-modal end--------->   
                    </div>
                </div>
                <!------main-content-end-----------> 
                <!----footer-design------------->
                 <!----<footer class="footer">
                    <div class="container-fluid">
                        <div class="footer-in">
                            <p class="mb-0">Copyright © 2024 Patitas SOS PIURA | Todos los derechos reservados</p>
                        </div>
                    </div>
                </footer> ------------->
            </div>
        </div>
        <!-------complete html----------->
        <!-- Optional JavaScript -->
<!--        <script>
            function handleSubmit() {
                alert("La mascota ha sido creada con éxito.");
                window.location.href = "../../dashboard/indexMascotas.php";
            }
        </script>-->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="sources/js/jquery-3.3.1.slim.min.js"></script>
        <script src="sources/js/popper.min.js"></script>
        <script src="sources/js/bootstrap.min.js"></script>
        <script src="sources/js/jquery-3.3.1.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', (event) => {
                const today = new Date().toISOString().split('T')[0];
                document.getElementById('fecha_publicacion').value = today;
            });
        </script>
        <script type="text/javascript">
            function loadImagePreview() {
                var imageUrl = document.getElementById('foto_mascota').value;
                var imagePreview = document.getElementById('imagePreview');

                if (imageUrl) {
                    imagePreview.src = imageUrl;
                    imagePreview.style.display = 'block';
                } else {
                    imagePreview.style.display = 'none';
                }
            }
        </script>
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

    </body>
</html>

