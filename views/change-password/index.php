<?php require_once dirname(__DIR__, 3) . '/servicio-comunitario/config.php'; 
session_start();
$idUsuario = $_SESSION["id_user"];
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
unset($_SESSION['errors']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style-recover.css">
    <title>Cambia tu contraseña</title>
</head>
<body>
    <main class="main-box-change">
            </article>


        
        <form action="../../controller/recover/newPasswordController.php" method="POST" class="form-change">
            <h1>Cambia tu contraseña</h1>
        <input type="hidden" name="id_user" value="<?php echo htmlspecialchars($idUsuario); ?>">
        <div class="input_area">
            <input type="password" name="new_password" id="user" class="entry" placeholder="Nueva contraseña" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
            <div class="labelline"><span><img src="../assets/imgs/icons/icons8-lock-48.png" alt="icon"
                        class="icon_lock_new"></span></div>
        </div>

        <div class="input_area">
            <input type="password" name="rep_password" id="user" class="entry" placeholder="Repite la nueva contraseña" minlength="3" maxlength="30"  title="Se permiten letras, numeros y guines bajos, y la longitud debe ser de 3 a 30 caracteres" required>
            <div class="labelline"><span><img src="../assets/imgs/icons/icons8-lock-48.png" alt="icon"
                        class="icon_lock_rep"></span></div>
        </div>
        <small id="small-error"><?php echo isset($errors) ? implode('<br>', $errors) : ''; ?></small>

        <button type="submit" class="send-new">Cambiar contraseña</button>
    </form>
</main>
</body>
</html>
