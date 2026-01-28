<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; ?>
<?php
session_start();
$mensaje = '';

if (isset($_SESSION['Logueado']) && $_SESSION['Logueado'] == true) {
    $mensaje = 'Has iniciado sesion correctamente';
    unset($_SESSION['Logueado']);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="icon" type="image/x-icon" href="../assets/imgs/logo-unidos.ico">
    <title>Inicia sesion</title>
</head>

<body>
    <main class="box-main">

        <section class="first-box">


            <form action="http://localhost/servicio-comunitario/controller/authAdmin/authController.php" autocomplete="off" method="post">
                <header>
                    <h2>Inicia sesion</h2>
                </header>
                <div class="input_area">
                    <input type="email" name="email_log" id="user" class="entry" placeholder="Correo" minlength="3" maxlength="30" title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
                    <div class="labelline"><span><img src="../assets/imgs/icons/at.svg" alt="icon"
                                class="icon_user"></span></div>
                </div>

                <div class="input_password">
                    <input type="password" id="password" class="entry_pass" name="passw_log"
                        placeholder="Contraseña | Max 15 caracteres" minlength="8" maxlength="15" title="La contraseña debe contener: Al menos un letra minuscula, al menos un numero, al menos un caracter especial y de 8 a 15 caracteres." required>
                    <div class="labelline_pass"><span><img src="../assets/imgs/icons/icons8-lock-48.png" alt="icon"
                                class="icon_lock"></span>
                    </div>
                </div>
                <article>
                    <a href="../../views/auth-identification/index.php">¿Olvido su contraseña?</a>
                </article>
                <?php if (!empty($mensaje)): ?>
                    <article class="success-box" name="success" id="success-box">
                        <p><?php echo $mensaje ?></p>
                        <div class="barra-de-tiempo"></div>
                    </article>
                    <script>
                        
                        // Redirigir al menú después de 3 segundos
                        setTimeout(() => {
                            window.location.href = "../../views/main-menu/index.php";
                            error.style.display = "none"

                        }, 3500);
                    </script>
                <?php endif ?>
                <?php if (isset($_SESSION['error'])): ?>
                    <article class="error-box" id="error-box">
                        <p><?php echo $_SESSION['error'] ?></p>
                        <?php unset($_SESSION['error']) ?>
                    </article>
                    <script>
                        let error = document.getElementById('error-box')
                        setTimeout(() => {
                            error.style.display = "none"
                        }, 2800)
                    </script>
                <?php endif ?>


                <button class="ingresar" id="send">ingresar</button>
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