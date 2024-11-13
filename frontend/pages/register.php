<?php
require_once 'connection.php';
session_start(); // iniciar la sesion para manejar las variables de sesion
$error_msg = [];

# presionar el boton de registro
if (isset($_REQUEST['register_btn'])) {

  $firstName = htmlspecialchars(strip_tags(trim($_REQUEST['ifirstName'] ?? '')));
  $lastName = htmlspecialchars(strip_tags(trim($_REQUEST['ilastName'] ?? '')));
  $birthdayDate = htmlspecialchars(strip_tags(trim($_REQUEST['ibirthdayDate'] ?? '')));
  $gender = htmlspecialchars(strip_tags(trim($_REQUEST['igender'] ?? '')));

  // validar campos especificos
  $emailAddress = filter_var(trim($_REQUEST['iemailAddress'] ?? ''), FILTER_SANITIZE_EMAIL);
  $phoneNumber = htmlspecialchars(strip_tags(trim($_REQUEST['iphoneNumber'] ?? '')));
  $password = strip_tags(trim($_REQUEST['ipassword'] ?? ''));
  $confirmPassword = strip_tags(trim($_REQUEST['iconfirmPassword'] ?? ''));

  // inicializar el array para los mensajes de errores
  $error_msg = [];

  // validar si los campos estan vacios
  if (empty($firstName)) {
    $error_msg['firstName'][] = "El nombre es obligatorio";
  }
  if (empty($lastName)) {
    $error_msg['lastName'][] = "El apellido es obligatorio";
  }
  if (empty($birthdayDate)) {
    $error_msg['birthdayDate'][] = "La fecha de nacimiento es obligatoria";
  }
  if (empty($gender)) {
    $error_msg['gender'][] = "El género es obligatorio";
  }


  if (empty($phoneNumber)) {
    $error_msg['phoneNumber'][] = "El número de teléfono es obligatorio";
  } elseif (!preg_match('/^[0-9]{10}$/', $phoneNumber)) { // Ajustar la expresión regular según el formato del teléfono
    $error_msg['phoneNumber'][] = "El número de teléfono debe ser un número válido de 10 dígitos";
  }

  if (empty($password)) {
    $error_msg['password'][] = "La contraseña es obligatoria";
  } elseif (strlen($password) < 6) {
    $error_msg['password'][] = "La contraseña debe tener al menos 6 caracteres";
  } elseif ($password !== $confirmPassword) {
    $error_msg['confirmPassword'][] = "Las contraseñas no coinciden";
  }

  // checar si hay errores antes de la insercion
  if (empty($error_msg)) {
    try {
      // 1. preparar el query sql para verificar si ese email existe ya
      $select_stmt = $db->prepare("SELECT email FROM users WHERE email = :email");
      $select_stmt->execute([':email' => $emailAddress]);

      // 2. si el email es encontrado
      $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

      // 3. cehcar si el email existe
      if ($row && $row['email'] === $emailAddress) {
        $error_msg['email'][] = "El correo electrónico ya existe";
      } else {
        // 4. si no hay errores, proceder a insertar el nuevo usuario
        // hacer Hash a la contraseña antes de proceder
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // preparar el query sql antes de insertar
        $insert_stmt = $db->prepare(
          "INSERT INTO users (first_name, last_name, birth_date, gender, email, phone, password) 
           VALUES (:first_name, :last_name, :birth_date, :gender, :email, :phone, :password)"
        );
        $insert_stmt->execute([
          ':first_name' => $firstName,
          ':last_name' => $lastName,
          ':birth_date' => $birthdayDate,
          ':gender' => $gender,
          ':email' => $emailAddress,
          ':phone' => $phoneNumber,
          ':password' => $hashedPassword
        ]);

        // colcar la sesion flag para verificar que la insercion fue exitosa
        $_SESSION['registration_success'] = true;
        // Exito: redireccionar o mostrar mensaje de exito
        header("Location: login.php"); // redireccionar a la pagina de exito
        exit();
      }
    } catch (PDOException $e) {
      // mostrar un error si ocurre un error  en el query
      echo "Error de base de datos o servidor: " . $e->getMessage();
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
  <style>
    main {
      min-height: 100vh;
    }
  </style>
</head>

<body>
  <?php
  if (isset($error_msg['db'])) {
    foreach ($error_msg['db'] as $email_errors) {
      echo "<p class='small text-danger'>" . $email_errors . "</p>";
    }
  }
  ?>
  <main class="d-flex justify-content-center align-items-start">


    <!-- modelo para errores -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="errorModalLabel">Error en el registro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <?php

            if (isset($error_msg['confirmPassword'])) {
              foreach ($error_msg['confirmPassword'] as $msg) {
                echo "<p class='text-danger'>$msg</p>";
              }
            }
            if (isset($error_msg['email'])) {
              foreach ($error_msg['email'] as $msg) {
                echo "<p class='text-danger'>$msg</p>";
              }
            }
            ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>

    <div class="row g-0 w-100">
      <div class="col-md-6 col-lg-5 d-none d-md-block">
        <img src="../img/user.jpg" alt="register form" class="img-fluid h-100" style="object-fit: cover; border-radius: 1rem 0 0 1rem" />
      </div>
      <div class="col-md-6 col-lg-7 d-flex align-items-center">
        <div class="card-body p-4 p-lg-5 text-black w-100">
          <div class="d-flex align-items-center mb-3 pb-1">
            <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219"></i>
            <span class="h1 fw-bold mb-0">INGEMANAGER</span>
          </div>
          <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px">Formulario de registro</h5>

          <form action="register.php" method="post">
            <div class="row">

              <!-- campo para primer nombre -->
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="firstName" name="ifirstName" class="form-control form-control-lg" required />
                  <label class="form-label" for="firstName">Nombre(s)</label>
                </div>
              </div>

              <!-- campo para apellidos -->
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="text" id="lastName" name="ilastName" class="form-control form-control-lg" required />
                  <label class="form-label" for="lastName">Apellido(s)</label>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- campo para fecha de nacimiento -->
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="date" class="form-control form-control-lg" id="birthdayDate" name="ibirthdayDate" required />
                  <label for="birthdayDate" class="form-label">Fecha de nacimiento</label>
                </div>
              </div>

              <!-- campo para genero -->
              <div class="col-md-6 mb-4">
                <h6 class="mb-2 pb-1">Género:</h6>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="igender" id="femaleGender" value="Mujer" checked />
                  <label class="form-check-label" for="femaleGender">Mujer</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="igender" id="maleGender" value="Hombre" />
                  <label class="form-check-label" for="maleGender">Hombre</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="igender" id="otherGender" value="Otro" />
                  <label class="form-check-label" for="otherGender">Otro</label>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- campo para email -->
              <div class="col-md-6 mb-4 pb-2">
                <?php
                if (isset($error_msg['emailAddress'])) {
                  foreach ($error_msg['emailAddress'] as $email_errors) {
                    echo "<p class='small text-danger'>" . $email_errors . "</p>";
                  }
                }
                ?>
                <div class="form-outline">
                  <input type="email" id="emailAddress" name="iemailAddress" class="form-control form-control-lg" required />
                  <label class="form-label" for="emailAddress">Correo electrónico</label>
                </div>
              </div>

              <!-- campo para numero -->
              <div class="col-md-6 mb-4 pb-2">
                <div class="form-outline">
                  <input type="text" id="phoneNumber" name="iphoneNumber" class="form-control form-control-lg" />
                  <label class="form-label" for="phoneNumber">Número de teléfono</label>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- campo para contraseña -->
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="password" id="password" name="ipassword" class="form-control form-control-lg" required />
                  <label class="form-label" for="password">Contraseña</label>
                  <button
                    type="button"
                    class="btn"
                    onclick="togglePasswordVisibility('password', 'toggleIcon1')"
                    style="border: none; background: transparent; outline: none">
                    <i class="fas fa-eye" id="toggleIcon1"></i>
                  </button>
                </div>
              </div>

              <!-- campo para confirmar contraseña -->
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="password" id="confirmPassword" name="iconfirmPassword" class="form-control form-control-lg" required />
                  <label class="form-label" for="confirmPassword">Confirmar contraseña</label>
                  <button
                    type="button"
                    class="btn"
                    onclick="togglePasswordVisibility('confirmPassword', 'toggleIcon2')"
                    style="border: none; background: transparent; outline: none">
                    <i class="fas fa-eye" id="toggleIcon2"></i>
                  </button>
                </div>
              </div>
            </div>

            <div class="pt-1 mb-4">
              <button class="btn btn-dark btn-lg btn-block" type="submit" name="register_btn">Registrar</button>
            </div>
            <p class="mb-5 pb-lg-2" style="color: #393f81">Ya tienes una cuenta? <a href="login.php" style="color: #393f81">Iniciar sesión</a></p>
          </form>
        </div>
      </div>
    </div>
  </main>

  <!-- usar javascript para mostrar si hay mensajes de erores -->
  <script src="../js/utils.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

  <script>
    // mostrar el modelo si hay errores
    <?php if (!empty($error_msg)) { ?>
      var myModal = new bootstrap.Modal(document.getElementById('errorModal'));
      myModal.show();
    <?php } ?>
  </script>
</body>

</html>