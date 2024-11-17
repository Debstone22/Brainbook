
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
          <li class="nav-item active">
            <a class="nav-link" href="login.php">Inicio</a>
          </li>
          <li><a class="nav-link" href="login.php">Cursos</a></li>
          <li><a class="nav-link" href="login.php">Foro</a></li>
          <li><a class="nav-link" href="login.php">Ayuda</a></li>


        </ul>

        <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">

          <li><a class="nav-link" herf="#">
              <image src="../public/images/campana.png" width="18" height="20">
            </a> </li>
          <li><a class="nav-link" href="#"><img src="../public/images/user.svg"></a></li>

        </ul>
      </div>
    </div>

  </nav>
  <!-- Fin de navegación -->

  <section class="h-100 gradient-form" style="background-color: #eee;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-xl-10">
          <div class="card rounded-3 text-black">
            <div class="row g-0">
              <div class="col-lg-6">
                <div class="card-body p-md-5 mx-md-4">

                  <div class="text-center">
                    <img src="../public/images/Logo2.png" style="width: 185px;" alt="logo">
                    <h4 class="mt-1 mb-5 pb-1">Inicia sesiónasdad en Brainbook</h4>
                  </div>

                  <form action="sesion.php" method="POST">
                    <p>Por favor ingresa tu correo electrónico</p>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="text" name="email" id="form2Example11" class="form-control"
                        placeholder="Aquí ingresa tu correo @utp.edu.pe" required />
                      <label class="form-label" for="form2Example11">Correo</label>
                    </div>
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="password" id="form2Example22" class="form-control" required />
                      <label class="form-label" for="form2Example22">Contraseña</label>
                    </div>
                    <div class="text-center pt-1 mb-5 pb-1">
                      <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                        type="submit">Ingresar</button>
                      <a class="text-muted" href="#!">¿Te olvidaste?</a>
                    </div>
                  </form>


                </div>
              </div>
              <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                  <h4 class="mb-4">Una nueva experiencia de aprendizaje</h4>
                  <p class="small mb-0">Nos adaptamos a ti, que nada te detenga, revisa tus modulos donde te quedaste,
                    completa tus tareas importantes y no te pierdas de nada.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <script src="../public/js/bootstrap.bundle.min.js"></script>
  <script src="../public/js/tiny-slider.js"></script>
  <script src="../public/js/custom.js"></script>
</body>

</html>