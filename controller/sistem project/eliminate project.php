<?php
include '../../models/conexion.php';

if (!isset($_POST['id_project']) || empty($_POST['id_project'])) {
    header("Location: ../../views/sistem project/index.php?error=no_id");
    exit();
}

$id_project = htmlspecialchars($_POST['id_project']);
$pdo = conexionDB();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$pdo->beginTransaction();

try {
    $query_delete_details = $pdo->prepare("DELETE FROM date_projects WHERE id_project = ?");
    $query_delete_details->execute([$id_project]);
    $detalles_eliminados = $query_delete_details->rowCount();

    $query_delete_project = $pdo->prepare("DELETE FROM projects WHERE id_project = ?");
    $query_delete_project->execute([$id_project]);
    $proyectos_eliminados = $query_delete_project->rowCount();

    if ($proyectos_eliminados > 0) {
        $pdo->commit(); 
        $mensaje = "👍 ¡Éxito! El proyecto **$id_project** fue eliminado, junto con $detalles_eliminados detalles.";
        header("Location: ../../views/sistem project/index.php?success=" . urlencode($mensaje));
    } else {
        $pdo->rollBack();
        $mensaje = "⚠️ Error: El proyecto con ID **$id_project** no fue encontrado para eliminar.";
        header("Location: ../../views/sistem project/index.php?error=" . urlencode($mensaje));
    }


} catch (PDOException $e) {
    $pdo->rollBack(); 
    $mensaje = "❌ Error al eliminar el proyecto: " . $e->getMessage();
    header("Location: ../../views/sistem project/index.php?error=" . urlencode($mensaje));
}

exit();