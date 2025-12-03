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

