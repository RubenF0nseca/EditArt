import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function () {
    const quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Start typing here...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ['link', 'image']
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
