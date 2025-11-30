<?php
include '../../../models/conexion.php';
session_start();

if (!isset($_SESSION['correo'])) {
    header('Location:../../login/index.php');
};

if (isset($_SESSION['delete']) && $_SESSION['delete'] == true) {
        $mensaje = 'El ciudadano ha sido eliminado correctamente';
        unset($_SESSION['delete']);
}


$db = conexionDB();

if (!empty($_SESSION['search'])) {
    $civiles = $_SESSION['search'];
    unset($_SESSION['search']);
} else {
    if (!empty($db)) {
        $sql = $db->prepare('SELECT * FROM People_Data');
        $sql->execute();
        $civiles = $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/rud.css">
    <title>Civiles registrados</title>
</head>

<body>
    <header class="header-registradas">
        <?php if(!empty($mensaje)): ?>
            <article id="messageDel">
                <p><?php echo $mensaje ?></p>
            </article>
            <script>
                setTimeout(() => {
                    let messageDelete = document.getElementById('messageDel');
                    messageDelete.style.display = 'none'
                }, 5000);
            </script>
        <?php endif; ?>



        <h2>Personas registradas en la comunidad</h2>
        <span class="span-search">
            <form action="../../../controller/register-civil/search.php" autocomplete="off" method="POST">
                <button id="btnSearch"><img src="../../assets/imgs/icons/search.svg" alt="search"></button>
                <input type="search" name="search" class="search" id="search" placeholder="Buscar por Nombre | Apellido | Cedula" style="text-transform: capitalize; " required>
            </form>
        </span>
    </header>
    <section class="read-all-cont">



        <div class="table-container" readonly>
            <table>
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Género</th>
                        <th>Teléfono</th>
                        <th>Comité</th>
                        <th>Direccion</th>
                        <th>Fecha de nacimiento</th>
                        <th>Edad</th>
                        <th>Email</th>
                        <th>Codigo del carnet de la patria</th>
                        <th>Serial del carnet de la patria</th>
                        <th>Centro de votacion</th>
                        <th>Tipo de voto</th>
                        <th>Creado en</th>
                        <th>Actualizado en</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se insertarán las filas de datos dinámicamente -->
                    <?php if (is_array($civiles)): ?>
                        <?php foreach ($civiles as $civil): ?>
                            <tr>
                                <td><?php echo $civil['ID_CI'] ?></td>
                                <td><?php echo htmlspecialchars($civil['FirstName']) ?></td>
                                <td><?php echo htmlspecialchars($civil['LastName']) ?></td>
                                <td><?php echo htmlspecialchars($civil['Sex']) ?></td>
                                <td><?php echo $civil['Phone_Number'] ?></td>
                                <td><?php echo htmlspecialchars($civil['Committee_Name']) ?></td>
                                <td><?php echo htmlspecialchars($civil['Address_Civil']) ?></td>
                                <td><?php echo $civil['Birth_Date'] ?></td>
                                <td><?php echo $civil['Age'] ?></td>
                                <td><?php echo htmlspecialchars($civil['Email_Address']) ?></td>
                                <td><?php echo htmlspecialchars($civil['Patria_Card_Code']) ?></td>
                                <td><?php echo htmlspecialchars($civil['Patria_Card_Serial']) ?></td>
                                <td><?php echo htmlspecialchars($civil['Voting_Center']) ?></td>
                                <td><?php echo htmlspecialchars($civil['Vote_Type']) ?></td>
                                <td><?php echo $civil['Create_Date'] ?></td>
                                <td><?php echo $civil['Update_Date'] ?></td>

                            </tr>
                        <?php endforeach; ?>
                    <?php endif ?>

                </tbody>
            </table>
        </div>
        <dialog id="dialogDelete">
            <div class="form-index" autocomplete="off">
                <span><img src="../../assets/imgs/icons/xbox-x.svg" alt="hidemodal" onclick="closeDeleteDialog()" id="close-btn"></span>
                <h3>Elimina un registro</h3>
                <div class="btn-send-box">
                    <div class="input_area">
                        <input type="text" name="CI-DELETE" id="CI-DELETE" class="entry" placeholder="Ingresa la cedula de la persona a eliminar" required pattern="^[0-9]{6,10}$" title="Ingrese 6 a 10 dígitos numéricos">
                        <div class="labelline"><span><img src="../../assets/imgs/icons/id.svg" alt="icon" class="icon_lock"></span></div>
                    </div>
                    <button class="submit-btn" id="eliminate" onclick="confirmEliminateDialog()">Eliminar registro</button>
                    <div>
                    </div>

        </dialog>
        <dialog id="dialog-delete-confirm">
            <h3>Confirmar eliminación</h3>
            <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>

            <form class="actions" action="../../../controller/register-civil/delete.php" method="post">
                <button class="danger" name='confirmDelete' id="confirm-btn" type="button" onclick="validarFormularioEliminar()">Eliminar</button>
            </form>
            <button class="cancel" id="close" onclick="closeDialogTwo()">Cancelar</button>
        </dialog>
    </section>

    <footer class="update-and-delete">
        <a href="../home-register.html"><img src="../../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit" onclick="history.back()"></a>

        <div class="btns">
            <input type="submit" value="Eliminar civil" id="delete-btn" onclick="deleteDialog()">
            <input type="submit" value="Editar civil" id="update-btn" onclick="">
        </div>

    </footer>
    <script src="../../assets/public/modales.js"></script>
</body>

</html>