<?php
session_start();
include '../models/conexion.php';

date_default_timezone_set('America/Caracas');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../views/login/index.php");
    exit();
}

$emailUser = isset($_POST['email_log']) ? trim($_POST['email_log']) : '';
$passUser = isset($_POST['passw_log']) ? $_POST['passw_log'] : '';

if ($emailUser === '' || $passUser === '') {
    $_SESSION['error'] = 'Ingrese correo y contraseña';
    header("Location: ../../views/login/index.php");
    exit();
}

if (!filter_var($emailUser, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Formato de correo inválido.';
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

        $dateNow = date("d-m-Y H:i:s");
        if(isset($_COOKIE['lastVisited'])){
            $_SESSION['lastVisited'] = $_COOKIE['lastVisited'];
        }
        setcookie('lastVisited', $dateNow, time() + (86400 * 30));

        unset($_SESSION['error']);

        header("Location: ../../views/login/index.php");
        exit();
    } else {
        $_SESSION['error'] = 'Usuario o contraseña incorrecta';
        header("Location: ../../views/login/index.php");
        exit();
    }
} catch (PDOException $e) {
    error_log('Auth error: ' . $e->getMessage());
    $_SESSION['error'] = 'Error en el servidor. Intente más tarde.';
    header("Location: ../../views/login/index.php");
    exit();
}

?>