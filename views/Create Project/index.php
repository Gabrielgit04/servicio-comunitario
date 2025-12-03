<?php 

session_start();

if(!isset($_SESSION['nombre'])){
    header('Location:../../views/login/index.php');
};

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <link rel="stylesheet" href="../../assets/css/create project.css">
    <title>Crear Proyecto</title>
</head>
<body style="font-family: 'Poppins',Arial;">

    <a href="../index.php" class="volver" title="Volver">
        <img src="../../assets/imgs/icons/arrow-left.svg">
    </a>

    <br>

    <h1 style="color: whitesmoke;">Creación del Proyecto</h1>

    <hr>

    <form id="formulario_datos" action="../../../controller/sistem project/create project.php" method="POST">
        <div class="list-option">
            <article class="contenedor_entradas1">
                <input type="hidden" name="Id" value="<?php $id_project= mt_rand(10000000, 99999999); echo "$id_project" ?>">
                <a>Titulo del Proyecto </a>
                <input class="titulo" type="text" minlength="10" maxlength="150" pattern="[A-Za-z\sÁÉÍÓÚáéíóúÑñ,._-]+|[\s\S]*" autocomplete="off" placeholder="Ejemplo: Recuperación del parque... etc" name="Titulo" required>
                <a>Fecha de Inicio  </a>
                <input class="fecha" type="date" name="Fecha_inicio" min="2020-01-01" max="2050-12-31" required>
                <a>Fecha de Culminación  </a>
                <input class="fecha" type="date" name="Fecha_culminacion" min="2020-01-01" max="2050-12-31" required>
                <a>Estado </a>     
                <select class="estado" name="Estado" required> 
                    <option value="Pranificando"> Pranificando </option> 
                    <option value="En_Proceso"> En Proceso </option> 
                    <option value="Incompleto"> Incompleto </option>
                    <option value="Finalizado"> Finalizado </option>  
                </select>
                
                <br><br>

            </article>

            <br><br><br>

            <article class="contenedor_entradas2">
                <h2>Lista de Entradas y Precios</h2>
                    <div class="contenedor_entradas" id="contenedor_entradas"> </div>

                    <button type="button" class="btn-accion btn-agregar" onclick="agregarCampo()">➕ Agregar Entrada</button>
                    <div class="total-box"> 
                        Total Presupuestado: <span id="total_suma">0.00</span>
                    </div>
                <input  type="submit" value="Guardar Proyecto" class="btn-accion btn-agregar">
            </article>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            agregarCampo();
        });

        let indiceEntrada = 0; 


        function agregarCampo() {
            indiceEntrada++;
            const contenedor = document.getElementById('contenedor_entradas');
            
            const grupo = document.createElement('div');
            grupo.classList.add('entrada-grupo');
            grupo.dataset.id = indiceEntrada; 

            const inputTexto = document.createElement('input');
            inputTexto.type = 'text';
            inputTexto.name = 'descripciones[' + indiceEntrada + ']'; 
            inputTexto.placeholder = `Describa el Gasto`;
            inputTexto.required = true;
            inputTexto.autocomplete = 'off';

            const labelPrecio = document.createElement('label');
            labelPrecio.textContent = 'Precio:';

            const inputPrecio = document.createElement('input');
            inputPrecio.type = 'text'; 
            inputPrecio.inputMode = 'decimal'; 
            inputPrecio.name = 'precios[' + indiceEntrada + ']'; 
            inputPrecio.placeholder = 'Precio Bolivar';
            inputPrecio.required = true;
            inputPrecio.autocomplete = 'off';
            inputPrecio.addEventListener('input', calcularTotal); 
            
            const botonEliminar = document.createElement('button');
            botonEliminar.type = 'button';
            botonEliminar.classList.add('btn-accion', 'btn-eliminar');
            botonEliminar.textContent = '❌ Eliminar';
            botonEliminar.onclick = function() {
                eliminarCampo(grupo);
            };
            

            grupo.appendChild(inputTexto);
            grupo.appendChild(labelPrecio);
            grupo.appendChild(inputPrecio);
            grupo.appendChild(botonEliminar);

            contenedor.appendChild(grupo);
            
            calcularTotal();
        }

        function eliminarCampo(elementoGrupo) {
            elementoGrupo.remove(); 
            calcularTotal(); 
        }

        function calcularTotal() {
            const camposPrecio = document.querySelectorAll('#contenedor_entradas input[name^="precios"]');
            let sumaTotal = 0;

            camposPrecio.forEach(input => { 
            let valorStr = input.value || '0'; 
            valorStr = valorStr.replace(',', '.');
            const valor = parseFloat(valorStr) || 0;
            sumaTotal += valor;
            });

    document.getElementById('total_suma').textContent = sumaTotal.toFixed(2);
}
    </script>

</body>
</html>