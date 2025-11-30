<?php 
session_start();

if(!isset($_SESSION['nombre'])){
    header('Location:../../views/login/index.php');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-menu.css">
    <title>Menu</title>
<body>

    <main class="main-box">

        <nav class="box-sidebar">

            <figure class="figOne">
                    <a href="#" aria-disabled="true">
                <img src="../assets/imgs/icons/home.svg" alt="Inicio">
                <h4>HOME</h4>
            </a>
            </figure>
            <figure class="figTwo">
                    <a href="../register-civil/home-register.html">
                <img src="../assets/imgs/icons/user-plus.svg" alt="Opción 2">
                <h4>Registro Civil</h4>
            </a>
            </figure>

            <figure class="figThree">
                    <a href="">
                    <img src="../assets/imgs/icons/clipboard-plus.svg" alt="Opción 3">
                    <h4>Gestion de <br>Proyectos</h4>
                </a>
                </figure>

                <figure class="figFourt">
                    <a href="../../views/contact/index.php">
                <img src="../assets/imgs/icons/address-book.svg" alt="Opción 4">
                <h4>Contacto</h4>
            </a>
            </figure>

            <figure class="figFive">
                <a href="../../controller/close-session/logOutController.php"><img src="../assets/imgs/icons/logout-2.svg" alt="Opción 5">
                <h4>Salir</h4>
            </a>
            </figure>
        </nav>

        <section class="sect-hd-dash">

        <section class="box-dashboard">
            <header class="title">
                <img src="../assets/imgs/man-1835_256.gif" alt="man-setup">
                <div class="welcome-hd">
                    <h1>Bienvenido <?php echo $_SESSION['nombre'] ?></h1>
                    <h5>Te damos la bienvenido <?php echo $_SESSION['nombre'] ?>, aprovecha este sistema para agilizar tus procesos administrativos. </h5>
                </div>
                    
            </header>

            <div class="list-option">
                <article class="info_admin">
                    <figure>
                        <img src="../assets/imgs/logo-unidos.webp" alt="bandera de venezuela" class="img-bandera">
                        <article>Venezuela - Estado Falcón</article>
                    </figure>
                    <ul>
                        <li><strong>Cedula:</strong> <?php echo $_SESSION['ci'] ?></li>
                        <li><strong>Comunidad:</strong> Consejo Comunal Las Margaritas, Unidos En Victoria Siempre Venceremos</li>
                        <li><strong>Correo:</strong> <?php echo $_SESSION['correo'] ?></li>
                        <li><strong>Rol:</strong> Administrador</li>
                    </ul>
                    <article class="link-pass"><a href="../change-password/index.php">Cambiar contraseña</a></article>
                </article>
                    <article class="parrafos">
                        <p class="parrafoone">Este es el Sistema de Gestión del Consejo Comunal Las Margaritas, una herramienta desarrollada por estudiantes de la UNEFA con el propósito de fortalecer la organización comunitaria.</p>
                        <p class="parrafotwo">Este sistema surge como respuesta a la necesidad de modernizar los procesos administrativos, reemplazando los controles manuales por una plataforma digital que permita:</p>                   
                <article>
                    <ul class="ulist">
                        <li>📊 Registrar y organizar datos de manera segura y eficiente.</li>
                        
                        <li>🗂️ Centralizar la información del consejo comunal en un solo lugar.</li>
                        
                        <li>⚡ Agilizar trámites y consultas, reduciendo tiempos y errores.</li>
                        
                        <li>🤝 Fomentar la transparencia y participación de la comunidad.<li>
                    </ul>
            </article>
            </article>

        </div>
                
                <p class="parrafothree">Con esta aplicación buscamos apoyar a la comunidad de Las Margaritas en la construcción de una gestión más ordenada, confiable y accesible para todos sus integrantes.</p>
        </section>
        </section>
    </main>

</body>
</html>
