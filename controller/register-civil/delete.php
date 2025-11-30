<?php

include '../../models/conexion.php';

if (isset($_GET['cedula'])) {
    $idUserEliminated  = filter_var($_GET['cedula'],FILTER_SANITIZE_NUMBER_INT);

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $db = conexionDB();

        try{
            $query = $db->prepare('DELETE FROM People_Data WHERE ID_CI = :idUser');
            $query->bindParam(':idUser',$idUserEliminated,PDO::PARAM_INT);
            $query->execute();

            if(isset($query)){
                $_SESSION['delete'] = true;
            }
            header("Location:../../views/register-civil/read/index.php");
            exit();
        }catch(PDOException $e){
            echo $e->getMessage();
            exit();
        }
    }

}else{
    echo "<script>alert('No se pudo obterner la cedula')</script>";
}

?>