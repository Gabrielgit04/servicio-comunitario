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
    <pre><?php if(isset($_SESSION['q1'])){
        var_dump($_SESSION['q1']);
        var_dump($_SESSION['q2']);
    } ?></pre>
        
    </pre>
</body>
</html>
