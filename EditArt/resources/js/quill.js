import Quill from 'quill';
import 'quill/dist/quill.snow.css';

// Editor escolhemos o tema aqui e o que queremos que o editor faça
document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'O seu texto...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'blockquote', 'image']
            ]
        }
    });

    // Capturar dados para a BD
    const form = document.querySelector('form');
    const hiddenInput = document.querySelector('input[name="content"]');

    if (form && hiddenInput) {
        form.addEventListener('submit', function () {
            hiddenInput.value = quill.root.innerHTML;
        });
    }
});

// Editor para o fórum
document.addEventListener('DOMContentLoaded', function () {
    const showEditor = document.getElementById('show-editor');
    const editorForm = document.getElementById('editor-form');

    showEditor.addEventListener('click', function () {
        editorForm.style.display = 'block';
        showEditor.style.display = 'none';
    });

    const quill = new Quill('#editor-container-2', {
        theme: 'snow',
        placeholder: 'O seu texto...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'blockquote', 'image']
            ]
        }
    });

    // Capturar dados para a BD
    const form = document.querySelector('form');
    const hiddenInput = document.querySelector('input[name="content"]');
    const topicInput = document.querySelector('input[name="topic"]');

    if (form && hiddenInput && topicInput) {
        form.addEventListener('submit', function () {
            hiddenInput.value = quill.root.innerHTML;
        });
    }
});
