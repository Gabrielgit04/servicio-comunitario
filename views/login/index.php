<?php 
    session_start();

    if(isset($_SESSION['correo'])){
        header('Location:../main-menu/index.php ');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <title>Inicia sesion</title>
</head>
<body>
    <main class="box-main">

        <section class="first-box">

            
        <form action="/controller/login.php" autocomplete="off" method="post">
            <header><h2>Inicia sesion</h2></header>
            <div class="input_area">
                <input type="email" name="email_log" id="user" class="entry" placeholder="Correo" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/at.svg" alt="icon"
                            class="icon_user"></span></div>
            </div>

            <div class="input_password">
                <input type="password" id="password" class="entry_pass" name="passw_log"
                    placeholder="Contraseña | Max 15 caracteres" minlength="8" maxlength="15"  title="La contraseña debe contener: Al menos un letra minuscula, al menos un numero, al menos un caracter especial y de 8 a 15 caracteres." required >
                <div class="labelline_pass"><span><img src="../assets/imgs/icons/icons8-lock-48.png" alt="icon"
                            class="icon_lock"></span>
                </div>
            </div>
            <article>
                <a href="">¿Olvido su contraseña?</a>
            </article>

            <button class="ingresar">ingresar</button>
        </form>
        <article class="registro-link">
            <a href="../register/index.php">¿No tienes cuenta? Registrate.</a>
        </article>

        </section>

        <section class="two-box">
            

        </section>
    
        </main>
</body>
</html>