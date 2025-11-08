<?php

include '../models/conexion.php';

$idUserQuest = $_POST['ci_quest'];
$questOne = $_POST['security-question'];
$questTwo = $_POST['security-question-2'];
$answerOne = $_POST['quest1'];
$answerTwo= $_POST['quest2'];

$db = conexionDB();
try{
    $sql = $db ->prepare("INSERT INTO secure_questions(id_user,question1,answer1,question2,answer2)VALUES(:userID,:oneQuest,:oneAnswer,:twoQuest,:twoAnswer)");

    $sql->bindParam(':userID',$idUserQuest);
    $sql->bindParam(':oneQuest',$questOne);
    $sql->bindParam(':oneAnswer',$answerOne);
    $sql->bindParam(':twoQuest',$questTwo);
    $sql->bindParam(':twoAnswer',$answerTwo);
    $sql->execute();

    echo"<div class'box-success'><h3>Tus respuestas se han registrado correctamente.</h3></div>";


}catch(PDOException $e){
    echo"<script>alert('No se registraron las respuestas..')</script>";

}








?>