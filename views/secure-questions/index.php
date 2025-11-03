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

        
        <form action="/controller/recover.php" method="post">
            <header><h2>Preguntas de seguridad</h2></header>

            <input type="text" name="ci_quest" placeholder="Cedula">

            <select id="security-question" name="security-question" required>
                <option value="" selected disabled>-- Selecciona una pregunta --</option>
                <option value="rol-consejo">¿Cuáll es tu cargo en el consejo comunal?</option>
                <option value="first-job">¿Cuál fue tu primer trabajo?</option>
                <option value="favorite-teacher">¿Cuál era el nombre de tu maestro favorito?</option>
                <option value="name-mom">¿Nombre de tu Mamá?</option>
                <option value="son-daughter">¿Nombre de tu Hijo/a?</option>
            </select>
            <input type="text" name="quest1" class="entry-pre" placeholder="">

            <select id="security-question" name="security-question" required>
                <option value="" selected disabled>-- Selecciona una pregunta --</option>
                <option value="rol-consejo">¿Cuáll es tu cargo en el consejo comunal?</option>
                <option value="first-job">¿Cuál fue tu primer trabajo?</option>
                <option value="favorite-teacher">¿Cuál era el nombre de tu maestro favorito?</option>
                <option value="name-mom">¿Nombre de tu Mamá?</option>
                <option value="son-daughter">¿Nombre de tu Hijo/a?</option>
            </select>
            <input type="text" name="quest2"  class="entry-pre">

            <button>Enviar</button>
        </form>

    </section>
</body>
</html>