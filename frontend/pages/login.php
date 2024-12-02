<?php
require_once 'connection.php';
session_start();

if (isset($_SESSION['user'])) {
    header("location:welcome.php");
    exit();
}

// Verificar si el usuario se acaba de registrar y mostrarle el modal de éxito
$showModal = false;
if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
    $showModal = true;
    unset($_SESSION['registration_success']);
}

if (isset($_REQUEST['login_btn'])) {

    $email = filter_var($_REQUEST['iemail'], FILTER_SANITIZE_EMAIL);
    $password = strip_tags($_REQUEST['ipassword']);

    // Inicializar mensaje de error en un array asociativo
    $error_msg = [];
    if (empty($email) || empty($password)) {
        $error_msg['form'] = 'Completa todos los campos';
    } else {
        // Validar las credenciales usando `mysqli`
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ? LIMIT 1");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row["password"])) {
                // Establecer variables de sesión
                $_SESSION["user"]["name"] = $row["first_name"];
                $_SESSION["user"]["email"] = $row["email"];
                $_SESSION["user"]["id"] = $row["user_id"];
                $_SESSION["user"]["created_at"] = $row["created_At"];
                $_SESSION["user"]["phone"] = $row["phone"];
                $_SESSION["user"]["birthday"] = $row["birth_date"];

                header("location: welcome.php");
                exit();
            } else {
                $error_msg['login'] = 'Credenciales inválidas'; // Mensaje para credenciales incorrectas
            }
        } else {
            $error_msg['login'] = 'Credenciales inválidas';
        }
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión</title>

  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
  <?php if ($showModal): ?>
    <!-- MODAL exitoso -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="successModalLabel">¡Registro Exitoso!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            Tu cuenta se ha creado exitosamente. Por favor, inicia sesión.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Mostrar el MODAL cuando la pagina cargue
      window.addEventListener('DOMContentLoaded', function() {
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
      });
    </script>
  <?php endif; ?>
  <main class="d-flex justify-content-center align-items-center vh-100">
    <div class="row g-0 w-100">
      <div class="col-md-6 col-lg-5 d-none d-md-block">
        <img
          src="../img/user.jpg"
          alt="login form"
          class="img-fluid h-100"
          style="object-fit: cover; border-radius: 1rem 0 0 1rem" />
      </div>
      <div class="col-md-6 col-lg-7 d-flex align-items-center">
        <div class="card-body p-4 p-lg-5 text-black w-100">
          <form action="login.php" method="post">
            <div class="d-flex align-items-center mb-3 pb-1">
              <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219"></i>
              <span class="h1 fw-bold mb-0">INGESHOP</span>
            </div>

            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">
              Inicia sesión en tu cuenta
            </h5>

            <div class="form-outline mb-4">
              <input
                placeholder="jane@doe.com"
                type="email"
                name="iemail"
                id="form2Example17"
                class="form-control form-control-lg form-check" />

              <label class="form-label" for="form2Example17">Correo electrónico</label>


            </div>

            <div class="form-outline mb-4 ">
              <input
                type="password"
                name="ipassword"
                id="form2Example27"
                class="form-control form-control-lg" />
              <label class="form-label" for="form2Example27">Contraseña</label>
              <button
                type="button"
                class="btn"
                onclick="togglePasswordVisibility('form2Example27', 'toggleIcon')"
                style="border: none; background: transparent; outline: none">
                <i class="fas fa-eye" id="toggleIcon"></i>
              </button>
            </div>
            <div class="pt-1 mb-4">
              <button class="btn btn-dark btn-lg btn-block" type="submit" name="login_btn">
                Iniciar sesión
              </button>
            </div>
            <a class="small text-muted" href="#!">¿Olvidaste tu contraseña?</a>
            <p class="mb-5 pb-lg-2" style="color: #393f81">
              ¿No tienes una cuenta?
              <a
                id="registerLink"
                href="../pages/register.php"
                style="color: #393f81">Regístrate aquí</a>
            </p>
            <a href="terminosUso.php" class="small text-muted">Términos de uso</a>
            <a href="politicas.php" target="_blank" class="small text-muted">Política de privacidad</a>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- MODAL para errores -->
  <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="errorModalLabel">Error de Inicio de Sesión</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <?php
          if (isset($error_msg['login'])) {
            echo "<p class='text-danger'>" . $error_msg['login'] . "</p>";
          }
          if (isset($error_msg['form'])) {
            echo "<p class='text-danger'>" . $error_msg['form'] . "</p>";
          }

          ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/utils.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    // Mostrar si hay mensajes de errores
    <?php if (!empty($error_msg)) { ?>
      var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
      myModal.show();
    <?php } ?>
  </script>
</body>

</html>