<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL .'views/assets/css/style-recover.css'?>">
    <title>Identificate</title>
</head>
<body>
    <section class="question-box-id">

        <a href="../../views/login/index.php"><img src="../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit"></a>

        
        <form action="/controller/recover/auth-id.php" method="post" autocomplete="off" class="ced-form">
            <header class="header-box"><h2>Identificate</h2></header>
            <p>Ingresa tu cedula para identificarte</p>

            <div class="input_area">
                <input type="text" name="ci_quest" id="user" class="entry" placeholder="Cedula" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/id.svg" alt="icon"
                            class="icon_user"></span></div>
            </div>

            <button class="btn-secure">Enviar</button>
        </form>

    </section>
</body>
</html>