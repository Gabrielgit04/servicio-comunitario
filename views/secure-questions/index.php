<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL .'views/assets/css/style-recover.css'?>">
    <title>Preguntas de seguridad</title>
</head>
<body>
    <section class="question-box">


        
        <form action="/controller/secure.php" method="post" autocomplete="off" class="recover-form">
            <header class="header-box"><h2>Protege tu cuenta</h2></header>

            <select id="security-question" name="security-question" required>
                <option value="" selected disabled>-- Selecciona una pregunta --</option>
                <option value="rol-consejo">¿Cuáll es tu cargo en el consejo comunal?</option>
                <option value="first-job">¿Cuál fue tu primer trabajo?</option>
                <option value="favorite-teacher">
                    ¿Cuál era el nombre de tu maestro favorito?</option>
                <option value="name-mom">¿Nombre de tu Mamá?</option>
                <option value="son-daughter">¿Nombre de tu Hijo/a?</option>
            </select>


            <div class="input_area">
                <input type="text" name="quest1" id="user" class="entry" placeholder="Respuesta" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"
                            class="icon_user"></span></div>
            </div>

            <select id="security-question" name="security-question-2" required>
                <option value="" selected disabled>-- Selecciona una pregunta --</option>
                <option value="rol-consejo">¿Cuáll es tu cargo en el consejo comunal?</option>
                <option value="first-job">¿Cuál fue tu primer trabajo?</option>
                <option value="favorite-teacher">
                    ¿Cuál era el nombre de tu maestro favorito?</option>
                <option value="name-mom">¿Nombre de tu Mamá?</option>
                <option value="son-daughter">¿Nombre de tu Hijo/a?</option>
            </select>


            <div class="input_area">
                <input type="text" name="quest2" id="user" class="entry" placeholder="Respuesta" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"
                            class="icon_user"></span></div>
            </div>



            <button class="btn-recover">Enviar</button>
        </form>

    </section>
</body>
</html>