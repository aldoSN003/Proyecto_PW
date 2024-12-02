<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php include('components/header.php'); ?>
<?php include('connection.php'); ?>
<section style="background-color: #eee;">
    <div class="container py-5 d-flex justify-content-center align-items-center">
        <div class="col-lg-6">
            <!-- Tarjeta con Avatar -->
            <div class="card mb-4 text-center">
                <div class="card-body">
                    <img src="../img/messi.jpg" alt="avatar"
                        class="rounded-circle mb-3"
                        style="width: 100px; height: 100px; object-fit: cover;">
                    <h5 class="my-3"><?php echo $_SESSION['user']['name']; ?></h5>
                </div>
            </div>

            <!-- Tarjeta con Información -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="mb-3">
                        <p class="mb-1"><strong>Nombre completo</strong></p>
                        <p class="text-muted"><?php echo $_SESSION["user"]["name"] . " " . $_SESSION["user"]["last_name"]; ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editNameModal">Editar</button>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Correo electrónico</strong></p>
                        <p class="text-muted"><?php echo $_SESSION['user']['email']; ?></p>
                       
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Número telefónico</strong></p>
                        <p class="text-muted"><?php echo $_SESSION['user']['phone']; ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editPhoneModal">Editar</button>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Cumpleaños</strong></p>
                        <p class="text-muted"><?php echo $_SESSION['user']['birthday']; ?></p>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editBirthdayModal">Editar</button>
                    </div>
                    <div class="mb-3">
                        <p class="mb-1"><strong>Miembro desde</strong></p>
                        <p class="text-muted"><?php echo $_SESSION['user']['created_at']; ?></p>
                    </div>
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">Eliminar cuenta</button>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Modales para editar datos -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameLabel">Editar Nombre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crud_operations/update_user.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="text" name="first_name" class="form-control" placeholder="Nuevo Nombre" required>
                    <input type="text" name="last_name" class="form-control mt-2" placeholder="Nuevo Apellido" required>
                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmailLabel">Editar Correo Electrónico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crud_operations/update_user.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="email" name="email" class="form-control" placeholder="Nuevo Correo Electrónico" required>
                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editPhoneModal" tabindex="-1" aria-labelledby="editPhoneLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPhoneLabel">Editar Número Telefónico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crud_operations/update_user.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="text" name="phone" class="form-control" placeholder="Nuevo Número Telefónico" required>
                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editBirthdayModal" tabindex="-1" aria-labelledby="editBirthdayLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBirthdayLabel">Editar Cumpleaños</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="crud_operations/update_user.php" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']['id']; ?>">
                    <input type="date" name="birth_date" class="form-control" required>
                    <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar cuenta -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAccountLabel">Eliminar Cuenta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                <form action="crud_operations/delete_account.php" method="POST">
                    <button type="submit" class="btn btn-danger">Eliminar Cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('components/footer.php'); ?>