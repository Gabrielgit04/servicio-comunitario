<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo BASE_URL .'views/assets/css/styles.css'?>">
    <title>Registrate</title>
</head>
<body>
    <section class="container">.
        
    <section class="back">
        <figure><img src="../assets/imgs/logo-unidos.webp" alt="logo-unidos" class="unidos_logo"></figure>

    </section>

    <section class="informacion">

        
        <form action="/controller/register.php" autocomplete="off" method="post">
            
            <header class="hd-box-title"><h2>Crea tu usuario</h2></header>

            <section class="inputs">

                <div class="input_form">
                    <input type="text" name="id" class="entry" placeholder="Cedula"  minlength="3" maxlength="15" required>
                    <div class="labelline"><span><img src="../assets/imgs/icons/id.svg" alt="icon"
                                class="icon_id"></span></div>
                </div>
                

                    <div class="input_form">
                        <input type="text" name="nombre" class="entry" placeholder="Nombre completo" pattern="^[a-zA-Z]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$" required>
                        <div class="labelline"><span><img src="../assets/imgs/icons/label.svg" alt="icon"
                                    class="icon_user"></span></div>
                    </div>

                <div class="input_form">
                    <input type="email" class="entry_pass" name="email"
                        placeholder="Correo"  minlength="8" maxlength="30" pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" required>
                    <div class="labelline_pass"><span><img src="../assets/imgs/icons/at.svg" alt="icon"
                                class="icon_email"></span>
                    </div>
                </div>

                <div class="input_form">
                    <input type="password" class="entry_pass" name="passw"
                        placeholder="Contraseña | Max 15 caracteres" title="Ingrese minimo 8 caracteres y maximo 15" minlength="8" maxlength="15"  required>
                    <div class="labelline_pass"><span><img src="../assets/imgs/icons/icons8-lock-48.png" alt="icon"
                                class="icon_lock"></span>
                    </div>
                </div>

                <select name="rol" id="rol">
                    <option selected disabled>Selecciona un rol</option>
                    <option value="Administrador">Administrador</option>
                </select>
                <button>Registrar</button>

            </section>
        </form>
        <article class="registro-link">
            <a href="../login/index.php">¿Ya tienes una cuenta? Ven e inicia sesion.</a>
        </article>

    </section>
    <footer>
        <p>© 2025 Unidos en Victoria Siempre. Todos los derechos reservados.</p>
    </footer>

    </section>
</body>
</html>