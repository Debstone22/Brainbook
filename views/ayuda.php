<?php
include '../config/Database.php';
global $conn;
session_start(); // Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->getConnection(); // Verifica si el usuario ha iniciado sesión 
if (isset($_SESSION['usuario'])) {
	$nombre_usuario = $_SESSION['usuario'];
	$rol_usuario = $_SESSION['rol']; // Asumiendo que el rol del usuario también se almacena en la sesión // Verifica si el usuario tiene el rol adecuado (rol 3 en este caso)
} else { // Si el usuario no ha iniciado sesión, redirige a la página de login 
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
	<title>Brainbook</title>

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
					
					<li><a class="nav-link" href="index.php">Inicio</a></li>
					<li><a class="nav-link" href="foro.php">Foro</a></li>
					<li class="nav-item active" ><a class="nav-link" href="ayuda.php">Ayuda</a></li>
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

	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col">
					<div class="intro-excerpt">
						<h1></h1>
						<h1>Sección de Ayuda</h1>
						<p class="mb-4">Podrás visualizar contenidos que pueden ser de utilidad para entender mejor el
							aprendizaje virtual. </p>
						<p><a href="https://api.whatsapp.com/send?phone=51960252970&text=Hola,%20tengo%20una%20consulta"
								class="btn btn-secondary me-2" target="_blank">SAE</a><a
								href="https://www.youtube.com/watch?v=sjOZK783B1g" class="btn btn-white-outline"
								target="_blank">Demo</a></p>
					</div>
				</div>
				<div class="col">
					<div class="hero-img-wrap">
						<img src="../public/images/foro.png" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->


	<!-- Tarjetas de ayuda -->
	<div class="card">
		<h2 class="card-title">¿Cómo funciona Brainbook?</h2>
		<p class="card-description">Conoce Brainbook y no te pierdas del contenido más importante.</p>
		<a href="#" class="card-link" target="_blank">Leer más</a>
	</div>
	<div class="card">
		<h2 class="card-title">Manual del estudiante UTP</h2>
		<p class="card-description">Conoce el reglamento de estudios.</p>
		<a href="https://utpedupe-my.sharepoint.com/personal/contactoclass_utp_edu_pe/_layouts/15/onedrive.aspx?id=%2Fpersonal%2Fcontactoclass%5Futp%5Fedu%5Fpe%2FDocuments%2FUTP%2Bclass%20%2D%20Manuales%2FManuales%20Estudiante%2FManuales%20UTP%2Bclass%5Festudiante%2Epdf&parent=%2Fpersonal%2Fcontactoclass%5Futp%5Fedu%5Fpe%2FDocuments%2FUTP%2Bclass%20%2D%20Manuales%2FManuales%20Estudiante&ga=1"
			class="card-link" target="_blank">Leer más</a>
	</div>
	<div class="card">
		<h2 class="card-title">Video tutoriales que te ayudarán</h2>
		<p class="card-description">Mira estos videos sobre dudas frecuentes sobre el manejo de la plataforma de
			estudios Brainbook.</p>
		<a href="#" class="card-link" target="_blank">Leer más</a>
	</div>







	<script src="../public/js/bootstrap.bundle.min.js"></script>
	<script src="../public/js/tiny-slider.js"></script>
	<script src="../public/js/custom.js"></script>

	<!-- Bootstrap JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>