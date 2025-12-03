<?php

include '../../models/conexion.php';
session_start();
// sólo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}

$errors = [];

// Sanitize raw inputs
$raw = array_map(function($v){ return is_string($v) ? trim($v) : $v; }, $_POST);

$idCivil = isset($raw['cedula']) ? preg_replace('/\D/','', $raw['cedula']) : '';
$nameCivil = isset($raw['nombre']) ? ucwords(htmlspecialchars($raw['nombre'])) : '';
$surnameCivil = isset($raw['apellido']) ? ucwords(htmlspecialchars($raw['apellido'])) : '';
$gender = isset($raw['sexo']) ? $raw['sexo'] : '';
$phone = isset($raw['telefono']) ? preg_replace('/[^0-9+]/','', $raw['telefono']) : '';
$comitted = isset($raw['comite']) ? ucwords(htmlspecialchars($raw['comite'])) : '';
$address = isset($raw['direccion']) ? ucwords(htmlspecialchars($raw['direccion'])) : '';
$dateOfBirth = isset($raw['fecha_nacimiento']) ? $raw['fecha_nacimiento'] : '';
$age = isset($raw['edad']) ? (int)$raw['edad'] : null;
$email = isset($raw['correo']) ? filter_var($raw['correo'], FILTER_SANITIZE_EMAIL) : '';
$codeDni = isset($raw['codigo_carnet']) ? htmlspecialchars($raw['codigo_carnet']) : '';
$serialDni = isset($raw['serial_carnet']) ? htmlspecialchars($raw['serial_carnet']) : '';
$centerVotation = isset($raw['centro_votacion']) ? ucwords(htmlspecialchars($raw['centro_votacion'])) : '';
$voteType = isset($raw['tipo_voto']) ? htmlspecialchars($raw['tipo_voto']) : '';

$createDate = date('Y-m-d H:i:s');

// Validaciones
if ($idCivil === '' || !preg_match('/^[0-9]{6,10}$/', $idCivil)) {
    $errors[] = 'Cédula inválida (6-10 dígitos).';
}
if ($nameCivil === '' || !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-]{2,50}$/', $nameCivil)) {
    $errors[] = 'Nombre inválido.';
}
if ($surnameCivil === '' || !preg_match('/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-]{2,50}$/', $surnameCivil)) {
    $errors[] = 'Apellido inválido.';
}
if (!in_array($gender, ['Masculino','Femenino'])) {
    $errors[] = 'Género inválido.';
}
if ($phone !== '' && !preg_match('/^\+?[0-9]{7,15}$/', $phone)) {
    $errors[] = 'Teléfono inválido.';
}
if ($comitted === '' || strlen($comitted) < 2) {
    $errors[] = 'Comité inválido.';
}
if ($address === '' || strlen($address) < 5) {
    $errors[] = 'Dirección inválida.';
}
if ($dateOfBirth === '' || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateOfBirth) || strtotime($dateOfBirth) === false) {
    $errors[] = 'Fecha de nacimiento inválida.';
}
if ($age === null || $age < 0 || $age > 120) {
    $errors[] = 'Edad inválida.';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Correo inválido.';
}

// stop on errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../../views/register-civil/form-register/index.php');
    exit();
}

// DB and insert
$db = conexionDB();
try {
    // evitar duplicados por cedula
    $check = $db->prepare('SELECT COUNT(*) FROM People_Data WHERE ID_CI = :id');
    $check->bindParam(':id', $idCivil, PDO::PARAM_INT);
    $check->execute();
    if ($check->fetchColumn() > 0) {
        $_SESSION['errors'] = ['Ya existe un registro con esa cédula.'];
        header('Location: ../../views/register-civil/form-register/index.php');
        exit();
    }

    $insertQuery = $db->prepare("INSERT INTO People_Data (ID_CI, FirstName, LastName, Sex, Phone_Number, Committee_Name, Address_Civil, Birth_Date, Age, Email_Address, Patria_Card_Code, Patria_Card_Serial, Voting_Center, Vote_Type, Create_Date)
                                VALUES (:idCivil, :nameCivil, :surnameCivil, :gender, :phone, :comitted, :addressCivil, :dateOfBirth, :age, :email, :codeDni, :serialDni, :centerVotation, :voteType, :createDate)");
    $insertQuery->bindParam(':idCivil', $idCivil);
    $insertQuery->bindParam(':nameCivil', $nameCivil);
    $insertQuery->bindParam(':surnameCivil', $surnameCivil);
    $insertQuery->bindParam(':gender', $gender);
    $insertQuery->bindParam(':phone', $phone);
    $insertQuery->bindParam(':comitted', $comitted);
    $insertQuery->bindParam(':addressCivil', $address);
    $insertQuery->bindParam(':dateOfBirth', $dateOfBirth);
    $insertQuery->bindParam(':age', $age, PDO::PARAM_INT);
    $insertQuery->bindParam(':email', $email);
    $insertQuery->bindParam(':codeDni', $codeDni);
    $insertQuery->bindParam(':serialDni', $serialDni);
    $insertQuery->bindParam(':centerVotation', $centerVotation);
    $insertQuery->bindParam(':voteType', $voteType);
    $insertQuery->bindParam(':createDate', $createDate);
    $insertQuery->execute();

    $_SESSION['mensaje'] = true;
    header("Location: ../../views/register-civil/form-register/index.php?mensaje=Inserción exitosa.&tipo=success");
    exit();
} catch (PDOException $e) {
    // log error in production; show minimal message here
    error_log('Insert error: ' . $e->getMessage());
    $_SESSION['errors'] = ['Error al insertar el registro.'];
    header('Location: ../../views/register-civil/form-register/index.php');
    exit();
}
?>