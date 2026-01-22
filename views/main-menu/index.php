<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; 
?>
<?php 
include '../../controller/dataFetchDb/fetchUsers.php';

if(!isset($_SESSION['nombre'])){
    header('Location:../../views/login/index.php');
};
$_SESSION["id_user"] = $_SESSION['ci'];
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
                    <a href="../main-menu/index.php" aria-disabled="true">
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
                    <a href="../index.php">
                    <img src="../assets/imgs/icons/clipboard-plus.svg" alt="Opción 3">
                    <h4>Gestion de<br>Proyectos</h4>
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
                <figure class="carrusel">
                    
                </figure>
                    
            </div>

            <div class="dashboard">
                <article class='count-admins-box'>
                    <h4>Administradores registrados:</h4>
                    <h2 class="count"><?php echo $_SESSION['userRegisterTotal']; ?></h2>
                    <small><b>Ultima conexion:</b><br><?php echo $_SESSION['lastVisited'] ?></small>
                </article>
                <article class='count-civil-box'>
                    <h4>Civiles registrados:</h4>
                    <h2 class="count"><?php echo $_SESSION['peopleRegisterTotal'] ?></h2>
                    <small><b>Registro Civil</b></small>

                </article>
                <article class='count-projects-box'>
                    <h4>Proyectos registrados:</h4>
                    <section class="box-projects">

                        <div>
                            <h5>Total proyectos:</h5>
                            <h3 style="font-size: 1.6em;"><?php echo $_SESSION['projectsRegisterTotal'] ?></h3>
                        </div>
                        <div>
                            <b>Estado:</b>
                            <ul>
                                <li>Planificando<h3><?php echo $_SESSION['projects_state']['Planificando']?></h3></h3></li>
                                <li>En Proceso<h3><?php echo $_SESSION['projects_state']['En_Proceso'] ?></h3></li>
                                <li>Incompleto<h3><?php echo $_SESSION['projects_state']['Incompleto'] ?></h3></h3></li>
                                <li>Finalizado<h3><?php echo $_SESSION['projects_state']['Finalizado']?></h3></li>
                            </ul>
                        </div>
                    </section>

                </article>
            </div>
                
        </section>
        </section>
    </main>

</body>
</html>
