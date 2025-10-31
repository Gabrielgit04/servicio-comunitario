<?php
include '../models/conexion.php';
session_start();

$emailUser = $_POST['email_log'];
$passUser = $_POST['passw_log'];

$db = conexionDB();

try{
    $sqlQuery = $db -> prepare("SELECT * FROM users_admins WHERE correo = :userEmail AND contrasena = :userPassword");

    $sqlQuery->bindParam('userEmail',$emailUser);

    $sqlQuery->execute();
    $result=$sqlQuery->fetchAll(PDO::FETCH_ASSOC);
    

    if(password_verify($passUser,$result['contrasena'])){
        echo"<script>alert('Usuario encontrado. Bienvenido.')</script>";
    }else{
        echo"<script>alert('Contraseña incorrecta.')</script>";
    }
}catch(PDOException $e){
    echo"<script>alert('No se pudo iniciar la sesion, por favor, intente de nuevo.')</script>";
}




?>