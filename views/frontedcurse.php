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
					<li >
						<a class="nav-link" href="index.php">Inicio</a>
					</li>
					<li class="nav-item active"><a class="nav-link" href="cursos.php">Cursos</a></li>
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

	<!-- Semanas -->
	<div class="container-fluid bg-white">

		<ul class="nav justify-content-center">
			<li class="nav-item">
				<a class="nav-link" href="#">Silabo</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 1</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 2</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 3</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 4</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 5</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 6</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 7</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 8</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 9</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 10</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 11</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 12</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 13</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 14</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 15</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 16</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 17</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Semana 18</a>
			</li>

		</ul>

	</div>
	<!-- Fin de Semanas -->
	<h2>¡S4- EtherChannel!</h2>

	<!-- Boton de Check -->

	<!-- Fin de Boton-->

	<div class="container">
		<div class="row">
			<div class="wrapper col-7">


				<button>
					<span class="span-mother">
						<span>A</span>
						<span>n</span>
						<span>t</span>
						<span>e</span>
						<span>r</span>
						<span>i</span>
						<span>o</span>
						<span>r</span>
					</span>
					<span class="span-mother2">
						<span>A</span>
						<span>n</span>
						<span>t</span>
						<span>e</span>
						<span>r</span>
						<span>i</span>
						<span>o</span>
						<span>r</span>
					</span>
				</button>
				<button>
					<span class="span-mother">
						<span>S</span>
						<span>i</span>
						<span>g</span>
						<span>u</span>
						<span>i</span>
						<span>e</span>
						<span>n</span>
						<span>t</span>
						<span>e</span>
					</span>
					<span class="span-mother2">
						<span>S</span>
						<span>i</span>
						<span>g</span>
						<span>u</span>
						<span>i</span>
						<span>e</span>
						<span>n</span>
						<span>t</span>
						<span>e</span>
					</span>
				</button>
			</div>
			<div class="col">
				<label class="switch">
					<input type="checkbox">
					<span class="slider"></span>
				</label>
				<span class="switch-title">¿Lo completaste? Marca la casilla</span>

			</div>
		</div>
	</div>

	<div class="container">
		<div class="row">
			<div class="wrapper col-7">
				<embed src="docs/S04_S1.pdf" type="application/pdf" width="720px" height="720px" />
			</div>



			<div class="col">


				</label>
				<h2>¡Escribe aquí tu resumen!</h2>
				<div class="container3">
					<div class="typewriter">
						<div class="slide"><i></i></div>
						<div class="paper"></div>
						<div class="keyboard"></div>
					</div>
				</div>
				<textarea placeholder="Escribe tu resumen aquí..." rows="5"></textarea>
				<button type="submit">Enviar</button>
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