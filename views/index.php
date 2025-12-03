<?php 

session_start();

if(!isset($_SESSION['nombre'])){
    header('Location:../../views/login/index.php');
};

include '../../models/conexion.php';

$proyectos = [];
$error_msg = null;

try {
    $pdo = conexionDB();
    $stmt = $pdo->prepare("SELECT id_project, name_project FROM projects");
    $stmt->execute();
    $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['Ejecutado'])) { $success_msg = htmlspecialchars($_GET['Ejecutado']);
    } 
    elseif (isset($_GET['Error'])) { $error_msg = htmlspecialchars($_GET['Error']);
    }

} catch (PDOException $e) {
    $error_msg = "Error al cargar proyectos: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/sistem project.css">
    <title>Listado de Proyectos</title>
</head>
<body>

    <a href="../main-menu/index.php" class="volver" title="Volver a HOME">
        <img src="../assets/imgs/icons/arrow-left.svg">
    </a>

    <div class="list-option">
        <article class="titulo">
            <figure class="contenedor-flex">
                <a>
                    <img src="../assets/imgs/documento.webp" alt="bandera de venezuela" class="img_proyecto">
                </a>
                <h1 class="texto_titulo">Bienvenido a la Gestión de Proyectos</h1>
            </figure>
        </article>
    </div>

    <?php if (isset($success_msg)): ?>
        <p id="Ejecutado">✅ Éxito: <?php echo $success_msg; ?></p>
    <?php endif; ?>
    <?php if (isset($error_msg)): ?>
        <p id="Error">❌ Error: <?php echo $error_msg; ?></p>
    <?php endif; ?>

    <div>
        <p>
            <a class="btn_create btn-accion" href="./Create Project/index.php">➕ Crear Nuevo Proyecto</a>
            | 
            <a class="btn_recargar btn-accion" href="./index.php">🔄 Recargar Lista</a>
        </p>
    </div>

    <table>

        <thead>
            <tr class="columnas1">
                <th>Nombre del Proyecto</th> 
            </tr>
        </thead>

        <tbody class="columnas2">
            <?php if (!empty($proyectos)): ?>
                <?php foreach ($proyectos as $proyecto): ?>
                    <tr>
                        <td class="columna_name"><?php echo htmlspecialchars($proyecto['name_project']); ?></td>
                        <td class="columna_boton">

                            <a href="./Visualize Project/index.php?id=<?php echo htmlspecialchars($proyecto['id_project']); ?>" class="btn-accion btn-ver"> 👁️ Ver </a> 
                            <a href="./Modify Project/index.php?id=<?php echo htmlspecialchars($proyecto['id_project']); ?>" class="btn-accion btn-editar"> ✏️ Editar </a> 
                            
                            <form action="../../controller/sistem project/eliminate project.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id_project" value="<?php echo htmlspecialchars($proyecto['id_project']); ?>">
                                <button type="submit" 
                                    onclick="return confirm('¿Está seguro de que desea eliminar el proyecto \'<?php echo htmlspecialchars($proyecto['name_project']); ?>\'? Esto es irreversible.');" class="btn-accion btn-eliminar"> ❌ Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay Proyectos.</td>
                </tr>
            <?php endif; ?>
        </tbody>

    </table>

</body>
</html>