<?php

include '../../models/conexion.php';
session_start();

// sólo aceptar POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Método no permitido');
}

$errors = [];

// Sanitizar entradas

$idCivil       = filter_var($_POST["cedula"],FILTER_SANITIZE_NUMBER_INT);
$nameCivil     = ucwords($_POST['nombre']);
$surnameCivil  = ucwords($_POST['apellido']);
$gender        = ucfirst($_POST['sexo']);
$phone         = filter_var($_POST["telefono"],FILTER_SANITIZE_NUMBER_INT);
$comitted      = ucwords($_POST['comite']);
$address       = ucwords($_POST['direccion']);
$dateOfBirth   = $_POST['fecha_nacimiento'];
$email         = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$codeDni       = $_POST['codigo_carnet'];
$serialDni     = $_POST['serial_carnet'];
$centerVotation= ucwords($_POST['centro_votacion']);
$voteType      = ucwords($_POST['tipo_voto']);

$createDate    = date('Y-m-d H:i:s');

function ageToday($dateOfBirth){
    $newAge = new DateTime($dateOfBirth);
    $today = new DateTime();
    
    $diff = $newAge->diff($today);
    return $diff->y;
}
$today = ageToday($dateOfBirth); #if(!empty($today)){ $_SESSION['errores'] = ["La edad no puede ser verificada"];}
// DB e inserción
$db = conexionDB();
try {
    $insertQuery = $db->prepare("INSERT INTO People_Data (ID_CI, FirstName, LastName, Sex, Phone_Number, Committee_Name, Address_Civil, Birth_Date, Age, Email_Address, Patria_Card_Code, Patria_Card_Serial, Voting_Center, Vote_Type)
        VALUES (:idCivil, :nameCivil, :surnameCivil, :gender, :phone, :comitted, :addressCivil, :dateOfBirth, :age, :email, :codeDni, :serialDni, :centerVotation, :voteType)");

    $insertQuery->bindParam(':idCivil', $idCivil);
    $insertQuery->bindParam(':nameCivil', $nameCivil);
    $insertQuery->bindParam(':surnameCivil', $surnameCivil);
    $insertQuery->bindParam(':gender', $gender);
    $insertQuery->bindParam(':phone', $phone);
    $insertQuery->bindParam(':comitted', $comitted);
    $insertQuery->bindParam(':addressCivil', $address);
    $insertQuery->bindParam(':dateOfBirth', $dateOfBirth);
    $insertQuery->bindParam(':age', $today, PDO::PARAM_INT);
    $insertQuery->bindParam(':email', $email);
    $insertQuery->bindParam(':codeDni', $codeDni);
    $insertQuery->bindParam(':serialDni', $serialDni);
    $insertQuery->bindParam(':centerVotation', $centerVotation);
    $insertQuery->bindParam(':voteType', $voteType);
    $insertQuery->execute();

    $_SESSION['mensaje'] = true;
    header("Location: ../../views/register-civil/form-register/index.php?mensaje=Inserción exitosa.&tipo=success");
    exit();
} catch (PDOException $e) {
    error_log('Insert error: ' . $e->getMessage());
    $_SESSION['errores'] = ['Error al insertar el registro.'];
    header('Location: ../../views/register-civil/form-register/index.php');
    exit();
}
?>
