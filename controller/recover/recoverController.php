<?php
session_start();

include '../../models/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../../views/recover-password/index.php');
    exit();
}

$question = isset($_POST['answer']) ? trim($_POST['answer']) : '';
$questionTwo = isset($_POST['answer-2']) ? trim($_POST['answer-2']) : '';

$errors = [];
if ($question === '' || $questionTwo === '') {
    $errors[] = 'Debe responder ambas preguntas.';
}

if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: ../../views/recover-password/index.php');
    exit();
}

$dbConnect = conexionDB();

try {
    $idRecover = isset($_SESSION['id']) ? $_SESSION['id'] : null;
    if (!$idRecover) {
        $_SESSION['errors'] = ['Identificación no encontrada. Inicio el proceso nuevamente.'];
        header('Location: ../../views/auth-identification/index.php');
        exit();
    }

    $stmt = $dbConnect->prepare('SELECT * FROM secure_questions WHERE id_user = :ci');
    $stmt->bindParam(':ci', $idRecover, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['errors'] = ['No se encontraron preguntas de seguridad para este usuario.'];
        header('Location: ../../views/auth-identification/index.php');
        exit();
    }

    $_SESSION['id_user'] = $user['id_user'];

    if (password_verify($question, $user['answer1']) && password_verify($questionTwo, $user['answer2'])) {
        header('Location:../../views/change-password/index.php');
        exit();
    } else {
        $_SESSION['errors'] = ['Respuestas incorrectas. Inténtalo de nuevo.'];
        header('Location: ../../views/recover-password/index.php');
        exit();
    }

} catch (PDOException $e) {
    error_log('Recover error: ' . $e->getMessage());
    $_SESSION['errors'] = ['Error en la consulta. Intente más tarde.'];
    header('Location: ../../views/recover-password/index.php');
    exit();
}

?>