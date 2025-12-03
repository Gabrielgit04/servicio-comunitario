<?php

include '../../models/conexion.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("❌ Error: No se proporcionó ID de proyecto para visualizar.");
}

$id_project = htmlspecialchars($_GET['id']);
$proyecto = null;
$detalles = [];

try {
    $pdo = conexionDB();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt_project = $pdo->prepare("SELECT * FROM projects WHERE id_project = ?");
    $stmt_project->execute([$id_project]);
    $proyecto = $stmt_project->fetch(PDO::FETCH_ASSOC);

    if (!$proyecto) {
        die("❌ Error: Proyecto con ID '$id_project' no encontrado.");
    }

    $stmt_details = $pdo->prepare("SELECT * FROM date_projects WHERE id_project = ?");
    $stmt_details->execute([$id_project]);
    $detalles = $stmt_details->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("❌ Error de Base de Datos al cargar datos: " . $e->getMessage());
}

function format_date($date) {
    return date('d/m/Y', strtotime($date));
}

$max_length = 150;
$project_name = $proyecto['name_project'];

$short_name = (mb_strlen($project_name, 'UTF-8') > $max_length)
    ? mb_substr($project_name, 0, $max_length, 'UTF-8') . '...'
    : $project_name;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/visualize project.css"> 
    <title>Detalles del Proyecto: <?php echo $proyecto['name_project']; ?></title>

</head>
<body>

    <a href="../index.php" class="volver" title="Volver">
        <img src="../assets/imgs/icons/arrow-left.svg" alt="Descripción de la imagen">
    </a>

    <br>

    <h1>Titulo: <?php echo htmlspecialchars($short_name); ?></h1>

    <div class="info-box">
        <p><strong>Estado Actual:</strong> <?php echo str_replace('_', ' ', $proyecto['estado_project']); ?></p>
        <p><strong>Fecha de Inicio:</strong> <?php echo format_date($proyecto['fecha_inicio_project']); ?></p>
        <p><strong>Fecha de Culminación:</strong> <?php echo format_date($proyecto['fecha_final_project']); ?></p>
    </div>

    <hr>

    <h2>Lista de Gastos</h2>
    
    <?php if (count($detalles) > 0): ?>
        <table class="detalle-tabla">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Descripción del Gasto</th>
                    <th>Monto (Presupuesto)</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ($detalles as $detalle): ?>
                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo htmlspecialchars($detalle['gasto_project']); ?></td>
                        <td><?php echo number_format($detalle['gasto_num_project'], 2, '.', ','); ?> Bs</td>
                    </tr>

                <?php endforeach; ?>
            </tbody>
            
        </table>
    
    <div class="total-box">
        <a class="total">Total Presupuestado: <span id="total_suma"><?php echo number_format($proyecto['presupuesto_project'], 2, '.', ','); ?></span> Bs</a> 
    </div>


    <?php else: ?>
        <p>El proyecto no tiene gastos o entradas de presupuesto registradas.</p>
    <?php endif; ?>

    <hr>

</body>
</html>