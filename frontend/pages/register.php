<?php
require_once 'connection.php';

$error_msg = [];

# CLICKING "register_btn"
if (isset($_REQUEST['register_btn'])) {
  $firstName = $_REQUEST['firstName'] ?? '';
  $lastName = $_REQUEST['lastName'] ?? '';
  $birthdayDate = $_REQUEST['birthdayDate'] ?? '';
  $gender = $_REQUEST['gender'] ?? '';
  $emailAddress = filter_var($_REQUEST['emailAddress'], FILTER_SANITIZE_EMAIL);
  $phoneNumber = $_REQUEST['phoneNumber'] ?? '';
  $password = strip_tags($_REQUEST['password'] ?? '');


  // Validate fields and store error messages
  if (empty($firstName)) {
    $error_msg['firstName'][] = "First name is required";
  }

  if (empty($lastName)) {
    $error_msg['lastName'][] = "Last name is required";
  }

  if (empty($emailAddress)) {
    $error_msg['emailAddress'][] = "Email is required";
  } elseif (!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
    $error_msg['emailAddress'][] = "Invalid email format";
  }

  if (empty($phoneNumber)) {
    $error_msg['phoneNumber'][] = "Phone number is required";
  }

  if (empty($password)) {
    $error_msg['password'][] = "Password is required";
  }

  try {

    if (empty($error_msg)) {
      // Prepare SQL query to check if the email already exists in the database
      $select_stmt = $db->prepare("SELECT name, email FROM users WHERE email = :emailAddress");
      $select_stmt->execute([':emailAddress' => $emailAddress]);

      // Fetch result to check if email is found
      $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

      // Check if the email already exists
      if ($row && $row['email'] === $emailAddress) {
        $error_msg[1][] = "Email address already exists";
      }
    }
  } catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register</title>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
  <style>
    main {
      min-height: 100vh;
    }
  </style>
</head>

<body>
  <main class="d-flex justify-content-center align-items-start">
    <div class="row g-0 w-100">
      <div class="col-md-6 col-lg-5 d-none d-md-block">
        <img
          src="../img/user.jpg"
          alt="register form"
          class="img-fluid h-100"
          style="object-fit: cover; border-radius: 1rem 0 0 1rem" />
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
              <!-- First Name Field -->
              <div class="col-md-6 mb-4">
                <?php if (isset($error_msg['firstName'])) {
                  foreach ($error_msg['firstName'] as $error) {
                    echo "<p class='small text-danger'>" . $error . "</p>";
                  }
                } ?>
                <div class="form-outline">
                  <input type="text" id="firstName" name="firstName" class="form-control form-control-lg" required />
                  <label class="form-label" for="firstName">Nombre(s)</label>
                </div>
              </div>

              <!-- Last Name Field -->
              <div class="col-md-6 mb-4">
                <?php if (isset($error_msg['lastName'])) {
                  foreach ($error_msg['lastName'] as $error) {
                    echo "<p class='small text-danger'>" . $error . "</p>";
                  }
                } ?>
                <div class="form-outline">
                  <input type="text" id="lastName" name="lastName" class="form-control form-control-lg" required />
                  <label class="form-label" for="lastName">Apellido(s)</label>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Birthdate Field -->
              <div class="col-md-6 mb-4">
                <div class="form-outline">
                  <input type="date" class="form-control form-control-lg" id="birthdayDate" name="birthdayDate" required />
                  <label for="birthdayDate" class="form-label">Fecha de nacimiento</label>
                </div>
              </div>

              <!-- Gender Fields -->
              <div class="col-md-6 mb-4">
                <h6 class="mb-2 pb-1">Género:</h6>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="femaleGender" value="female" checked />
                  <label class="form-check-label" for="femaleGender">Mujer</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="maleGender" value="male" />
                  <label class="form-check-label" for="maleGender">Hombre</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="otherGender" value="other" />
                  <label class="form-check-label" for="otherGender">Otro</label>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Email Field -->
              <div class="col-md-6 mb-4 pb-2">
                <?php
                if (isset($error_msg[1])) {
                  foreach ($error_msg[1] as $email_errors) {
                    echo "<p class='small text-danger'>" . $email_errors . "</p>";
                  }
                }
                ?>
                <div class="form-outline">
                  <input type="email" id="emailAddress" name="emailAddress" class="form-control form-control-lg" required />
                  <label class="form-label" for="emailAddress">Correo electrónico</label>
                </div>
              </div>

              <!-- Phone Number Field -->
              <div class="col-md-6 mb-4 pb-2">
                <?php if (isset($error_msg['phoneNumber'])) {
                  foreach ($error_msg['phoneNumber'] as $error) {
                    echo "<p class='small text-danger'>" . $error . "</p>";
                  }
                } ?>
                <div class="form-outline">
                  <input type="tel" id="phoneNumber" name="phoneNumber" class="form-control form-control-lg" required />
                  <label class="form-label" for="phoneNumber">Número de teléfono</label>
                </div>
              </div>
            </div>

            <div class="row">
              <!-- Password Field -->
              <div class="col-md-6 mb-4 pb-2">
                <?php if (isset($error_msg['password'])) {
                  foreach ($error_msg['password'] as $error) {
                    echo "<p class='small text-danger'>" . $error . "</p>";
                  }
                } ?>
                <div class="form-outline">
                  <input type="password" id="password" name="password" class="form-control form-control-lg" required />
                  <label class="form-label" for="password">Contraseña</label>
                  <button type="button" class="btn" onclick="togglePasswordVisibility('password','toggleps')">
                    <i class="fas fa-eye" id="toggleps"></i>
                  </button>
                </div>
              </div>

              <!-- Confirm Password Field -->
              <div class="col-md-6 mb-4 pb-2">
                <div class="form-outline">
                  <input type="password" id="confirmPassword" name="confirmPassword" class="form-control form-control-lg" required />
                  <label class="form-label" for="confirmPassword">Confirmar contraseña</label>
                  <button type="button" class="btn" onclick="togglePasswordVisibility('confirmPassword','togglecps')">
                    <i class="fas fa-eye" id="togglecps"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-4 pt-2">
              <button class="btn btn-dark btn-lg btn-block" type="submit" name="register_btn">Registrar</button>
            </div>
          </form>

          <!-- Login Link -->
          <p class="mb-5 pb-lg-2" style="color: #393f81">
            ¿Ya tienes cuenta?
            <a href="login.php" style="color: #393f81">Inicia sesión aquí</a>
          </p>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/utils.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2