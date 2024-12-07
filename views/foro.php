<?php
include '../config/Database.php';
global $conn;
session_start(); // Crear instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database-> getConnection(); // Verifica si el usuario ha iniciado sesión 
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
	<meta name="author" content="">
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
			<a class="navbar-brand" href="index.html">Brainbook<span>.</span></a>

			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
				aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarsFurni">
				<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
					<li>
						<a class="nav-link" href="index.php">Inicio</a>
					</li>
					
					<li class="nav-item active"> <a class="nav-link" href="foro.php">Foro</a></li>
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
		</div>

	</nav>
	<!-- Fin de navegación -->

	<!-- Foro titulo -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1></h1>
						<h1>Foro General</h1>
						<p class="mb-4">Sé libre de preguntar.</p>
						<p class="mb-4">"La curiosidad es el primer paso hacia el conocimiento; aquellos que preguntan
							son los que realmente quieren aprender."</p>
						<p><a href="" class="btn btn-secondary me-2">Pregunta</a><a href="#"
								class="btn btn-white-outline">Responde</a></p>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="hero-img-wrap">
						<img src="../public/images/foro.png" class="img-fluid">
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Fin de la sección principal -->



	<!-- Inicio del foro -->
	<div class="qa-section">
		<h2>Escribe tu pregunta</h2>
		<form id="question-form">
			<textarea id="user-question" rows="4" placeholder="Escribe tu pregunta aquí..." required></textarea>
			<button type="submit">Enviar Pregunta</button>
		</form>
		<div class="question">
			<h3>¿Cómo puedo mejorar mi sitio web?</h3>
			<p><strong>Respuesta:</strong> Puedes mejorar tu sitio web optimizando la velocidad de carga, utilizando un
				diseño responsivo y asegurándote de que el contenido sea relevante y de calidad.</p>
			<button type="submit">Responder</button>
		</div>

		<div class="question">
			<h3>¿Qué es SEO?</h3>
			<p><strong>Respuesta:</strong> SEO (Search Engine Optimization) es el proceso de optimizar tu sitio web para
				mejorar su visibilidad en los motores de búsqueda.</p>
			<button type="submit">Responder</button>
		</div>

		<div class="question">
			<h3>¿Cómo puedo aumentar el tráfico a mi sitio web?</h3>
			<p><strong>Respuesta:</strong> Puedes aumentar el tráfico a tu sitio web mediante la creación de contenido
				de calidad, el uso de redes sociales y la implementación de estrategias de marketing digital.</p>
			<button type="submit">Responder</button>
		</div>
	</div>
	<!-- Fin del foro -->




	<script src="../public/js/bootstrap.bundle.min.js"></script>
	<script src="../public/js/tiny-slider.js"></script>
	<script src="../public/js/custom.js"></script>

	<!-- Bootstrap JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>