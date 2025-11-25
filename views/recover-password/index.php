
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

        
        <form action="/controller/recover.php" method="post" autocomplete="off">
            <header class="header-box"><h2>Recupera tu cuenta</h2></header>



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