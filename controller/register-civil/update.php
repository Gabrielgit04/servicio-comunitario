<?php
session_start();
include '../../models/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    $_SESSION['errors'] = ['Metodo de envio incorrecto'];
    header('Location: ../../views/register-civil/read/index.php');
    exit();
}

$raw = array_map(function($v){ return is_string($v) ? trim($v) : $v; }, $_GET);

$mapFields = [
    "FirstName" => "FirstName",
    "LastName" => "LastName",
    "ID_CI" => "ID_CI",
    "Sex" => "Sex",
    "Phone_Number" => "Phone_Number",
    "Committee_Name" => "Committee_Name",
    "Address_Civil" => "Address_Civil",
    "Birth_Date" => "Birth_Date",
    "Age" => "Age",
    "Email_Address" => "Email_Address",
    "Patria_Card_Code" => "Patria_Card_Code",
    "Patria_Card_Serial" => "Patria_Card_Serial",
    "Voting_Center" => "Voting_Center",
    "Vote_Type" => "Vote_Type",
];

$errors = [];

// Datos recibidos
$idCivil = isset($raw['cedula']) ? preg_replace('/\D/','', $raw['cedula']) : '';
$choiceOption = $_GET['choiceUpdate'] ?? '';  
$updateField = ucwords(isset($raw['UPDATE_FIELD']) ? htmlspecialchars($raw['UPDATE_FIELD']) : '');


$db = conexionDB();
try {

    $campoBD = $mapFields[$choiceOption];

    $update = $db->prepare("UPDATE People_Data SET $campoBD = :fieldUpdate  WHERE ID_CI = :idCivil");
    $update->bindParam(':fieldUpdate', $updateField);
    $update->bindParam(':idCivil', $idCivil, PDO::PARAM_INT);
    $update->execute();

    $_SESSION['mensaje_update'] = true;
    header('Location: ../../views/register-civil/read/index.php');
    exit();
} catch (PDOException $e) {
    error_log('Update error: ' . $e->getMessage());
    $_SESSION['errors'] = ['Error al actualizar el registro.'];
    header('Location: ../../views/register-civil/read/index.php');
    exit();
}