
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  
  <link rel="shortcut icon" href="../images/Logo.png">


  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- Bootstrap CSS -->

		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="../css/tiny-slider.css" rel="stylesheet">
		<link href="../css/style.css" rel="stylesheet">
		<title>Brainbook</title>
		<script src="../js/saludo.js" defer></script>

	</head>

	<body>

		<!-- Inicio de navegación -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="index.html">Brainbook<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
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

						
						<li><a class="nav-link" herf="#"><image src="../images/campana.png" width="18" height="20"></a> </li>
						<li><a class="nav-link" href="login.php"><img src="../images/user.svg"></a></li>	
					
					</ul>
				</div>
			</div>
				
		</nav>

		<!-- Fin de navegación -->

		<!-- End Header/Navigation -->
		 
		 <!-- Modal de Inicio de Sesión -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title" id="loginModalLabel">Iniciar Sesión</h5>
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
		</div>
		<div class="modal-body">
		  <form>
			<div class="mb-3">
			  <label for="email" class="form-label">Correo electrónico</label>
			  <input type="text" class="form-control" id="email" placeholder="nombre@ejemplo.com" required>
			</div>
			<div class="mb-3">
			  <label for="password" class="form-label">Contraseña</label>
			  <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
			</div>
			<button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
		  </form>
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
		</div>
	  </div>
	</div>
  </div>

  

		


		<!-- Primera sección -->
			<div class="hero">
				<div class="container">
					<div class="row justify-content-between">
						<!-- <div class="col-lg-3"> -->
							<div class="intro-excerpt">
								<h1></h1>
								<h1 id="greeting"><span clsas="d-block"></span></h1>

								<p class="mb-4">Es tiempo de adquirir más conocimientos</p>
								<p><a href="https://tubiblioteca.utp.edu.pe/" class="btn btn-secondary me-2"target="_blank">Biblioteca</a>
								
								<a href="https://sso.utp.edu.pe/auth/realms/Xpedition/protocol/openid-connect/auth?client_id=pao-web&redirect_uri=https%3A%2F%2Fclass.utp.edu.pe%2F&state=fefe7e3e-28bf-4744-8151-f536faa82aac&response_mode=fragment&response_type=code&scope=openid&nonce=8bbed0d1-bdca-49ae-8463-c50ecdfd2f79" class="btn btn-white-outline"target="_blank">Portal</a></p>
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
							<img src="../images/analisis.png" class="img-fluid product-thumbnail">
							<p class="title-curse">Analisis y Diseño</p>
							
							<strong class="product-price">Semana 7</strong>

							<span class="icon-cross">
								<img src="../images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- fin columna 2 -->

					<!--columna 3 -->
					<div class="col-6 col-md-2 col-lg-2 mb-3">
						<a class="product-item" href="#">
							<img src="../images/ingles.png" class="img-fluid product-thumbnail">
							<p class="title-curse">Inglés IV</p>
							
							<strong class="product-price">Semana 7</strong>

							<span class="icon-cross">
								<img src="../images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- fin columna 3 -->

					<!-- columna 4 -->
					<div class="col-6 col-md-2 col-lg-2 mb-3">
						<a class="product-item" href="#">
							<img src="../images/analisis.png" class="img-fluid product-thumbnail">
							<p class="title-curse">Analisis y Diseño</p>
							
							<strong class="product-price">Semana 7</strong>

							<span class="icon-cross">
								<img src="../images/cross.svg" class="img-fluid">
							</span>
						</a>
					</div>
					<!-- fin columna 4 -->

				</div>
			</div>
		</div>
		<!-- End Product Section -->

		


		<script src="../js/bootstrap.bundle.min.js"></script>
		<script src="../js/tiny-slider.js"></script>
		<script src="../js/custom.js"></script>
		<script>
			// Función para manejar el inicio de sesión
			document.getElementById('loginModal').addEventListener('submit', function (e) {
			  e.preventDefault(); // Evita que el formulario se envíe
		  
			  const emailInput = document.getElementById('email').value;
			  const passwordInput = document.getElementById('password').value;
		  
			  // Carga el archivo JSON de usuarios
			  fetch('/js/usuarios.json')
				.then(response => response.json())
				.then(users => {
				  // Busca si el usuario existe y si la contraseña es correcta
				  const user = users.find(u => u.email === emailInput && u.password === passwordInput);
		  
				  if (user) {
					// Inicio de sesión exitoso
					alert("Inicio de sesión exitoso");
					// Aquí puedes cerrar el modal o redirigir al usuario
					document.getElementById('loginError').style.display = 'none';
					document.getElementById('loginModal').modal('hide');
				  } else {
					// Muestra un mensaje de error
					document.getElementById('loginError').style.display = 'block';
				  }
				})
				.catch(error => {
				  console.error("Error al cargar el archivo JSON:", error);
				});
			});
		  </script>
	</body>

</html>
