<?php
require_once 'connection.php';
session_start();

// Check if the user is logged in by verifying session data
if (!isset($_SESSION['user'])) {
    // If the user is not logged in, redirect them to the login page
    header("location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand text-uppercase" href="welcome.php" id="navbarBrand">IngeManager</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="mainPanelLink">Panel principal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="faqLink">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <!-- Updated the data-bs-target to match the offcanvas element's ID -->
                            <a class="nav-link" href="#" id="accountLink" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="far fa-circle-user"></i>
                                Mi cuenta
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section style="background-color: #eee;">
        <div class="container py-5">


            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="../img/messi.jpg" alt="avatar"
                                class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;"
                                style="width: 150px;">
                            <h5 class="my-3">John Smith</h5>
                            <p class="text-muted mb-1">Full Stack Developer</p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush rounded-3">
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fas fa-globe fa-lg text-warning"></i>
                                    <p class="mb-0">https://mdbootstrap.com</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-github fa-lg text-body"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                    <p class="mb-0">@mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                    <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                                    <p class="mb-0">mdbootstrap</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">Johnatan Smith</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">example@example.com</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Phone</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">(097) 234-5678</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Mobile</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">(098) 765-4321</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                                    </p>
                                    <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                                    <div class="progress rounded" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                                    <div class="progress rounded mb-2" style="height: 5px;">
                                        <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                            aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bg-dark text-white">
            <h5 id="offcanvasRightLabel" class="fw-bold">Mi Cuenta</h5>
            <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #f8f9fa; color: #333;">

            <!-- Profile Image -->
            <div class="text-center mb-4">
                <img src="../img/messi.jpg" alt="User Profile" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            </div>

            <!-- User Info Section -->
            <div class="mb-4">
                <h4 class="text-left">Bienvenido, <strong><?php echo $_SESSION['user']['name']; ?></strong>!</h4>
                <p class="text-left">Tu correo: <strong><?php echo $_SESSION['user']['email']; ?></strong></p>
                <p class="text-left">Tel: <strong><?php echo $_SESSION['user']['phone']; ?></strong></p>
                <p class="text-left text-muted">Miembro desde: <strong><?php echo $_SESSION['user']['date']; ?></strong></p>
                <p class="text-left text-muted">Rol: <strong>Administrador</strong></p>
            </div>

            <!-- Separator -->
            <hr class="my-4">

            <!-- Edit Profile & Change Password Links -->
            <div class="mb-4">
                <a href="profile_settings.php" class="btn btn-outline-dark btn-sm px-4 py-2 mb-3 w-100 text-start">
                    <i class="fas fa-user-edit"></i> Editar perfil
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#pwdModal" class="btn btn-outline-dark btn-sm px-4 py-2 mb-3 w-100 text-start">
                    <i class="fas fa-key"></i> Cambiar contraseña
                </a>
            </div>

            <!-- Separator -->
            <hr class="my-4">

            <!-- Logout Button -->
            <div class="d-flex justify-content-start mt-5">
                <a href="logout.php" class="btn btn-danger px-4 py-2" style="text-transform: uppercase;">
                    Cerrar sesión
                </a>
            </div>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal top fade" id="pwdModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-mdb-backdrop="true" data-mdb-keyboard="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content text-center">
                <div class="modal-header h5 text-white bg-primary justify-content-center bg-dark">
                    Restablecer la contraseña
                    <!-- "X" close button -->
                    <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5">
                    <p class="py-2">
                        Ingresa tu dirección de correo electrónico y te enviaremos un correo con las instrucciones para restablecer tu contraseña.
                    </p>
                    <div data-mdb-input-init class="form-outline">
                        <input type="email" id="typeEmail" class="form-control form-check my-3" />
                        <label class="form-label" for="typeEmail">Correo electrónico</label>
                    </div>

                    <a href="#" data-mdb-ripple-init class="btn btn-block btn-dark w-100">Restablecer contraseña</a>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Bootstrap JS and Popper.js for offcanvas functionality -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>