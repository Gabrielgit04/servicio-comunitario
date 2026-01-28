<style>
body {
    justify-content: center;
    align-items: center;
    min-width: 600px;
    max-width: 100%;
    margin:  auto;
    padding: 20px; 
    background-color:  rgba(2, 20, 155);
    font-family: 'Poppins', Arial, Helvetica, sans-serif;
    overflow-x: auto; 
    font-weight: bold;
}
    
div{
    justify-content: center;
    align-items: center;
    display: flex;
    flex-direction: column;
    width: 300px;
    height: 350px;  
    margin: 0 auto;
    background-color:  #28a745;
    border-radius: 10px;
}

h1{
    font-size: 50px;
}

p{
    margin: 5px; 
    padding: 10px;        
    text-align: center;
    font-weight: bold;
}
    
a{
    height: 20px;
    padding: 5px;
    border-radius:5px ;
    background-color: blue;
    color: black;
    transition: color 0.3s ease;    
}

a:hover {
    color: #f0f0f0; 
}

</style>
<br><br><br><br><br><br><br>
<div>

<?php

include '../../models/conexion.php';

$id = htmlspecialchars($_POST["Id"]);
$name_project = ucfirst($_POST["Titulo"]);
$fecha_inicio = $_POST["Fecha_inicio"];
$fecha_culminacion = $_POST["Fecha_culminacion"];
$estado = $_POST["Estado"];

$detalles_existentes = $_POST['detalles_existentes'] ?? []; 
$detalles_nuevos = $_POST['detalles_nuevos'] ?? []; 
$detalles_a_eliminar = $_POST['detalles_a_eliminar'] ?? ''; 

if (empty($id)) {
    die("<p style='color: red;'>❌ Error: ID de proyecto no especificado.</p>");
}

$presupuesto = 0.00;

function normalize_price($price_str) {
    $precio_limpio = str_replace(',', '.', $price_str);
    return floatval($precio_limpio);
}

foreach ($detalles_existentes as $detalle) {
    if (!empty(trim($detalle['descripcion']))) {
        $presupuesto += normalize_price($detalle['precio'] ?? '0.00');
    }
}

foreach ($detalles_nuevos as $detalle) {
    if (!empty(trim($detalle['descripcion']))) {
        $presupuesto += normalize_price($detalle['precio'] ?? '0.00');
    }
}

$pdo = conexionDB();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
$pdo->beginTransaction(); 

try {
    
    $query_update_project = $pdo->prepare("UPDATE projects SET 
        name_project = :namep, 
        fecha_inicio_project = :inicio, 
        fecha_final_project = :final, 
        estado_project = :estado, 
        presupuesto_project = :presupuesto 
        WHERE id_project = :id");

    $query_update_project->bindParam(":id", $id);        
    $query_update_project->bindParam(":namep", $name_project);
    $query_update_project->bindParam(":inicio", $fecha_inicio);
    $query_update_project->bindParam(":final", $fecha_culminacion);
    $query_update_project->bindParam(":estado", $estado);
    $query_update_project->bindParam(":presupuesto", $presupuesto);

    $query_update_project->execute(); 
    $updates_realizados = 1;

    $eliminados = 0;
    if (!empty($detalles_a_eliminar)) {
        $ids_eliminar = array_filter(array_map('intval', explode(',', $detalles_a_eliminar)));
        
        if (count($ids_eliminar) > 0) {
            $placeholders = implode(',', array_fill(0, count($ids_eliminar), '?'));
            
            $query_delete_details = $pdo->prepare("DELETE FROM date_projects WHERE id_date_project IN ($placeholders) AND id_project = ?");
            
            $params = array_merge($ids_eliminar, [$id]); 
            
            $query_delete_details->execute($params);
            $eliminados = $query_delete_details->rowCount();
        }
    }

    $actualizados = 0;
    $query_update_details = $pdo->prepare("UPDATE date_projects SET 
        gasto_project = ?, 
        gasto_num_project = ? 
        WHERE id_date_project = ? AND id_project = ?");

    foreach ($detalles_existentes as $detalle) {
        if (!empty(trim($detalle['descripcion']))) {
            $id_detalle = $detalle['id'] ?? null;
            $descripcion = $detalle['descripcion'];
            $precio = normalize_price($detalle['precio'] ?? '0.00');

            if ($id_detalle) {
                $query_update_details->execute([$descripcion, $precio, $id_detalle, $id]);
                $actualizados++;
            }
        }
    }

    $nuevos_registros = 0;
    $query_insert_details = $pdo->prepare("INSERT INTO date_projects (id_project, gasto_project, gasto_num_project) VALUES (?, ?, ?)");
    
    foreach ($detalles_nuevos as $detalle) {
        if (!empty(trim($detalle['descripcion']))) {
            $descripcion = $detalle['descripcion'];
            $precio = normalize_price($detalle['precio'] ?? '0.00');
            
            $query_insert_details->execute([$id, $descripcion, $precio]);
            $nuevos_registros++;
        }
    }


    $pdo->commit(); 

    echo "<h1>👍</h1> <br> <p style='color: whitesmoke;'>El Proyecto $name_project se ha Actualizado</p>";

} catch (PDOException $e) {
    $pdo->rollBack(); 
    echo "<h1>❌</h1> <br> <p style='color: red;'>Error al guardar modificaciones: " . $e->getMessage() . "</p>";
}
?>

    <p><a href="../../views/index.php">Volver a Gestión de Proyectos</a></p>
    <p><a href="../../views/Modify Project/index.php?id=<?php echo htmlspecialchars($id); ?>">Volver a Modificar este Proyecto</a></p>    

</div>