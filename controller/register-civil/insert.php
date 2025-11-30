<?php

include '../../models/conexion.php';
session_start();

//definiendo variables, traidas desde el front

$idCivil = filter_var($_POST['cedula'], FILTER_SANITIZE_NUMBER_INT);
$nameCivil = ucwords($_POST['nombre']);
$surnameCivil = ucwords($_POST['apellido']);
$gender = $_POST['sexo'];
$phone = filter_var($_POST['telefono'], FILTER_SANITIZE_NUMBER_INT);
$comitted = ucwords($_POST['comite']);
$address = ucwords($_POST['direccion']);
$dateOfBirth = $_POST['fecha_nacimiento'];
$age = filter_var($_POST['edad'], FILTER_SANITIZE_NUMBER_INT);
$email = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
$codeDni = $_POST['codigo_carnet'];
$serialDni = $_POST['serial_carnet'];
$centerVotation = ucwords($_POST['centro_votacion']);
$voteType = $_POST['tipo_voto'];

$createDate = date('Y-m-d, H:i:s');
//insertando datos en la base de datos  
$db = conexionDB();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $insertQuery = $db->prepare("INSERT INTO People_Data (ID_CI, FirstName, LastName, Sex, Phone_Number, Committee_Name, Address_Civil, Birth_Date, Age, Email_Address, Patria_Card_Code, Patria_Card_Serial, Voting_Center, Vote_Type,Create_Date)
                                    VALUES (:idCivil, :nameCivil, :surnameCivil, :gender, :phone, :comitted, :addressCivil, :dateOfBirth, :age, :email, :codeDni, :serialDni, :centerVotation, :voteType, :createDate)");
        $insertQuery->bindParam(':idCivil', $idCivil);
        $insertQuery->bindParam(':nameCivil', $nameCivil);
        $insertQuery->bindParam(':surnameCivil', $surnameCivil);
        $insertQuery->bindParam(':gender', $gender);
        $insertQuery->bindParam(':phone', $phone);
        $insertQuery->bindParam(':comitted', $comitted);
        $insertQuery->bindParam(':addressCivil', $address);
        $insertQuery->bindParam(':dateOfBirth', $dateOfBirth);
        $insertQuery->bindParam(':age', $age);
        $insertQuery->bindParam(':email', $email);
        $insertQuery->bindParam(':codeDni', $codeDni);
        $insertQuery->bindParam(':serialDni', $serialDni);
        $insertQuery->bindParam(':centerVotation', $centerVotation);
        $insertQuery->bindParam(':voteType', $voteType);
        $insertQuery->bindParam(':createDate', $createDate);
        $insertQuery->execute();

        if(isset($insertQuery)){
            $_SESSION['mensaje'] = true;
        }

        header("Location: ../../views/register-civil/form-register/index.php?mensaje=Inserción exitosa.&tipo=success");
        exit();

    } catch (PDOException $e) {
        echo "Error en la inserción: " . $e->getMessage();
    }
}
?>