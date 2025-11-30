function deleteDialog(){
    const openDialogBtn = document.getElementById("delete-btn")
    const modal = document.getElementById('dialogDelete')

    openDialogBtn.addEventListener('click',(event) =>{
        event.preventDefault(); //para no enviar el formulario
        modal.showModal() //mostrar el formulario

    })

}

function closeDeleteDialog(){
    const closeDialogBtn = document.getElementById('close-btn');
    const modal = document.getElementById("dialogDelete");
    
    closeDialogBtn.addEventListener('click',(e)=>{
        e.preventDefault();
        modal.close();
    })

}
    // funciones del segundo dialog
    function confirmEliminateDialog(){
        const eliminateBtn = document.getElementById("eliminate")
        const modal = document.getElementById('dialog-delete-confirm')
    
        eliminateBtn.addEventListener('click',(event) =>{
            event.preventDefault(); //para no enviar el formulario
            modal.showModal() //mostrar el formulario
    
})
    
}
    function closeDialogTwo(){
        const closeBtn = document.getElementById('close')
        const twoDialog = document.getElementById('dialog-delete-confirm')

        closeBtn.addEventListener("click", () => {
            twoDialog.close();
        });
    }
    // hasta aca el segundo dialog
    function validarFormularioEliminar(){
        // Leer valor de la cédula y redirigir inmediatamente
        const cedula = document.getElementById("CI-DELETE").value;
        if(!cedula){
            alert('Ingrese una cédula válida antes de confirmar.');
            return false;
        }
        // Redirigir vía GET (controller espera cedula en query string)
        window.location.href = "../../../controller/register-civil/delete.php?cedula=" + encodeURIComponent(cedula);

    }