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
    // Leer valor de la cédula y redirigir inmediatamente
    const cedula = document.getElementById("edit_ID_CI").value;
    if (!cedula) {
        alert('Ingrese una cédula válida antes de confirmar.');
        return false;
    }
    // Redirigir vía GET (controller espera cedula en query string)
const choiceUpdate = document.getElementById("choice-update").value;
    if (!choiceUpdate) {
        alert('Seleccione una opción válida antes de confirmar.');
        return false;
    }
const updateField = document.getElementById("editCampo").value.trim();
    if (!updateField) {
        alert('Ingrese el nuevo valor para actualizar.');
        return false;
    }


    // Redirigir vía GET con ambos parámetros
    const url = "../../../controller/register-civil/update.php?cedula=" 
                + encodeURIComponent(cedula) 
                + "&choiceUpdate=" 
                + encodeURIComponent(choiceUpdate)
                + "&UPDATE_FIELD=" 
                + encodeURIComponent(updateField);


    window.location.href = url;
}  
function changeInput() {
    const campo = document.getElementById("choice-update");
    const contenedor = document.getElementById("dialog-edit");
    const removeField = document.getElementById("div-input-update");
    const createField = document.getElementById("dinamic-input");

    campo.addEventListener("change", function () {
        // Limpiar el contenedor dinámico
        contenedor.remove.apply(removeField);
        createField.innerHTML = "";
        createField.style.display = 'flex';

        if (this.value === "Birth_Date") {
            const inputDate = document.createElement("input");
            inputDate.type = "date";
            inputDate.id = "editCampo";   // 👈 id fijo
            createField.appendChild(inputDate);

        } else if (this.value === "Voting_Center") {
            const selectCenter = document.createElement("select");
            selectCenter.id = "editCampo"; // 👈 id fijo
            selectCenter.innerHTML = `
                <option selected disabled>Selecciona el centro de votacion</option>
                <option value="Liceo Bolivariano Maestro Gallegos">🏫Liceo Bolivariano Maestro Gallegos</option>
                <option value="Caipa">🏢Caipa</option>
                <option value="Alicia Tremont de Medina">🏫Alicia Tremont de Medina</option>
                <option value="Inces">🏤Inces</option>
            `;
            createField.appendChild(selectCenter);
        }
        else if (this.value === "Committee_Name") {
            const selectComite = document.createElement("select");
            selectComite.id = "editCampo"; // 👈 id fijo
            selectComite.innerHTML = `
            <optgroup label="Seleccione un comite">
                <option value="alimentacion">Alimentación</option>
                <option value="economia_comunal">Economía comunal</option>
                <option value="empleo">Empleo</option>
                <option value="deporte_juventud">Deporte y juventud</option>
                <option value="energia_gas">Mesa técnica de energía y gas</option>
                <option value="agua">Mesa técnica de agua</option>
                <option value="educacion_cultura">Comité de Educación cultura y formación ciudadana</option>
                <option value="habitat_tierra">Habita viviendo y tierra</option>
                <option value="medios_alternativos">Medios alternativos</option>
                <option value="seguridad_defensa">Seguridad y defensa</option>
                <option value="proteccion_nna">Protección de niño niñas adolescentes</option>
                <option value="salud">Salud</option>
                <option value="planificacion">Planificación</option>
                <option value="parlamento">Parlamento</option>
            </optgroup>
            `;
            createField.appendChild(selectComite);
        }
        else if (this.value === "Vote_Type") {
            const selectVote = document.createElement("select");
            selectVote.id = "editCampo"; // 👈 id fijo
            selectVote.innerHTML = `
                <option selected disabled>Selecciona el tipo de voto</option>
                <option value="Presencial">📑Presencial</option>
                <option value="Asistido">👥Asistido</option>
            `;
            createField.appendChild(selectVote);
        }
        else if (this.value === "Sex") {
            const selectGender = document.createElement("select");
            selectGender.id = "editCampo"; // 👈 id fijo
            selectGender.innerHTML = `
                <option selected disabled>Selecciona tu genero</option>
                <option value="Masculino">🚹Masculino</option>
                <option value="Femenino">🚺Femenino</option>
            `;
            createField.appendChild(selectGender);
        }
    });
}