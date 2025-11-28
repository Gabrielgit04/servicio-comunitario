<?php
include '../../models/conexion.php';


if($_SERVER['REQUEST_METHOD']=='POST'){

    $search = ucwords($_POST['search']);
    $db = conexionDB();
    

    try{
        if(!empty($search)){
        $query = $db -> prepare("SELECT * FROM People_Data WHERE FirstName LIKE :search OR ID_CI = :id OR LastName LIKE :search LIMIT 100");
        $reference ="%$search%";
        $idRef = is_numeric($search) ? (int)$search : 0;
        $query->bindParam(':search',$reference,PDO::PARAM_STR);
        $query->bindParam(':id',$idRef,PDO::PARAM_INT);
        $query->execute();

        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['search']= $fetch;
        header('Location:../../views/register-civil/read/index.php');

}

// Soporte para búsquedas via AJAX (GET) -> devuelve JSON
if($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['q'])){
    $search = trim($_GET['q']);
    $db = conexionDB();
    try{
        $query = $db -> prepare("SELECT * FROM People_Data WHERE FirstName LIKE :search OR ID_CI = :id OR LastName LIKE :search LIMIT 100");
        $reference = "%$search%";
        $idRef = is_numeric($search) ? (int)$search : 0;
        $query->bindParam(':search',$reference,PDO::PARAM_STR);
        $query->bindParam(':id',$idRef,PDO::PARAM_INT);
        $query->execute();
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($fetch);
        exit;
    }catch(PDOException $error){
        header('Content-Type: application/json; charset=utf-8', true, 500);
        echo json_encode(['error' => $error->getMessage()]);
        exit;
    }
}
    }catch(PDOException $error){
        echo '<pre>Error' . $error->getMessage() . '</pre>';
    }
}

?>