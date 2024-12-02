<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include('../connection.php'); // Asegúrate de que este archivo contenga la conexión a la base de datos

// Verificar que la solicitud sea de tipo POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar que el usuario esté autenticado
    if (!isset($_SESSION['user']['id'])) {
        header("Location: ../login.php"); // Redirigir a la página de inicio de sesión si no está autenticado
        exit();
    }

    // Obtener el user_id del formulario
    $user_id = $_SESSION['user']['id'];

    // Preparar la consulta para eliminar la cuenta
    $stmt = $conn->prepare("DELETE FROM user WHERE user_id = ?"); // Asegúrate de que el nombre de la columna sea correcto
    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $user_id);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Cerrar la sesión y redirigir al usuario a la página de inicio 
        session_destroy(); // Destruir la sesión
        header("Location: ../../index.php?account_deleted=1"); // Redirigir a la página de inicio con un mensaje de éxito
        exit();
    } else {
        // Manejar el error en caso de que la eliminación falle
        echo "Error al eliminar la cuenta: " . $stmt->error; // Muestra el error
        exit();
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    // Si no es una solicitud POST, redirigir a la página de configuración del perfil
    header("Location: ../profile_settings.php");
    exit();
}

// Cerrar la conexión a la base de datos
$conn->close();
