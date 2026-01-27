<?php
session_start();
include '../../models/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../views/change-password/index.php');
    exit();
}

$newPassword = isset($_POST['new_password']) ? trim($_POST['new_password']) : '';
$repeatPassword = isset($_POST['rep_password']) ? trim($_POST['rep_password']) : '';

if ($newPassword === '' || $repeatPassword === '') {
    $_SESSION['errors'] = ['Complete ambos campos de contraseña.'];
    header('Location: ../../views/change-password/index.php');
    exit();
}

if ($newPassword !== $repeatPassword) {
    $_SESSION['errors'] = ['Las contraseñas no coinciden.'];
    header('Location: ../../views/change-password/index.php');
    exit();
}

// contraseña mínima segura
if (strlen($newPassword) < 8) {
    $_SESSION['errors'] = ['La contraseña debe tener al menos 8 caracteres.'];
    header('Location: ../../views/change-password/index.php');
    exit();
}

$userID = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
if (!$userID) {
    $_SESSION['errors'] = ['Usuario no identificado. Inicie el proceso de recuperación otra vez.'];
    header('Location: ../../views/auth-identification/index.php');
    exit();
}



try {
    $dbConnect = conexionDB();
    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

    $sql = $dbConnect->prepare('UPDATE users_admins SET contrasena = :hashNewPassword WHERE ci = :id');
    $sql->bindParam(':hashNewPassword', $newPasswordHash);
    $sql->bindParam(':id', $userID, PDO::PARAM_INT);
    $sql->execute();

    // limpiar sesión de recuperación
    unset($_SESSION['id_user']);
    $_SESSION['mensaje'] = 'Contraseña actualizada con éxito.';

    header('Location: ../../views/change-password/successfull.php');
    exit();
} catch (PDOException $e) {
    error_log('NewPassword error: ' . $e->getMessage());
    $_SESSION['errors'] = ['No se pudo actualizar la contraseña. Intente más tarde.'];
    header('Location: ../../views/change-password/index.php');
    exit();
}

?>