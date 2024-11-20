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
} // Aquí puedes colocar el contenido del dashboard echo "<h1>Bienvenido al Admin Dashboard, $nombre_usuario</h1>";el contenido del dashboard echo "echo "<h1>Bienvenido al Admin Dashboard, .$nombre_usuario .</h1>";"; 

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
					<li><a class="nav-link" href="cursos.php">Cursos</a></li>
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
									<div class="dropdown-divider"></div> <a class="dropdown-item" href="logout.php">Cerrar Sesión</a>
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
			<div class="row justify-content-between">
				<!-- <div class="col-lg-3"> -->
				<div class="intro-excerpt">
					<h1 id="greeting"><span clsas="d-block"></span></h1>
					<h1>Bienvenido, <?php echo htmlspecialchars($nombre_usuario); ?>!</h1>
					<p class="mb-4">Es tiempo de adquirir más conocimientos </p>
					<p><a href="https://tubiblioteca.utp.edu.pe/" class="btn btn-secondary me-2"
							target="_blank">Biblioteca</a>

						<a href="https://sso.utp.edu.pe/auth/realms/Xpedition/protocol/openid-connect/auth?client_id=pao-web&redirect_uri=https%3A%2F%2Fclass.utp.edu.pe%2F&state=fefe7e3e-28bf-4744-8151-f536faa82aac&response_mode=fragment&response_type=code&scope=openid&nonce=8bbed0d1-bdca-49ae-8463-c50ecdfd2f79"
							class="btn btn-white-outline" target="_blank">Portal</a>
					</p>
					<a href="logout.php" class="btn btn-danger">Cerrar sesión</a>
				</div>
				<!-- </div> -->

			</div>
		</div>
	</div>
	<!-- Fin de la sección -->

	<!-- Ultimo vistazo de los cursos -->

	<div class="product-section">
		<div class="container">
			<p class="h2-title"> Continuar viendo contenido </p>
			<div class="row">

				<!-- Primera columna -->
				<div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">

				</div>
				<!-- Fin de la columna 1 -->

				<!-- columna 2 -->
				<div class="col-6 col-md-2 col-lg-2 mb-3">
					<a class="product-item" href="#">
						<img src="../public/images/analisis.png" class="img-fluid product-thumbnail">
						<p class="title-curse">Analisis y Diseño</p>

						<strong class="product-price">Semana 7</strong>

						<span class="icon-cross">
							<img src="../public/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- fin columna 2 -->

				<!--columna 3 -->
				<div class="col-6 col-md-2 col-lg-2 mb-3">
					<a class="product-item" href="#">
						<img src="../public/images/ingles.png" class="img-fluid product-thumbnail">
						<p class="title-curse">Inglés IV</p>

						<strong class="product-price">Semana 7</strong>

						<span class="icon-cross">
							<img src="../public/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- fin columna 3 -->

				<!-- columna 4 -->
				<div class="col-6 col-md-2 col-lg-2 mb-3">
					<a class="product-item" href="#">
						<img src="../public/images/analisis.png" class="img-fluid product-thumbnail">
						<p class="title-curse">Analisis y Diseño</p>

						<strong class="product-price">Semana 7</strong>

						<span class="icon-cross">
							<img src="../public/images/cross.svg" class="img-fluid">
						</span>
					</a>
				</div>
				<!-- fin columna 4 -->

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