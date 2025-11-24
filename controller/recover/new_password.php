<?php
session_start();
include '../../models/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newPassword = $_POST['new_password'];
    $repeatPassword = $_POST['rep_password'];

    if ($newPassword === $repeatPassword) {
        try {
            $userID= $_SESSION['id_user']; 
            $dbConnect = conexionDB();

            $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);

            $sql = $dbConnect->prepare('UPDATE users_admins SET contrasena = :hashNewPassword WHERE id = :id');
            $sql->bindParam(':hashNewPassword', $newPasswordHash);
            $sql->bindParam(':id', $userId, PDO::PARAM_INT);
            $sql->execute();

            header('Location: ../../views/login/index.php');
            exit;
        } catch (PDOException $e) {
            header("Location: ../../views/change-password/index.php");
            exit;
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden.'); window.location.href='../../views/change-password/index.php';</script>";
    }
}
?>