<?php
session_start();
include '../models/conexion.php';

$questOne = htmlspecialchars($_POST['security-question']);
$questTwo = htmlspecialchars($_POST['security-question-2']);
$answerOne = htmlspecialchars($_POST['quest1']);
$answerTwo = htmlspecialchars($_POST['quest2']);

$answerOneHash = password_hash($answerOne, PASSWORD_BCRYPT);
$answerTwoHash = password_hash($answerTwo, PASSWORD_BCRYPT);

$db = conexionDB();

try {
    // Usar directamente el ID de la sesión
    $idUser = $_SESSION['idGlobal'];


    $sql = $db->prepare("INSERT INTO secure_questions(id_user, question1, answer1, question2, answer2)
                    VALUES(:idUserQuest, :oneQuest, :oneAnswer, :twoQuest, :twoAnswer)");

    $sql->bindParam(':idUserQuest', $idUser, PDO::PARAM_INT);
    $sql->bindParam(':oneQuest', $questOne, PDO::PARAM_STR);
    $sql->bindParam(':oneAnswer', $answerOneHash, PDO::PARAM_STR);
    $sql->bindParam(':twoQuest', $questTwo, PDO::PARAM_STR);
    $sql->bindParam(':twoAnswer', $answerTwoHash, PDO::PARAM_STR);
    $sql->execute();

    header("Location: ../../views/login/index.php?success=1");
    exit;
} catch (PDOException $e) {
    header("Location: ../../views/secure-questions/index.php?error=db");
    exit;
}
?>
