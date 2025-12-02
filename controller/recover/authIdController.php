<?php
session_start();
include '../../models/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location:../../views/auth-identification/index.php');
    exit();
}

$idCi = isset($_POST['ci_quest']) ? preg_replace('/\D/', '', $_POST['ci_quest']) : '';

if ($idCi === '' || !preg_match('/^[0-9]{6,10}$/', $idCi)) {
    $_SESSION['errors'] = ['Cédula inválida.'];
    header('Location:../../views/auth-identification/index.php');
    exit();
}

$db = conexionDB();

try {
    $sqlQueryId = $db->prepare('SELECT * FROM secure_questions WHERE id_user = :idDni');
    $sqlQueryId->bindParam(':idDni', $idCi, PDO::PARAM_INT);
    $sqlQueryId->execute();

    $resultId = $sqlQueryId->fetch(PDO::FETCH_ASSOC);

    if ($resultId) {
        $_SESSION['id'] = $idCi;
        $_SESSION['q1'] = $resultId['question1'];
        $_SESSION['q2'] = $resultId['question2'];
        header('Location:../../views/recover-password/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['No se encontró la cédula.'];
        header('Location:../../views/auth-identification/index.php');
        exit();
    }

} catch (PDOException $e) {
    error_log('AuthId error: ' . $e->getMessage());
    $_SESSION['errors'] = ['Error en el servidor.'];
    header('Location:../../views/auth-identification/index.php');
    exit();
}
?>