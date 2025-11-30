<?php
session_start();
include '../models/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../views/login/index.php");
    exit();
}

$emailUser = isset($_POST['email_log']) ? trim(htmlspecialchars($_POST['email_log'])) : '';
$passUser = isset($_POST['passw_log']) ? $_POST['passw_log'] : '';

if ($emailUser === '' || $passUser === '') {
    $_SESSION['error'] = 'Ingrese correo y contraseña';
    header("Location: ../../views/login/index.php");
    exit();
}

$db = conexionDB();

try {
    $sqlQuery = $db->prepare("SELECT * FROM users_admins WHERE correo = :userEmail");
    $sqlQuery->bindParam(':userEmail', $emailUser);
    $sqlQuery->execute();
    $result = $sqlQuery->fetch(PDO::FETCH_ASSOC);

    if ($result && password_verify($passUser, $result['contrasena'])) {
        $_SESSION['nombre'] = $result['nombre_completo'];
        $_SESSION['correo'] = $result['correo'];
        $_SESSION['ci'] = $result['ci'];
        $_SESSION['Logueado'] = true;
        unset($_SESSION['error']);

        header("Location: ../../views/main-menu/index.php");
        exit();
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrecta';
        header("Location: ../../views/login/index.php");
        exit();
    }
} catch (PDOException $e) {
    $_SESSION['error'] = 'Error en el servidor. Intente más tarde.';
    header("Location: ../../views/login/index.php");
    exit();
}

?>