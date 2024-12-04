<?php
include '../config/Database.php';
session_start(); // Crear instancia de la clase Database y obtener la conexión

$database = new Database();
$conn = $database->getConnection();

// Verifica si el usuario ha iniciado sesión 
if (isset($_SESSION['usuario'])) {
	$nombre_usuario = $_SESSION['usuario'];
	$rol_usuario = $_SESSION['rol'];
	$id_usuario = $_SESSION['id_usuario']; // Asumiendo que el ID del usuario está almacenado en la sesión

	// Consulta para obtener los cursos del usuario
	$query = "SELECT c.nombre_curso, c.descripcion, c.version, c.imagen 
              FROM curso_estudiante ce
              JOIN cursos c ON ce.id_curso = c.id_curso
              WHERE ce.id_usuario = :id_usuario";
	$stmt = $conn->prepare($query);
	$stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
	$stmt->execute();
	$cursos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
	// Si el usuario no ha iniciado sesión, redirige a la página de login 
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
					<li>
						<a class="nav-link" href="index.php">Inicio</a>
					</li>
					<li class="nav-item active">
						<a class="nav-link" href="cursos.php">Cursos</a>
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
		</div>

	</nav>
	<!-- Fin de navegación -->

	<!-- Start Hero Section -->
	<div class="hero">
		<div class="container">
			<div class="row justify-content-between">
				<div class="col-lg-5">
					<div class="intro-excerpt">
						<h1></h1>
						<h1>Cursos pendientes</h1>
					</div>
				</div>
				<div class="col-lg-7">

				</div>
			</div>
		</div>
	</div>
	<!-- End Hero Section -->

	<div class="menu">

		<!-- Combo Box para filtrar preguntas -->
		<label for="filter">Filtrar por categoría:</label>
		<select id="filter" onchange="filterQuestions()">

			<option value="Mas recientes">Mas recientes</option>
			<option value="Menos vistos">Menos vistos</option>
			<option value="Trabajos pendientes">Trabajos pendientes</option>
			<option value="Todo">Todo</option>
		</select>
	</div>
	<script src="../public/js/menu.js"></script>

	<div class="untree_co-section product-section before-footer-section">

		<div class="container">
			<div class="row">

				<!-- Start Column 1 -->
				<?php foreach ($cursos as $curso): ?>
					<div class="col-6 col-md-2 col-lg-2 mb-3">
						<a class="product-item" href="#">
							<img src="<?php echo htmlspecialchars('../dashboard/' . $curso['imagen']); ?>"
								class="img-fluid product-thumbnail">
							<p class="title-curse"><?php echo htmlspecialchars($curso['nombre_curso']); ?></p>
							<h6>Francisco Donayre</h6> <!-- Mantener el nombre del profesor tal cual -->
							<strong class="product-price">Semana 7</strong> <!-- Mantener la semana tal cual -->
							<span class="icon-cross">
								<img src="../public/images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
				<?php endforeach; ?>


				<!-- End Column 1 -->

				<!-- Start Column 2 -->



			</div>
		</div>
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