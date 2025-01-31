import './bootstrap';

/*=========================================================
    Função para edição de dados do utilizador no perfil
=========================================================== */
function toggleEdit() {
    const viewMode = document.getElementById('view-mode');
    const editMode = document.getElementById('edit-mode');

    if (viewMode.style.display === 'none') {
        viewMode.style.display = 'block';
        editMode.style.display = 'none';
        localStorage.setItem('editMode', 'false');
    } else {
        viewMode.style.display = 'none';
        editMode.style.display = 'block';
        localStorage.setItem('editMode', 'true');
    }
}

window.toggleEdit = toggleEdit;
window.onload = function() {
    const editMode = localStorage.getItem('editMode');

    if (editMode === 'true') {
        document.getElementById('view-mode').style.display = 'none';
        document.getElementById('edit-mode').style.display = 'block';
    } else {
        document.getElementById('view-mode').style.display = 'block';
        document.getElementById('edit-mode').style.display = 'none';
    }
};
