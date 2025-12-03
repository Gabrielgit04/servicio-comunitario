<?php

include '../models/conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../views/register/index.php');
    exit();
}

$errors = [];

$raw = array_map(function($v){ return is_string($v) ? trim($v) : $v; }, $_POST);

$id = isset($raw['id']) ? preg_replace('/\D/', '', $raw['id']) : '';
$name = isset($raw['nombre']) ? ucwords(htmlspecialchars($raw['nombre'])) : '';
$correo = isset($raw['email']) ? filter_var($raw['email'], FILTER_SANITIZE_EMAIL) : '';
$passw = isset($raw['passw']) ? $raw['passw'] : '';
$rol = isset($raw['rol']) ? preg_replace('/[^A-Za-z0-9_\-]/', '', $raw['rol']) : '';

// Validaciones básicas
if ($id === '' || !preg_match('/^[0-9]{6,10}$/', $id)) {
    $errors[] = 'Cédula inválida.';
}
if ($name === '' || !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-]{2,80}$/', $name)) {
    $errors[] = 'Nombre inválido.';
}
if ($correo === '' || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Correo inválido.';
}
if ($passw === '' || strlen($passw) < 8) {
    $errors[] = 'La contraseña debe tener al menos 8 caracteres.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../../views/register/index.php');
    exit();
}

$password_hash = password_hash($passw, PASSWORD_BCRYPT);

$db = conexionDB();

try {
    $query = $db->prepare("INSERT INTO users_admins(ci,nombre_completo,correo,contrasena,rol) VALUES(:id,:name_user,:correo,:passw,:rol)");
    $query->bindParam(':id', $id);
    $query->bindParam(':name_user', $name);
    $query->bindParam(':correo', $correo);
    $query->bindParam(':passw', $password_hash);
    $query->bindParam(':rol', $rol);

    $query->execute();
    $_SESSION['idGlobal'] = $id;
    header('Location: ../../views/secure-questions/index.php');
    exit();
} catch (PDOException $e) {
    error_log('Register error: ' . $e->getMessage());
    $_SESSION['errors'] = ['No se pudo registrar el usuario.'];
    header('Location: ../../views/register/index.php');
    exit();
}




?>