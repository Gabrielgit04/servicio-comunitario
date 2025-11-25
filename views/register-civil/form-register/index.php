<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/register-civil-style.css">
    <title>Formulario de Registro</title>
</head>

<body>
    <section class="form-all-cont">

        <div class="cont-header">
            <a href=""><img src="../../assets/imgs/icons/arrow-left.svg" alt="exit" class="exit"></a>
            <header><h2>Registra a las personas pertenecientes a tu comunidad</h2></header>
            <article>
                <p>
                    Esta seccion está diseñada para que puedas registrar a los individuos que forman parte de tu comunidad. El objetivo es recopilar información esencial que permita un mejor seguimiento y apoyo a cada miembro.
                </p>
                <p>
                    Completa el siguiente formulario con los datos personales de cada individuo. Asegúrate de ingresar la información correctamente para mantener un registro preciso y actualizado de los miembros de tu comunidad.
                </p>
            </article>
        </div>
    
    <div class="form-container">
        <h2>Ingresa sus datos</h2>
        <form action="/controller/register-civil/register.php" method="post" autocomplete="off">
            <section>

            
            <div class="input_area">
                <input type="text" name="nombre" class="entry" placeholder="Nombres" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>
            <div class="input_area">
                <input type="text" name="apellido" class="entry" placeholder="Apellidos" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="cedula" class="entry" placeholder="Cédula" required>
                <div class="labelline"><span><img src="../../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="sexo" class="entry" placeholder="Sexo M/F" required>
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="tel" name="telefono" class="entry" placeholder="Teléfono">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="comite" class="entry" placeholder="Comité al que pertenece">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="direccion" class="entry" placeholder="Dirección">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="date" name="fecha_nacimiento" class="entry" placeholder="Fecha de nacimiento">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="number" name="edad" class="entry" placeholder="Edad" min="0">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="email" name="correo" class="entry" placeholder="Correo electrónico">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="codigo_carnet" class="entry" placeholder="Código del carnet de la patria">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="serial_carnet" class="entry" placeholder="Serial del carnet de la patria">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="centro_votacion" class="entry" placeholder="Centro de votación">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>

            <div class="input_area">
                <input type="text" name="tipo_voto" class="entry" placeholder="Tipo de voto">
                <div class="labelline"><span><img src="../assets/imgs/icons/clipboard.svg" alt="icon"></span></div>
            </div>
            </section>

            <button type="submit" class="submit-btn">Registrar</button>
        </form>
    </div>
</section>
</body>

</html>