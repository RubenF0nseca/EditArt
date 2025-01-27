import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function () {
    // Configurar o editor Quill
    const quill = new Quill('#editor-container-2', {
        theme: 'snow',
        placeholder: 'Escreva a sua avaliação aqui...',
        modules: {
            toolbar: [
                [{ header: [1, 2, false] }],
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                ['link', 'blockquote', 'image'],
            ],
        },
    });

    // Capturar o conteúdo do editor no formulário
    const form = document.querySelector('#review-form');
    const contentInput = document.querySelector('#content');
    const ratingInput = document.querySelector('#rating');
    const stars = document.querySelectorAll('.fa-star');

    if (form && contentInput) {
        form.addEventListener('submit', function () {
            contentInput.value = quill.root.innerHTML; // Capturar o conteúdo do editor
        });
    }

    // Configurar as estrelas
    stars.forEach(star => {
        star.addEventListener('click', function () {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating; // Definir a classificação
            stars.forEach(s => s.classList.remove('selected')); // Resetar as classes
            this.classList.add('selected'); // Adicionar classe na estrela clicada

            // Adicionar a classe "selected" para todas as estrelas anteriores
            let previousSibling = this.previousElementSibling;
            while (previousSibling) {
                previousSibling.classList.add('selected');
                previousSibling = previousSibling.previousElementSibling;
            }
        });
    });
});
