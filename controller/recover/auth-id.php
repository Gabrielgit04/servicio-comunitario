<?php
session_start();
include '../../models/conexion.php';

$idCi = $_POST['ci_quest'];

$db = conexionDB();

try{
    $sqlQueryId = $db->prepare("SELECT * FROM secure_questions WHERE id_user = :idDni");
    $sqlQueryId->bindParam(':idDni', $idCi, PDO::PARAM_STR);
    $sqlQueryId->execute();

    $resultId = $sqlQueryId->fetch(PDO::FETCH_ASSOC);

    if ($resultId) {
        // Si existe la cédula en la tabla, la guardamos en sesión
        $_SESSION['id']=$idCi;

        // variables globales de preguntas guardadas en sesion
        $_SESSION['q1']=$resultId['question1'];
        $_SESSION['q2']=$resultId['question2'];

        // Redirigimos a las preguntas de seguridad
        header('Location:../../views/recover-password/index.php');
        exit;
    } else {
        // Si no existe, redirigimos a error o identificación
        header('Location:../../views/auth-identification/index.php');
        exit;
    }

} catch (PDOException $e) {
    header('Location:../../views/auth-identification/index.php');
    exit;
}
?>