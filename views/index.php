<?php include '../config/Database.php';
session_start(); // Crear instancia de la clase Database y obtener la conexión 
$database = new Database();
$conn = $database->getConnection(); // Verifica si el usuario ha iniciado sesión
if (isset($_SESSION['usuario'])) {
	$nombre_usuario = $_SESSION['usuario'];
	$rol_usuario = $_SESSION['rol'];
	$id_usuario = $_SESSION['id_usuario']; // Consulta para obtener los cursos del usuario y el nombre del profesor 
	$query = "SELECT c.id_curso, c.nombre_curso, c.descripcion, c.version, c.imagen, p.nombre AS profesor_nombre, p.apellido AS profesor_apellido FROM curso_estudiante ce JOIN cursos c ON ce.id_curso = c.id_curso JOIN curso_profesor cp ON cp.id_curso = c.id_curso JOIN profesor p ON cp.id_profesor = p.id_profesor WHERE ce.id_usuario = :id_usuario";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
	$stmt->execute();
	$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
	// Si el usuario no ha iniciado sesión, redirige a la página de login 
	header("Location: ../views/login.php");
	exit();
} ?>

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
	<title>Brainbook</title>
	<script src="../public/js/saludo.js" defer></script>
</head>

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
					<li class="nav-item active">
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
										class="dropdown-item" href="profile.php">Perfil</a>
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
	</nav>

	<!-- Fin de navegación -->

	<!-- End Header/Navigation -->

	<!-- Primera sección -->
	<div class="hero">
		<div class="container">
			<div class="row">
				<div class="col">
				<div class="intro-excerpt">
					<h1 id="greeting"><span class="d-block"></span></h1>
					<h1>¡Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h1>
					<p class="mb-4">Es tiempo de adquirir más conocimientos </p>
					<p><a href="https://tubiblioteca.utp.edu.pe/" class="btn btn-secondary me-2"
							target="_blank">Biblioteca</a>

						<a href="https://sso.utp.edu.pe/auth/realms/Xpedition/protocol/openid-connect/auth?client_id=pao-web&redirect_uri=https%3A%2F%2Fclass.utp.edu.pe%2F&state=fefe7e3e-28bf-4744-8151-f536faa82aac&response_mode=fragment&response_type=code&scope=openid&nonce=8bbed0d1-bdca-49ae-8463-c50ecdfd2f79"
							class="btn btn-white-outline" target="_blank">Portal</a>
					</p>
					
				</div>
				</div>

				<div class="col">
						<div class="container">
								<h1></h1>
								<h1 id="message">¡Comienza con el pie derecho!</h1>
										<div class="progress-bar-container">
											<div class="progress-bar" id="progress-bar"></div>
										</div>
								<button id="click-btn">Haz clic aquí</button>
								<p id="click-count">Clics: 0</p>
						</div>
											
					<script src="../public/js/progressbar.js"></script>
				</div>

			</div>
		</div>
		<iframe 
			src="https://calendar.google.com/calendar/embed?src=4c975285029ae97c311c58e477d7b293974f101c60d0735c01bc779ca6a74072%40group.calendar.google.com&ctz=America%2FLima" 
			style="border: 0; width: 100%; height: 300px;" 
			frameborder="0" 
			scrolling="no">
		</iframe>

	</div>
	<!-- Fin de la sección -->

	<!-- Ultimo vistazo de los cursos -->

	<div class="product-section">
		<div class="container">
			<p class="h2-title"> Continuar viendo contenido </p>
			<div class="row">
				<!-- Curso reciente -->

				<?php foreach ($cursos as $curso): ?>
					<div class="col-6 col-md-2 col-lg-2 mb-3">
						<a class="product-item"
							href="frontedcurse.php?id_curso=<?php echo htmlspecialchars($curso['id_curso']); ?>">
							<img src="<?php echo htmlspecialchars('../dashboard/' . $curso['imagen']); ?>"
								class="img-fluid product-thumbnail">
							<p class="title-curse"><?php echo htmlspecialchars($curso['nombre_curso']); ?></p>
							<h6><?php echo htmlspecialchars($curso['profesor_nombre'] . ' ' . $curso['profesor_apellido']); ?>
							</h6>
							<strong class="product-price">Semana 7</strong>
							<span class="icon-cross">
								<img src="../public/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
				<?php endforeach; ?>

				<!-- fin columna 2 -->
			
			</div>
		</div>
	</div>
	<!-- End Product Section -->
	<script src="../public/js/bootstrap.bundle.min.js"></script>
	<script src="../public/js/tiny-slider.js"></script>
	<script src="../public/js/custom.js"></script>
	<script>


	</script>

	<!-- Bootstrap JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>