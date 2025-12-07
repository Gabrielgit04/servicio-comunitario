function deleteDialog() {
    const openDialogBtn = document.getElementById("delete-btn")
    const modal = document.getElementById('dialogDelete')

    openDialogBtn.addEventListener('click', (event) => {
        event.preventDefault(); //para no enviar el formulario
        modal.showModal() //mostrar el formulario

    })

}

function closeDeleteDialog() {
    const closeDialogBtn = document.getElementById('close-btn');
    const modal = document.getElementById("dialogDelete");

    closeDialogBtn.addEventListener('click', (e) => {
        e.preventDefault();
        modal.close();
    })

}
// funciones del segundo dialog
function confirmEliminateDialog() {
    const eliminateBtn = document.getElementById("eliminate")
    const modal = document.getElementById('dialog-delete-confirm')

    eliminateBtn.addEventListener('click', (event) => {
        event.preventDefault(); //para no enviar el formulario
        modal.showModal() //mostrar el formulario

    })

}
function closeDialogTwo() {
    const closeBtn = document.getElementById('close')
    const twoDialog = document.getElementById('dialog-delete-confirm')

    closeBtn.addEventListener("click", () => {
        twoDialog.close();
    });
}
// hasta aca el segundo dialog
function validarFormularioEliminar() {
    // Leer valor de la cédula y redirigir inmediatamente
    const cedula = document.getElementById("CI-DELETE").value;
    if (!cedula) {
        alert('Ingrese una cédula válida antes de confirmar.');
        return false;
    }
    // Redirigir vía GET (controller espera cedula en query string)
    window.location.href = "../../../controller/register-civil/delete.php?cedula=" + encodeURIComponent(cedula);

}
// editar dialog
function updateDialog() {
    const openDialogEdit = document.getElementById('dialog-edit');
    const updateBtn = document.getElementById('update-btn');

    updateBtn.addEventListener('click', (e) => {
        e.preventDefault();
        openDialogEdit.showModal()
    })
}
function closeEditDialog() {
    const closeBtn = document.getElementById('closeDialogTwo')
    const editDialog = document.getElementById('dialog-update-confirm')

    closeBtn.addEventListener("click", () => {
        editDialog.close();
    });
}
function closeEditDialogFather() {
    const closeBtn = document.getElementById('close-edit-btn')
    const editDialog = document.getElementById('dialog-edit')

    closeBtn.addEventListener("click", () => {
        editDialog.close();
    });
}

// hasta aca

// segundo dialog de update
function twoDialogUpdate() {
    const btnUpdateTwo = document.getElementById('btn-submit-update');
    const dialogUpdateTwo = document.getElementById('dialog-update-confirm');
    btnUpdateTwo.addEventListener('click', (e) => {
        e.preventDefault();
        dialogUpdateTwo.showModal()
    })

    
    
}
// envio de formulario del dialgo dos
function validarFormularioEditar() {
    // Leer valor de la cédula
    const cedula = document.getElementById("edit_ID_CI").value.trim();
    if (!cedula) {
        alert('Ingrese una cédula válida antes de confirmar.');
        return false;
    }

    // Leer opción seleccionada
    const choiceUpdate = document.getElementById("choice-update").value;
    if (!choiceUpdate) {
        alert('Seleccione una opción válida antes de confirmar.');
        return false;
    }

    // Detectar si el campo dinámico está activo
    const campoDinamico = document.getElementById("editCampo");
    const campoFijo = document.getElementById("editCampoFijo"); // tu input fijo original

    let updateField = "";

    if (campoDinamico && campoDinamico.style.display !== "none") {
        // Si es un SELECT, validar que no esté en la opción deshabilitada
        if (campoDinamico.tagName === "SELECT" && campoDinamico.selectedIndex === 0) {
            alert("Seleccione una opción válida antes de confirmar.");
            return false;
        }
        updateField = campoDinamico.value.trim();
    } else if (campoFijo && campoFijo.style.display !== "none") {
        updateField = campoFijo.value.trim();
    }

    if(!updateField){
        alert("El campo esta vacio.")
    }

    // Redirigir vía GET con parámetros
    const url = `../../../controller/register-civil/update.php?cedula=${encodeURIComponent(cedula)}&choiceUpdate=${encodeURIComponent(choiceUpdate)}&UPDATE_FIELD=${encodeURIComponent(updateField)}`;
    window.location.href = url;
}


function changeInput() {
    const campo = document.getElementById("choice-update");
    const removeField = document.getElementById("div-input-update"); // contenedor del campo fijo
    const createField = document.getElementById("dinamic-input");    // contenedor del campo dinámico

    campo.addEventListener("change", function () {
        const specialFields = ["Birth_Date", "Voting_Center", "Committee_Name", "Vote_Type", "Sex"];
        
        // Limpiar siempre antes de crear
        createField.innerHTML = "";
        
        if (specialFields.includes(this.value)) {
            if (removeField) removeField.style.display = "none";
            createField.style.display = "flex";

            let newField;

            switch (this.value) {
                case "Birth_Date":
                    newField = document.createElement("input");
                    newField.type = "date";
                    break;
                case "Voting_Center":
                    newField = document.createElement("select");
                    newField.innerHTML = `
                        <option selected disabled>Selecciona el centro de votación</option>
                        <option value="Liceo Bolivariano Maestro Gallegos">🏫Liceo Bolivariano Maestro Gallegos</option>
                        <option value="Caipa">🏢Caipa</option>
                        <option value="Alicia Tremont de Medina">🏫Alicia Tremont de Medina</option>
                        <option value="Inces">🏤Inces</option>
                    `;
                    break;
                case "Committee_Name":
                    newField = document.createElement("select");
                    newField.innerHTML = `
                        <optgroup label="Seleccione un comité">
                            <option value="alimentacion">Alimentación</option>
                            <option value="economia_comunal">Economía comunal</option>
                            <option value="empleo">Empleo</option>
                            <option value="deporte_juventud">Deporte y juventud</option>
                            <option value="energia_gas">Mesa técnica de energía y gas</option>
                            <option value="agua">Mesa técnica de agua</option>
                            <option value="educacion_cultura">Educación, cultura y formación ciudadana</option>
                            <option value="habitat_tierra">Hábitat, vivienda y tierra</option>
                            <option value="medios_alternativos">Medios alternativos</option>
                            <option value="seguridad_defensa">Seguridad y defensa</option>
                            <option value="proteccion_nna">Protección de NNA</option>
                            <option value="salud">Salud</option>
                            <option value="planificacion">Planificación</option>
                            <option value="parlamento">Parlamento</option>
                        </optgroup>
                    `;
                    break;
                case "Vote_Type":
                    newField = document.createElement("select");
                    newField.innerHTML = `
                        <option selected disabled>Selecciona el tipo de voto</option>
                        <option value="Presencial">📑Presencial</option>
                        <option value="Asistido">👥Asistido</option>
                    `;
                    break;
                case "Sex":
                    newField = document.createElement("select");
                    newField.innerHTML = `
                        <option selected disabled>Selecciona tu género</option>
                        <option value="Masculino">🚹Masculino</option>
                        <option value="Femenino">🚺Femenino</option>
                    `;
                    break;
            }


            newField.id = "editCampo";
            createField.appendChild(newField);

        } else {
            // Mostrar el campo fijo si no es especial
            createField.style.display = "none";
            if (removeField) removeField.style.display = "block";
        }
    });

    createField.addEventListener("change", function (e) {
        if (e.target && e.target.id === "editCampo") {
            console.log("Valor elegido:", e.target.value);
        }
    });
}
