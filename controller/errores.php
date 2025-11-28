<?php
session_start();
$_SESSION['search'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre><?php 
        if(!empty($_SESSION['search'])){
            foreach($_SESSION['search'] as $item){
                echo 'Cédula: ' . $item['ID_CI'] . ' | Nombre: ' . $item['FirstName'] . ' | Apellido: ' . $item['LastName'] . "\n";
                var_dump($item);
                unset($_SESSION['search']);
            }
        }else {
            echo "No se encontraron resultados para la búsqueda.";
        }?></pre>
        
    </pre>
</body>
</html>
