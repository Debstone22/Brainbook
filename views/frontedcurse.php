<?php include '../config/Database.php';
global $conn;
session_start(); // Crear instancia de la clase Database y obtener la conexión 
$database = new Database();
$conn = $database->getConnection(); // Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
	$nombre_usuario = $_SESSION['usuario'];
	$id_usuario = $_SESSION['id_usuario'];
	$rol_usuario = $_SESSION['rol']; // Asumiendo que el rol del usuario también se almacena en la sesión // Verifica si se ha pasado un id_curso 
	if (isset($_GET['id_curso'])) {
		$id_curso = $_GET['id_curso']; // Consulta para obtener la información del curso 
		$query_curso = "SELECT * FROM cursos WHERE id_curso = :id_curso";
		$stmt_curso = $conn->prepare($query_curso);
		$stmt_curso->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
		
		$stmt_curso->execute();
		$curso = $stmt_curso->fetch(PDO::FETCH_ASSOC);

		// Consulta para obtener las semanas del curso 
		$query_semanas = "SELECT cs.*, s.numero_semana, p.id_estado 
                  FROM curso_semana cs 
                  JOIN semana s ON cs.id_semana = s.id_semana 
                  LEFT JOIN progreso p 
                  ON p.numero_semana = s.numero_semana 
                     AND p.id_usuario = :id_usuario 
                     AND p.id_curso = :id_curso 
                  WHERE cs.id_curso = :id_curso 
                  ORDER BY s.numero_semana";

		//consulta para obtener el resumen del usuario
		


		$stmt_semanas = $conn->prepare($query_semanas);
		$stmt_semanas->bindParam(':id_curso', $id_curso, PDO::PARAM_INT);
		$stmt_semanas->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
		$stmt_semanas->execute();
		$semanas = $stmt_semanas->fetchAll(PDO::FETCH_ASSOC);
	} else { // Redirigir si no se pasa un id_curso
		header("Location: index.php");
		exit();
	}
} else { // Redirigir a la página de login si el usuario no ha iniciado sesión 
	header("Location: ../views/login.php");
	exit();
}

?>


<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Untree.co">

	<link rel="shortcut icon" href="../public/images/Logo.png">


	<meta name="description" content="" />
	<meta name="keywords" content="bootstrap, bootstrap4" />

	<!-- Bootstrap CSS -->

	<link href="../public/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
	<link href="../public/css/tiny-slider.css" rel="stylesheet">
	<link href="../public/css/style.css" rel="stylesheet">
	<link rel="stylesheet" href="../public/css/background.css">
	<title>Brainbook :: <?php echo htmlspecialchars($curso['nombre_curso']); ?></title>

</head>

<style>
	.tituloSemana {
		font-family: sans-serif;
		padding-top: 16px;
		text-align: center;
	}

	.tituloCurso {
		font-family: sans-serif;
		padding-top: 32px;
	}

	.dropdown-menu {
		background-color: #1DB954;
		border: none;
	}

	.dropdown-item {
		color: #fff;
	}

	.dropdown-item:hover {
		background-color: #17a34a;
	}
</style>

<style>
	.tituloSemana {
		font-family: sans-serif;
		padding-top: 16px;
		text-align: center;
	}

	.tituloCurso {
		font-family: sans-serif;
		padding-top: 32px;
	}

	.dropdown-menu {
		background-color: #1DB954;
		border: none;
	}

	.dropdown-item {
		color: #fff;
	}

	.dropdown-item:hover {
		background-color: #17a34a;
	}
</style>

