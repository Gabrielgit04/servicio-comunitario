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
if (isset($_SESSION['mensaje_update']) && $_SESSION['mensaje_update'] == true) {
    $mensaje = 'Registro actualizado correctamente';
    unset($_SESSION['mensaje_update']);
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
        <?php if (!empty($mensaje)): ?>
            <article id="messageSuccess">
                <p><?php echo $mensaje ?></p>
            </article>
            <script>
                setTimeout(() => {
                    let messageDelete = document.getElementById('messageSuccess');
                    messageDelete.style.display = 'none'
                }, 5000);
            </script>
        <?php endif; ?>

        <?php if (isset($_SESSION['errors'])): ?>
            <article id="messageError">
                <p><?php echo implode(', ',$_SESSION["errors"]) ?></p>
                <?php unset($_SESSION['errors']) ?>
            </article>
            <script>
                setTimeout(() => {
                    let messageError = document.getElementById('messageError');
                    messageError.style.display = 'none'
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
            <h3 style="color: darkslategray;">Confirmar eliminación</h3>
            <p>¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.</p>

            <form class="actions" action="../../../controller/register-civil/delete.php" method="post">
                <button class="danger" name='confirmDelete' id="confirm-btn" type="button" onclick="validarFormularioEliminar()">Eliminar</button>
            </form>
            <button class="cancel" id="close" onclick="closeDialogTwo()">Cancelar</button>
        </dialog>


        <!-- Edit dialog -->
        <dialog id="dialog-edit" class="dialog-edit">
            <span><img src="../../assets/imgs/icons/xbox-x.svg" alt="hidemodal" onclick="closeEditDialogFather()" id="close-edit-btn"></span>
            <h3>Editar registro</h3>
            <div class="form-index" autocomplete="off">
                    <div class="input_area">
                        <input type="text" name="cedula" id="edit_ID_CI" class="entry" placeholder="Cédula" autocomplete="off" required pattern="^[0-9]{6,10}$" title="Ingrese 6 a 10 dígitos numéricos">
                        <div class="labelline"><span><img src="../../assets/imgs/icons/id.svg" alt="icon" class="icon_id"></span></div>
                    </div>
                    <div class="input_area">
                        <label for="choice-update" name="choiceUpdate" class="sr-only">Campo a actualizar</label>
                        <select name="choiceUpdate" id="choice-update" required>
                            <option value="FirstName">Nombres</option>
                            <option value="LastName">Apellidos</option>
                            <option value="ID_CI">Cédula</option>
                            <option value="Sex">Sexo (M/F)</option>
                            <option value="Phone_Number">Teléfono</option>
                            <option value="Committee_Name">Comité al que pertenece</option>
                            <option value="Address_Civil">Dirección</option>
                            <option value="Birth_Date">Fecha de nacimiento</option>
                            <option value="Age">Edad</option>
                            <option value="Email_Address">Correo electrónico</option>
                            <option value="Patria_Card_Code">Código del carnet de la patria</option>
                            <option value="Patria_Card_Serial">Serial del carnet de la patria</option>
                            <option value="Voting_Center">Centro de votación</option>
                            <option value="Vote_Type">Tipo de voto</option>
                        </select>
                    </div>
                    <div class="input_area">
                        <input type="text" name="UPDATE_FIELD" id="editCampo" class="entry" placeholder="Actualice el campo" autocomplete="off">
                        <div class="labelline"><span><img src="../../assets/imgs/icons/user-edit.svg" alt="icon" class="icon-user-edit"></span></div>
                    </div>

                    <div class="btns-update">
                        <button type="submit" id="btn-submit-update" class="submit-btn-edit" onclick="twoDialogUpdate()">Actualizar</button>
                    </div>
            </div>
        </dialog>
        <dialog id="dialog-update-confirm">
            <h3 style="color: darkslategray;">Confirmar actualizacion</h3>
            <p style="font-family: 'Poppins-light', Arial, Helvetica, sans-serif;">¿Estás seguro de que deseas actualizar la informacion de este usuario?</p>
            <span>
                <form class="actions" action="../../../controller/register-civil/update.php" method="get">
                    <button class="submit-btn-edit" name='confirmDelete' id="confirm-btn" onclick="validarFormularioEditar()">Confirmar</button>
                </form>
                <button class="cancel-btn-edit" id="closeDialogTwo" onclick="closeEditDialog()">Cancelar</button>
            </span>
        </dialog>


    </section>

    <footer class="update-and-delete">
        <a href="../home-register.html"><img src="../../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit" onclick="history.back()"></a>

        <div class="btns">
            <input type="submit" value="Eliminar civil" id="delete-btn" onclick="deleteDialog()">
            <input type="submit" value="Editar civil" id="update-btn" onclick="updateDialog()">
        </div>

    </footer>
    <script src="../../assets/public/modales.js"></script>
</body>

</html>