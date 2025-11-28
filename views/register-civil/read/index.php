<?php
include '../../../models/conexion.php';


$db = conexionDB();
if(!empty($db)){
    $sql = $db->prepare('SELECT * FROM People_Data');
    $sql->execute();
    $civiles=$sql->fetchAll(PDO::FETCH_ASSOC);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/register-civil-style.css">
    <title>Civiles registrados</title>
</head>
<body>
    <section class="read-all-cont">

            <header class="header-registradas">
                <a href="../../main-menu/index.php"><img src="../../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit"></a>
                
                <h2>Personas registradas en la comunidad</h2>
            </header>
        
        <div class="table-container">
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

    </section>
    
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        const table = document.querySelector('.table-container table');
        if(!table) return;

        // Start compact
        table.style.tableLayout = table.style.tableLayout || 'fixed';

        let resetTimeout = null;

        function expandCol(index){
            clearTimeout(resetTimeout);
            // switch to auto so column can size to content
            table.style.tableLayout = 'auto';
            // keep other cells compact
            table.querySelectorAll('th, td').forEach(el => el.style.whiteSpace = 'nowrap');
            // allow the hovered column to wrap and expand
            const sel = 'th:nth-child(' + (index + 1) + '), td:nth-child(' + (index + 1) + ')';
            table.querySelectorAll(sel).forEach(el => el.style.whiteSpace = 'normal');
        }

        function reset(){
            clearTimeout(resetTimeout);
            // small delay to avoid flicker when moving between cells
            resetTimeout = setTimeout(() => {
                table.style.tableLayout = 'fixed';
                table.querySelectorAll('th, td').forEach(el => el.style.whiteSpace = '');
            }, 120);
        }

        // header cells
        table.querySelectorAll('thead th').forEach((th, i) => {
            th.addEventListener('mouseenter', () => expandCol(i));
            th.addEventListener('mouseleave', reset);
        });

        // body cells (attach per-cell to know the column index)
        table.querySelectorAll('tbody tr').forEach(tr => {
            tr.querySelectorAll('td').forEach((td, i) => {
                td.addEventListener('mouseenter', () => expandCol(i));
                td.addEventListener('mouseleave', reset);
            });
        });

        // also reset when leaving the table
        table.addEventListener('mouseleave', reset);
    });
    </script>

</body>
</html>