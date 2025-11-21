<?php
include '../models/conexion.php';
session_start();

$emailUser = $_POST['email_log'];
$passUser = $_POST['passw_log'];

$db = conexionDB();

try{
    $sqlQuery = $db -> prepare("SELECT * FROM users_admins WHERE correo = :userEmail");

    $sqlQuery->bindParam('userEmail',$emailUser);

    $sqlQuery->execute();
    
    $result=$sqlQuery->fetch(PDO::FETCH_ASSOC);

    if($result){
        $_SESSION['nombre'] = $result['nombre_completo'];
        $_SESSION['correo'] = $result['correo'];
    }
    

    if(password_verify($passUser,$result['contrasena'])){
        echo"<script>alert('Usuario encontrado. Bienvenido.')</script>";
        header('Location: ../../views/main-menu/index.php');
    }else{
        echo"<script>alert('Contraseña incorrecta.')</script>";
    }
}catch(PDOException $e){
    echo"<script>alert('No se pudo iniciar la sesion, por favor, intente de nuevo.')</script>";
}




?>