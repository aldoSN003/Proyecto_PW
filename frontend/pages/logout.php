<?php
session_start();

// eliminar todas las sesiones para cerrar la sesion del usuario
session_unset();
session_destroy();

// redireccionar a la pagina de logeo
header("Location: ../index.php");
exit();
