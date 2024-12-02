<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css" />


    <style>
        .card-img-top {
            height: 40vh;
            /* Set a fixed height for all images */
            object-fit: cover;
            /* Ensures the image covers the area while maintaining aspect ratio */
            width: 100%;
            /* Ensures the image takes the full width of the card */
        }
    </style>

</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand text-uppercase" href="../index.php" id="navbarBrand">INGESHOP</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">


                        <li class="nav-item">
                            <a class="nav-link" href="#" id="accountLink" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                                <i class="far fa-circle-user"></i> Mi cuenta
                            </a>
                        </li>
                        <!-- Cart Bag Item -->
                        <li class="nav-item">
                            <a class="nav-link" href="shopping_cart.php" id="cartLink">
                                <i class="fas fa-cart-shopping"></i> Carrito
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bg-dark text-white">
            <h5 id="offcanvasRightLabel" class="fw-bold">Mi Cuenta</h5>
            <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #f8f9fa; color: #333;">
            <div class="text-center mb-4">
                <img src="../img/messi.jpg" alt="User  Profile" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            </div>
            <div class="mb-4">
                <h4 class="text-left">Bienvenido, <strong><?php echo htmlspecialchars($_SESSION['user']['name']); ?></strong>!</h4>
                <p class="text-left">Tu correo: <strong><?php echo htmlspecialchars($_SESSION['user']['email']); ?></strong></p>
                <p class="text-left">Tel: <strong><?php echo htmlspecialchars($_SESSION['user']['phone']); ?></strong></p>
                <p class="text-left">Miembro desde: <strong><?php echo $_SESSION['user']['created_at']; ?></strong></p>
                <p class="text-left text-muted">Cumpleaños: <strong><?php echo htmlspecialchars($_SESSION['user']['birthday']); ?></strong></p>
                <p class="text-left text-muted">Rol: <strong>Administrador</strong></p>
            </div>
            <hr class="my-4">
            <div class="mb-4">
                <a href="profile_settings.php" class="btn btn-outline-dark btn-sm w-100 mb-3 text-start">
                    <i class="fas fa-user-edit"></i> Editar perfil
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#pwdModal" class="btn btn-outline-dark btn-sm w-100 mb-3 text-start">
                    <i class="fas fa-key"></i> Cambiar contraseña
                </a>
            </div>
            <hr class="my-4">
            <div class="d-flex justify-content-start mt-5">
                <a href="logout.php" class="btn btn-danger px-4 py-2" style="text-transform: uppercase;">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </div>