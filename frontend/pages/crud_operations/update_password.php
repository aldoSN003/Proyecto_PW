<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexión a la base de datos
require '../connection.php'; // Asegúrate de tener un archivo para la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validar que las nuevas contraseñas coincidan
    if ($new_password !== $confirm_password) {
        $_SESSION['error'] = "Las contraseñas no coinciden.";
        header("Location: ../welcome.php"); // Cambia esto a la página anterior
        exit();
    }

    // Obtener el usuario actual de la sesión
    $user_id = $_SESSION['user']['id']; // Asegúrate de que el ID del usuario esté en la sesión

    // Consultar la base de datos para obtener la contraseña actual del usuario
    $stmt = $conn->prepare("SELECT password FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Verificar la contraseña actual
    if (!password_verify($current_password, $user['password'])) {
        $_SESSION['error'] = "La contraseña actual es incorrecta.";
        header("Location:../welcome.php"); // Cambia esto a la página anterior
        exit();
    }

    // Actualizar la contraseña
    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
    $update_stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ?");
    $update_stmt->bind_param("si", $hashed_new_password, $user_id);

    if ($update_stmt->execute()) {
        $_SESSION['success'] = "Contraseña actualizada con éxito.";
    } else {
        $_SESSION['error'] = "Error al actualizar la contraseña.";
    }

    header("Location: ../welcome.php"); // Cambia esto a la página anterior
    exit();
}
