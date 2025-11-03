<?php

include '../models/conexion.php';

$idUserQuest = $_POST['ci_quest'];
$questOne = $_POST['quest1'];
$questTwo= $_POST['quest2'];

$db = conexionDB();
try{
    $sql = $db ->prepare("INSERT INTO secure_questions(id_user,answer1,answer2)VALUES(:userID,:oneQuest,:twoQuest)");

    $sql->bindParam(':userID',$idUserQuest);
    $sql->bindParam(':oneQuest',$questOne);
    $sql->bindParam(':twoQuest',$questTwo);
    $sql->execute();
    echo"<script>alert('Se registraron las respuestas correctamente.')</script>";


}catch(PDOException $e){
    echo"<script>alert('No se registraron las respuestas..')</script>";

}








?>