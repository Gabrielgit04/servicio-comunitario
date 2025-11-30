<?php require_once dirname(__DIR__, 3) . '/config.php'; 
session_start();
if(!isset($_SESSION['nombre'])){
    header('Location:../../login/index.php');
}
if(isset($_SESSION['mensaje']) && $_SESSION['mensaje'] == true){
    $mensaje = "Registro exitoso";
    unset($_SESSION['mensaje']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="<?php echo BASE_URL .'views/assets/css/register-civil-style.css'?>">
    <title>Formulario de Registro</title>
</head>

<body>
    
    <section class="form-all-cont">

        <div class="cont-header">
<<<<<<< HEAD
            <a href="../home-register.html"><img src="../../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit"></a>
=======
            <a href=""><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/arrow-left.svg'; ?>" alt="exit" class="exit"></a>
>>>>>>> 999acd96bfabee27489bddbf82d73706dbca642e
            <header><h2>Registra a las personas pertenecientes a tu comunidad</h2></header>
            <article>
                <p>
                    Esta seccion está diseñada para que puedas registrar a los individuos que forman parte de tu comunidad. El objetivo es recopilar información esencial que permita un mejor seguimiento y apoyo a cada miembro.
                </p>
                <p>
                    Completa el siguiente formulario con los datos personales de cada individuo. Asegúrate de ingresar la información correctamente para mantener un registro preciso y actualizado de los miembros de tu comunidad.
                </p>
            <?php if(!empty($mensaje)): ?>
            <article id="message">
                <p><?php echo $mensaje ?></p>
            </article>
            
            <script>
                let message = document.getElementById('message');
                setTimeout(() =>{
                    message.style.display = 'none';
                }, 2000);
            </script>
            </article>
            


            <?php endif; ?>
        </div>
    
    <div class="form-container">
        <h2 style="text-transform: uppercase;">Ingresa sus datos</h2>
        <form action="/controller/register-civil/insert.php" method="post" autocomplete="off">
            <section>

                <div class="input_area">
                    <input type="text" name="cedula" class="entry" placeholder="Cédula" autocomplete="off" required pattern="^[0-9]{6,10}$" title="Ingrese 6 a 10 dígitos numéricos">
                    <div class="labelline"><span><img src="../../assets/imgs/icons/id.svg" alt="icon"></span></div>
                </div>
            
            <div class="input_area">
                <input type="text" name="nombre" class="entry" placeholder="Nombres" autocomplete="off" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-]{2,50}$" title="Solo letras, espacios y guiones (2-50 caracteres)">
                <div class="labelline"><span><img src="../../assets/imgs/icons/label.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="apellido" class="entry" placeholder="Apellidos" autocomplete="off" required pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ\s\-]{2,50}$" title="Solo letras, espacios y guiones (2-50 caracteres)">
                <div class="labelline"><span><img src="../../assets/imgs/icons/label.svg" alt="icon"></span></div>
            </div>


                <select name="sexo" id="sex" required>
                    <option selected disabled>Selecciona tu genero</option>
                    <option value="Masculino">🚹Masculino</option>
                    <option value="Femenino">🚺Femenino</option>
                </select>

            <div class="input_area">
                <input type="tel" name="telefono" class="entry" placeholder="Teléfono" autocomplete="off" required pattern="^\+?[0-9]{7,15}$" title="Número de teléfono: 7 a 15 dígitos, opcional + al inicio">
                <div class="labelline"><span><img src="../../assets/imgs/icons/address-book.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="comite" class="entry" placeholder="Comité al que pertenece" autocomplete="off" required pattern="^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]{2,80}$" title="Nombre del comité (2-80 caracteres)">
                <div class="labelline"><span><img src="../../assets/imgs/icons/file-info.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="direccion" class="entry" placeholder="Dirección" autocomplete="off" required pattern="^.{5,150}$" title="Ingresa al menos 5 caracteres para la dirección">
                <div class="labelline"><span><img src="../../assets/imgs/icons/home-question.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="date" name="fecha_nacimiento" class="entry" placeholder="Fecha de nacimiento" autocomplete="off" required>
                <div class="labelline"><span><img src="../../assets/imgs/icons/calendar-week.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="number" name="edad" class="entry" placeholder="Edad" autocomplete="off" min="0" max="120" required>
                <div class="labelline"><span><img src="../../assets/imgs/icons/number-123.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="email" name="correo" class="entry" placeholder="Correo electrónico" style="text-transform: lowercase;" required pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Ingresa un correo válido" autocomplete="off">
                <div class="labelline"><span><img src="../../assets/imgs/icons/at.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="codigo_carnet" class="entry" placeholder="Código del carnet de la patria" autocomplete="off" required pattern="^[A-Za-z0-9\-]{3,30}$" title="Código alfanumérico del carnet de la patria (3-30 caracteres)">
                <div class="labelline"><span><img src="../../assets/imgs/icons/key.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="serial_carnet" class="entry" placeholder="Serial del carnet de la patria" autocomplete="off" required pattern="^[A-Za-z0-9\-]{3,30}$" title="Serial alfanumérico del carnet de la patria (3-30 caracteres)">
                <div class="labelline"><span><img src="../../assets/imgs/icons/hash.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="centro_votacion" class="entry" placeholder="Centro de votación" autocomplete="off" required pattern="^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\.\-]{3,100}$" title="Nombre del centro (3-100 caracteres)">
                <div class="labelline"><span><img src="../../assets/imgs/icons/building.svg" alt="icon"></span></div>
                    <input type="text" name="cedula" class="entry" placeholder="Cédula" required>
                    <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/id.svg'; ?>" alt="icon"></span></div>
                </div>
            
            <div class="input_area">
                <input type="text" name="nombre" class="entry" placeholder="Nombres" required>
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/label.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="apellido" class="entry" placeholder="Apellidos" required>
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/label.svg'; ?>" alt="icon"></span></div>
            </div>


            <div class="input_area">
                <input type="text" name="sexo" class="entry" placeholder="Sexo M/F" required>
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/users.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="tel" name="telefono" class="entry" placeholder="Teléfono">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/address-book.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="comite" class="entry" placeholder="Comité al que pertenece">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/file-info.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="direccion" class="entry" placeholder="Dirección">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/home-question.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="date" name="fecha_nacimiento" class="entry" placeholder="Fecha de nacimiento">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/calendar-week.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="number" name="edad" class="entry" placeholder="Edad" min="0">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/number-123.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="email" name="correo" class="entry" placeholder="Correo electrónico">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/at.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="codigo_carnet" class="entry" placeholder="Código del carnet de la patria">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/key.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="serial_carnet" class="entry" placeholder="Serial del carnet de la patria">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/hash.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="centro_votacion" class="entry" placeholder="Centro de votación">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/building.svg'; ?>" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="tipo_voto" class="entry" placeholder="Tipo de voto">
                <div class="labelline"><span><img src="<?php echo BASE_URL . 'views/assets/imgs/icons/square-check.svg'; ?>" alt="icon"></span></div>
            </div>

                <select name="tipo_voto" id="tipo" required>
                    <option selected disabled>Selecciona el tipo de voto</option>
                    <option value="Presencial">📑Presencial</option>
                    <option value="Asistido">👥Asistido</option>
                </select>

            </section>

            <button type="submit" class="submit-btn">Registrar</button>
        </form>
    </div>
</section>
</body>

</html>