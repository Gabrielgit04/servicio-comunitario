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