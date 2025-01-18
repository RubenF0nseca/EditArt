import Quill from 'quill';
import 'quill/dist/quill.snow.css';

// editor escolhemos o tema aqui e o que queremos que o editor faça
document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Start typing here...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
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
