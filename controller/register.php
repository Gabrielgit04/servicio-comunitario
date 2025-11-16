<?php

include '../models/conexion.php';

//definiendo variables, traidas desde el front

$id = $_POST['id'];
$name=htmlspecialchars(ucfirst($_POST['nombre']));
$correo=htmlspecialchars($_POST['email']);
$passw=$_POST['passw'];
$rol=htmlspecialchars($_POST['rol']);


$password_hash = password_hash($passw,PASSWORD_BCRYPT);

//ejecutando try and catch con las querys de sql

$db = conexionDB();

try{
    $query = $db->prepare("INSERT INTO users_admins(ci,nombre_completo,correo,contrasena,rol) VALUES(:id,:name_user,:correo,:passw,:rol)");

    $query->bindParam(':id',$id);
    $query->bindParam(':name_user',$name);
    $query->bindParam(':correo',$correo);
    $query->bindParam(':passw',$password_hash);
    $query->bindParam(':rol',$rol);

    $query->execute();

    echo "<script>alert('Usuario registrado correctamente.')</script>";
    header('Location: ../views/secure_questions.php');
}   
catch(PDOException $e){
    echo "<script>alert('El usuario no fue registrado.')</script>";

}




?>