<?php 
session_start();

include '../../models/conexion.php';

$question = htmlspecialchars($_POST['answer']);
$questionTwo = htmlspecialchars($_POST['answer-2']);

$questHash = password_hash($question, PASSWORD_BCRYPT);
$questTwoHash = password_hash($questionTwo, PASSWORD_BCRYPT);

$dbConnect = conexionDB();

try{

    $idRecover = $_SESSION['id'];

    $stmt = $dbConnect->prepare("SELECT * FROM secure_questions WHERE id_user = :ci");
    $stmt->bindParam(':ci', $idRecover, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['id_user'] = $user['id_user'];

    if(password_verify($question, $user['answer1']) && password_verify($questionTwo, $user['answer2'])) {
        header('Location:../../views/change-password/index.php');
    } else {
        echo "<script>alert('Respuestas incorrectas. Inténtalo de nuevo.'); window.location.href='../../views/recover-password/index.php';</script>";
    }

} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
    exit();
}

?>