<?php
session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-recover.css">
    <title>Preguntas de seguridad</title>
</head>
<body>
    <section class="question-box">

        <a href="../../views/login/index.php"><img src="../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit"></a>

        
        <form action="/controller/recover/recover.php" method="post" autocomplete="off">
            <header class="header-box"><h2>Recupera tu cuenta</h2></header>

            <h5 class="text"><?php echo $_SESSION['q1'] ?></h5>


            <div class="input_area">
                <input type="text" name="answer" id="user" class="entry" placeholder="Respuesta" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"
                            class="icon_user"></span></div>
            </div>

            <h5 class="text"><?php echo $_SESSION['q2'] ?></h5>
            

            <div class="input_area">
                <input type="text" name="answer-2" id="user" class="entry" placeholder="Respuesta" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"
                            class="icon_user"></span></div>
            </div>



            <button class="btn-secure">Enviar</button>
        </form>

    </section>
</body>
</html>