<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <pre><?php if(isset($_SESSION['newpass'])){
        var_dump($_SESSION['newpass']);
        var_dump($_SESSION['repeatpass']);
        var_dump($_SESSION['id_user']);
    } ?></pre>
        
    </pre>
</body>
</html>
