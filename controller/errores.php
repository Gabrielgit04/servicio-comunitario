<?php
session_start();
$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre><?php if(isset($_SESSION['id'])){
        var_dump($_SESSION['id']);
    } ?></pre>
        
    </pre>
</body>
</html>
