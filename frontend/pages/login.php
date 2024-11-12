<?php
require_once 'connection.php';
session_start();
/*
if (isset($_SESSION['user'])) {
  header("location:welcome.php");
}*/

if (isset($_REQUEST['login_btn'])) {


  $email = filter_var($_REQUEST['iemail'], FILTER_SANITIZE_EMAIL);
  $password = strip_tags($_REQUEST['ipassword']);
  // Initialize error messages as an associative array
  $error_msg = [];
  if (empty($email)) {
    $error_msg['email'] = 'Must enter email';
  }

  if (empty($password)) {
    $error_msg['password'] = 'Must enter password';
  } else {
    try {
      $select_stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
      $select_stmt->execute([
        ':email' => $email,
      ]);
      $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

      if ($select_stmt->rowCount() > 0) {
        if (password_verify($password, $row["password"])) {
          $_SESSION["user"]["name"] = $row["first_name"];
          $_SESSION["user"]["email"] = $row["email"];
          $_SESSION["user"]["id"] = $row["user_id"];
          header("location: welcome.php");
        } else {
          $error_msg['login'] = 'Wrong email or password'; // Added specific error for wrong credentials
        }
      } else {
        $error_msg['login'] = 'Wrong email or password';
      }
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <!-- Add Bootstrap CSS link for styling -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    rel="stylesheet" />
</head>

<body>
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
              <span class="h1 fw-bold mb-0">INGEMANAGER</span>
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
              <?php
              if (isset($error_msg['email'])) {
                echo " <label class='form-label small text-danger'>" . $error_msg['email'] . "</label>";
              }
              ?>

            </div>
            <?php
            if (isset($error_msg['password'])) {
              echo "<p class='small text-danger'>" . $error_msg['password'] . "</p>";
            }
            ?>
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
              <button class="btn btn-primary" type="submit" name="login_btn">
                Login
              </button>
            </div>
            <a class="small text-muted" href="#!">¿Olvidaste tu contraseña?</a>
            <p class="mb-5 pb-lg-2" style="color: #393f81">
              ¿No tienes una cuenta?
              <a
                id="registerLink"
                href="../pages/register.php"
                style="color: #393f81">Registrate aquí</a>
            </p>
            <a href="#!" class="small text-muted">Términos de uso</a>
            <a href="#!" class="small text-muted">Política de privacidad</a>
          </form>
        </div>
      </div>
    </div>
  </main>

  <script src="../js/utils.js"></script>
  <!-- Add Bootstrap JS and Popper.js for modal functionality -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>