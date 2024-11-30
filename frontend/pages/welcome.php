<?php
require_once 'connection.php';
session_start();

// Compruebe si el usuario ha iniciado sesión verificando los datos de la sesión
if (!isset($_SESSION['user'])) {
    // si el usuario no esta logeado redireccionarl hacia la pagina de logeado
    header("location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>


    <!-- BOOTSTRAP 4 -->
    <link rel="stylesheet" href="https://bootswatch.com/4/yeti/bootstrap.min.css">
    <!-- FONT AWESOEM -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Agregando el enlace CSS Bootstrap para diseñar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/style.css" />


</head>

<body>

    <header>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container">
                <a class="navbar-brand text-uppercase" href="" id="navbarBrand">IngeManager</a>
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
                            <!-- Se actualizó data-bs-target para que coincida con el ID del elemento offcanvas. -->
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

    <h1>Has iniciado sesion correctamente!</h1>

    <main>
        <main class="container p-4">
            <div class="row">
                <div class="col-md-4">
                    <!-- MESSAGES -->

                    <?php if (isset($_SESSION['user']['message'])) { ?>
                        <div class="alert alert-<?= $_SESSION['user']['message_type'] ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['user']['message'] ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php session_unset();
                    } ?>

                    <!-- ADD TASK FORM -->
                    <div class="card card-body">
                        <form action="crud_operations/save_task.php" method="POST">
                            <div class="form-group">
                                <input type="text" name="title" class="form-control" placeholder="Task Title" autofocus>
                            </div>
                            <div class="form-group">
                                <textarea name="description" rows="2" class="form-control" placeholder="Task Description"></textarea>
                            </div>
                            <input type="submit" name="save_task" class="btn btn-success btn-block" value="Save Task">
                        </form>
                    </div>
                </div>
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $query = "SELECT * FROM task";
                            $result_tasks = mysqli_query($conn, $query);

                            while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
                                <tr>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td><?php echo $row['created_at']; ?></td>
                                    <td>
                                        <a href="crud_operations/edit.php?id=<?php echo $row['id']?>" class="btn btn-secondary">
                                            <i class="fas fa-marker"></i>
                                        </a>
                                        <a href="crud_operations/delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">

                                            <i class="far fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>

    </main>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bg-dark text-white">
            <h5 id="offcanvasRightLabel" class="fw-bold">Mi Cuenta</h5>
            <button type="button" class="btn-close text-reset bg-light" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body" style="background-color: #f8f9fa; color: #333;">

            <!-- imagen de perfil -->
            <div class="text-center mb-4">
                <img src="../img/messi.jpg" alt="User Profile" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            </div>

            <!-- seccion de informacion de usuario -->
            <div class="mb-4">
                <h4 class="text-left">Bienvenido, <strong><?php echo $_SESSION['user']['name']; ?></strong>!</h4>
                <p class="text-left">Tu correo: <strong><?php echo $_SESSION['user']['email']; ?></strong></p>
                <p class="text-left">Tel: <strong><?php echo $_SESSION['user']['phone']; ?></strong></p>
                <p class="text-left text-muted">Miembro desde: <strong><?php echo $_SESSION['user']['date']; ?></strong></p>
                <p class="text-left text-muted">Cumpleaños: <strong><?php echo $_SESSION['user']['birthday']; ?></strong></p>
                <p class="text-left text-muted">Rol: <strong>Administrador</strong></p>
            </div>

            <!-- separador -->
            <hr class="my-4">

            <!-- editar perfil y cambiar la contraseña -->
            <div class="mb-4">
                <a href="profile_settings.php" class="btn btn-outline-dark btn-sm px-4 py-2 mb-3 w-100 text-start">
                    <i class="fas fa-user-edit"></i> Editar perfil
                </a>
                <a href="#" data-bs-toggle="modal" data-bs-target="#pwdModal" class="btn btn-outline-dark btn-sm px-4 py-2 mb-3 w-100 text-start">
                    <i class="fas fa-key"></i> Cambiar contraseña
                </a>
            </div>

            <!-- separador -->
            <hr class="my-4">

            <!-- boton de cerrado de sesion -->
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
                    <!-- "X" boton de cerrado -->
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




    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>


    <!-- BOOTSTRAP 4 SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>


</body>

</html>