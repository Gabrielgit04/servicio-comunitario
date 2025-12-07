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
$name_project = htmlspecialchars(ucfirst($_POST["Titulo"]));
$fecha_inicio = $_POST["Fecha_inicio"];
$fecha_culminacion = $_POST["Fecha_culminacion"];
$estado = $_POST["Estado"];
$descripciones = $_POST['descripciones'];
$precios = $_POST['precios'];

$registrosGuardados = 0;
$presupuesto = 0.00;

if (is_array($descripciones)) {
    foreach ($descripciones as $indice => $descripcion) {
        $precio_str = isset($precios[$indice]) ? $precios[$indice] : '0.00';
        $precio_limpio = str_replace(',', '.', $precio_str);
        $precio_item = floatval($precio_limpio); 
        if (!empty(trim($descripcion))) {
            $presupuesto += $precio_item;
        }
    }
}

if (is_array($descripciones) && count($descripciones) > 0) {

    $pdo = conexionDB();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    $pdo->beginTransaction(); 
    
    try {
        $query_details_sql = "INSERT INTO date_projects (id_project, gasto_project, gasto_num_project) VALUES (?, ?, ?)";
        $stmt_details = $pdo->prepare($query_details_sql); 
        
        $query_project = $pdo->prepare("INSERT INTO projects (id_project, name_project, fecha_inicio_project, fecha_final_project, estado_project, presupuesto_project) VALUES (:id, :namep, :inicio, :final, :estado, :presupuesto)");

        $query_project->bindParam(":id", $id);        
        $query_project->bindParam(":namep", $name_project);
        $query_project->bindParam(":inicio", $fecha_inicio);
        $query_project->bindParam(":final", $fecha_culminacion);
        $query_project->bindParam(":estado", $estado);
        $query_project->bindParam(":presupuesto", $presupuesto);

        $query_project->execute(); 
        
        foreach ($descripciones as $indice => $descripcion) {
            
            $precio_str = isset($precios[$indice]) ? $precios[$indice] : '0.00';
            $precio_limpio = str_replace(',', '.', $precio_str);
            $precio_item = floatval($precio_limpio); 

            if (!empty(trim($descripcion))) {
                $stmt_details->execute([$id, $descripcion, $precio_item]);
                $registrosGuardados++;
            }
        }

        $pdo->commit(); 

        echo "<h1>👍</h1> <br> <p class='mensaje' style='color: white;'>Se ha Guardado el Proyecto Correctamente.</p>";

    } catch (PDOException $e) {
        $pdo->rollBack(); 
        echo "<h1>❌</h1> <br> <p class='mensaje' style='color: red;'> Error al guardar datos: " . $e->getMessage() . "</p>";
    }

} else {
    echo "<h1>⚠️</h1> <br> <p> No se recibieron datos válidos para procesar.</p>";
}

?>

    <p><a href="../../views/index.php">Volver a Gestión de Proyectos</a></p>
        
</div>