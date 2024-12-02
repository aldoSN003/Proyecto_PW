<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
<?php
session_start();
include('../connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];

    // Validar y sanitizar los datos aquí
    if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];

        $stmt = $conn->prepare("UPDATE user SET first_name = ?, last_name = ? WHERE user_id = ?");
        $stmt->bind_param("ssi", $first_name, $last_name, $user_id);
        $stmt->execute();
    }

    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        $stmt = $conn->prepare("UPDATE user SET email = ? WHERE user_id = ?");
        $stmt->bind_param("si", $email, $user_id);
        $stmt->execute();
    }

    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];

        $stmt = $conn->prepare("UPDATE user SET phone = ? WHERE user_id = ?");
        $stmt->bind_param("si", $phone, $user_id);
        $stmt->execute();
    }

    if (isset($_POST['birth_date'])) {
        $birth_date = $_POST['birth_date'];

        $stmt = $conn->prepare("UPDATE user SET birth_date = ? WHERE user_id = ?");
        $stmt->bind_param("si", $birth_date, $user_id);
        $stmt->execute();
    }

    // Actualizar la sesión con los nuevos datos
    // Aquí puedes actualizar la sesión solo si se han cambiado los datos
    $_SESSION['user']['name'] = $first_name ?? $_SESSION['user']['name'];
    $_SESSION['user']['last_name'] = $last_name ?? $_SESSION['user']['last_name'];
    $_SESSION['user']['email'] = $email ?? $_SESSION['user']['email'];
    $_SESSION['user']['phone'] = $phone ?? $_SESSION['user']['phone'];
    $_SESSION['user']['birthday'] = $birth_date ?? $_SESSION['user']['birthday'];

    header("Location: ../profile_settings.php?success=1");
} else {
    header("Location: ../profile_settings.php?error=1");
}
