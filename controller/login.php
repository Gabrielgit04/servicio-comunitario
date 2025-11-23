<?php
include '../models/conexion.php';
include '../views/login/index.php';
session_start();

$emailUser = $_POST['email_log'];
$passUser = $_POST['passw_log'];

$db = conexionDB();

try{
    $sqlQuery = $db -> prepare("SELECT * FROM users_admins WHERE correo = :userEmail");

    $sqlQuery->bindParam('userEmail',$emailUser);

    $sqlQuery->execute();
    
    $result=$sqlQuery->fetch(PDO::FETCH_ASSOC);    

    if ($result && password_verify($passUser, $result['contrasena'])) {
        $_SESSION['nombre'] = $result['nombre_completo'];
        $_SESSION['correo'] = $result['correo'];
        $_SESSION['Logueado'] = true;

        unset($_SESSION['error']);

    

        // Primera vez: mostrar mensaje en login
            header("Location: ../../views/login/index.php");
            exit();
        }
    else {
        $_SESSION['error'] = 'Usuario o contraseña incorrecta';
        header("Location: ../../views/login/index.php");
        exit();
    }}catch(PDOException $e){
    echo"<script>alert('No se pudo iniciar la sesion, por favor, intente de nuevo.')</script>";
}




?>