<body>

	<!-- Inicio de navegación -->
	<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

		<div class="container">
			<a class="navbar-brand" href="index.php">Brainbook<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li>
					<li>
						<a class="nav-link" href="index.php">Inicio</a>
					</li>
					<li><a class="nav-link" href="foro.php">Foro</a></li>
					<li><a class="nav-link" href="ayuda.php">Ayuda</a></li>
				</ul>

				<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
					<li class="nav-item">
						<?php if (isset($_SESSION['usuario'])): ?>
							<div class="nav-item dropdown">
								<a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown"
									role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?php echo htmlspecialchars($nombre_usuario); ?>
									<img src="../public/images/user.svg" alt="User Icon" class="rounded-circle ms-2"
										width="30">
								</a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown"> <a
										class="dropdown-item" href="https://portal.utp.edu.pe/inicio">Portal</a>
									<?php if ($rol_usuario == 3): ?>
										<a class="dropdown-item" href="../dashboard/indexUsuarios.php">Administrar</a>
									<?php endif; ?>
									<div class="dropdown-divider"></div> <a class="dropdown-item" href="logout.php">Cerrar
										Sesión</a>
								</div>
							</div>
						<?php else: ?>
							<a class="nav-link" href="login.php">
								<img src="../public/images/user.svg" alt="User Icon" class="rounded-circle" width="30">
							</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- Fin de navegación -->

	<!-- Semanas -->

	<h2 class="tituloCurso"><?php echo htmlspecialchars($curso['nombre_curso']); ?></h2>
	<h4 class="tituloSemana" id="tituloSemana"></h4>

	
	<!-- Boton de Check -->

	<!-- Fin de Boton-->

	<div class="container">
		<div class="row">
		 <div class="wrapper col-7">
			<!-- Semanas -->
			<div class="container my-4">
				<div class="dropdown text-center">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
						data-bs-toggle="dropdown" aria-expanded="false">
						Selecciona una Semana
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<li>
							<a class="dropdown-item" href="#" onclick="cambiarTitulo('Silabo', '', '')">Silabo</a>
						</li>
						<?php foreach ($semanas as $semana): ?>
							<li>
								<a class="dropdown-item" href="#"
									onclick="cambiarTitulo('Semana <?php echo $semana['numero_semana']; ?> - <?php echo htmlspecialchars($semana['titulo']); ?>', '<?php echo htmlspecialchars($semana['pdf_url']); ?>', '<?php echo $semana['id_semana']; ?>')">
									Semana <?php echo $semana['numero_semana']; ?> -
									<?php echo htmlspecialchars($semana['titulo']); ?>
								</a>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<div class="container my-4">
			<div class="dropdown text-center">
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalSemanas">
			Itinerario de Semanas del Curso
			</button>

			<!-- Modal -->
			<div class="modal fade" id="modalSemanas" tabindex="-1" aria-labelledby="modalSemanasLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="modalSemanasLabel">Semanas del Curso</h5>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<!-- Contenido del modal: Tabla -->
							<div class="container4">
								<table class="table table-striped">
									<thead>
										<tr>
											<th>Titulo</th>
											<th>Semana</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($semanas as $semana): ?>
											<tr>
												<td>
													Semana <?php echo $semana['numero_semana']; ?> - <?php echo $semana['titulo']; ?>
												</td>
												<td>
													<select class="form-control estado-combo" data-id-usuario="<?php echo $id_usuario; ?>"
															data-id-curso="<?php echo $id_curso; ?>"
															data-numero-semana="<?php echo $semana['numero_semana']; ?>">
														<option value="1" <?php echo isset($semana['id_estado']) && $semana['id_estado'] == 1 ? 'selected' : ''; ?>>Realizado</option>
														<option value="0" <?php echo isset($semana['id_estado']) && $semana['id_estado'] == 0 ? 'selected' : ''; ?>>Pendiente</option>
													</select>
												</td>
											</tr>
										<?php endforeach; ?>
									</tbody>

								</table>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
							
						</div>
					</div>
				</div>
				</div>
			</div>	
		</div>
			
		</div>
			
		</div>
	</div>

	<!-- Visor de PDF -->
	<div class="container pdf-viewer">
	<!-- Visor de PDF -->
	<div class="container pdf-viewer">
		<div class="row">
			<div class="wrapper col-xl-7">
				<embed id="pdfViewer" src="" type="application/pdf" width="500px" height="720px" />
			</div>
			<div class="col">
				<h2>¡Escribe aquí tu resumen!</h2>
				<div class="container3">
					<div class="typewriter">
						<div class="slide"><i></i></div>
						<div class="paper"></div>
						<div class="keyboard"></div>
					</div>
				</div>
				<form method="post" action="guardar_resumen.php">
					<textarea name="contenido" placeholder="Escribe tu resumen aquí..." rows="5"></textarea>
					<input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
					<input type="hidden" name="id_curso" value="<?php echo htmlspecialchars($id_curso); ?>">
					<input type="hidden" name="id_semana" id="idSemana">
					<button type="submit">Actualizar</button>
				</form>
			</div>
		</div>
	</div>









	<script src="../public/js/bootstrap.bundle.min.js"></script>
	<script src="../public/js/tiny-slider.js"></script>
	<script src="../public/js/custom.js"></script>
	<script src="../public/js/estado.js"></script>

	<!-- Bootstrap JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<script>
		const semanas = <?php echo json_encode($semanas); ?>;
		let semanaActual = 0;

		function cambiarTitulo(titulo, pdfUrl, idSemana) {
			const nombreCurso = "<?php echo htmlspecialchars($curso['nombre_curso']); ?>";
			const rutaCompleta = `docs/${nombreCurso}/${pdfUrl}`;
			document.getElementById('tituloSemana').innerText = titulo;
			document.getElementById('pdfViewer').src = rutaCompleta;
			document.getElementById('idSemana').value = idSemana;
			console.log(`Ruta PDF: ${rutaCompleta}, idSemana: ${idSemana}`);

			// Recuperar y mostrar el contenido del resumen para la semana seleccionada
			fetch(`obtener_resumen.php?id_usuario=${<?php echo $id_usuario; ?>}&id_curso=${<?php echo $id_curso; ?>}&id_semana=${idSemana}`)
				.then(response => response.text())
				.then(contenido => {
					// Usar trim() para eliminar espacios en blanco al inicio y al final
					document.querySelector('textarea[name="contenido"]').value = contenido.trim();
				});
		}

		function cambiarSemana(direccion) {
			semanaActual += direccion;

			// Asegúrate de que la semana actual esté dentro de los límites
			if (semanaActual < 0) {
				semanaActual = 0;
			} else if (semanaActual >= semanas.length) {
				semanaActual = semanas.length - 1;
			}

			const semana = semanas[semanaActual];
			const tituloSemana = `Semana ${semana.numero_semana} - ${semana.titulo}`;
			cambiarTitulo(tituloSemana, semana.pdf_url, semana.id_semana);
		}

		// Inicializar con la primera semana al cargar la página
		document.addEventListener('DOMContentLoaded', (event) => {
			if (semanas.length > 0) {
				const semana = semanas[semanaActual];
				const tituloSemana = `Semana ${semana.numero_semana} - ${semana.titulo}`;
				cambiarTitulo(tituloSemana, semana.pdf_url, semana.id_semana);
			}
		});
	</script>





</body>

</html>