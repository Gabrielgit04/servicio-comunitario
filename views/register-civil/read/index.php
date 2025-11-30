<?php
include '../../../models/conexion.php';
session_start();


$db = conexionDB();

if(!empty($_SESSION['search'])){
        $civiles = $_SESSION['search'];
        unset($_SESSION['search']);
}else{
    if(!empty($db)){
        $sql = $db->prepare('SELECT * FROM People_Data');
        $sql->execute();
        $civiles=$sql->fetchAll(PDO::FETCH_ASSOC);

    }
}
if(!isset($_SESSION['nombre'])){
    header('Location:../../views/login/index.php');
};

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
       
        
        <h2>Personas registradas en la comunidad</h2>
        <span class="span-search">
                <form action="../../../controller/register-civil/search.php" autocomplete="off" method="POST">
                    <button id="btnSearch"><img src="../../assets/imgs/icons/search.svg" alt="search"></button>
                    <input type="search" name="search" class="search" id="search" placeholder="Buscar por Nombre | Apellido | Cedula"style="text-transform: capitalize; "   required>
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
                        <th>Fecha de registro del civil</th>
                        <th>Ultima actualizacion</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Aquí se insertarán las filas de datos dinámicamente -->
                    <?php if(is_array($civiles)): ?>
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
        <dialog id="dialogDelete" style="position: absolute;bottom:0;left:10px;">
            <h2>Elimina un registro</h2>
            <span><img src="../../assets/imgs/icons/xbox-x.svg" alt="hidemodal" onclick="closeDeleteDialog()" id="close-btn"></span>
            <form action="../../../controller/register-civil/delete.php" method="POST">
                <input type="text" placeholder="Ingresa la cedula de la persona a eliminar" class="deleteinput">
                <button>Eliminar</button>
                    
            </form>

        </dialog>
        
    </section>      
    <footer class="update-and-delete">
        <a href="../home-register.html"><img src="../../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit" onclick="history.back()" ></a>

        <div class="btns">
            <input type="submit" value="Eliminar civil" id="delete-btn" onclick="deleteDialog()">
            <input type="submit" value="Editar civil" class="update-btn" onclick="">
        </div>
    
    </footer>
    <script src="../../assets/public/modales.js"></script>
</body>
</html>