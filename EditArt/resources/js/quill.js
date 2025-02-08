import Quill from 'quill';
import 'quill/dist/quill.snow.css';

document.addEventListener('DOMContentLoaded', function () {
    const showEditor = document.getElementById('show-editor-2');
    const editorForm = document.getElementById('editor-form-2');

    showEditor.addEventListener('click', function () {
        editorForm.style.display = 'block';
        showEditor.style.display = 'none';
    });

    // Configurar o editor Quill
    const quill = new Quill('#editor-container-2', {
        theme: 'snow',
        placeholder: 'Escreva a sua avaliação aqui...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ list: 'ordered' }, { list: 'bullet' }],
            ],
        },

    });

    // Capturar o conteúdo do editor no formulário
    const form = document.querySelector('#review-form');
    const contentInput = document.querySelector('#comment');
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

/*
document.addEventListener('DOMContentLoaded', function () {
    //
    // 1) Mostrar/ocultar os formulários de edição
    //
    const showEditorButtons = document.querySelectorAll('.show-editor-3');
    const editorForms = document.querySelectorAll('.editor-form-3');
    const closeEditorButtons = document.querySelectorAll('.close-editor');

    showEditorButtons.forEach((button, index) => {
        button.addEventListener('click', () => {
            editorForms[index].style.display = 'block';
            // Se quiseres esconder o botão "Editar" depois de abrir:
            // button.style.display = 'none';
        });
    });

    closeEditorButtons.forEach((closeBtn, index) => {
        closeBtn.addEventListener('click', () => {
            editorForms[index].style.display = 'none';
            // Para voltar a mostrar o botão "Editar":
            // showEditorButtons[index].style.display = 'inline-block';
        });
    });

    //
    // 2) Instanciar Quill para cada container (um para cada review)
    //
    const quillContainers = document.querySelectorAll('.editor-container-3');

    quillContainers.forEach(container => {
        // Nova instância do Quill
        const quill = new Quill('#' + container.id, {
            theme: 'snow',
            placeholder: 'Escreva a sua avaliação...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                ],
            },
        });

        // Carregar o conteúdo inicial guardado em data-initial-content
        const initialContent = container.getAttribute('data-initial-content') || '';
        quill.root.innerHTML = initialContent;

        // Ao submeter o form, copiar esse HTML para o input hidden
        const editorFormDiv = container.closest('.editor-form-3');
        if (editorFormDiv) {
            const form = editorFormDiv.querySelector('form');
            const hiddenInput = editorFormDiv.querySelector('.comment-edit');
            if (form && hiddenInput) {
                form.addEventListener('submit', function () {
                    hiddenInput.value = quill.root.innerHTML;
                });
            }
        }
    });

    //
    // 3) Configurar as estrelas de rating em cada formulário
    //
    editorForms.forEach(formDiv => {
        const stars = formDiv.querySelectorAll('.fa-star');
        const ratingInput = formDiv.querySelector('.rating-edit');

        stars.forEach(star => {
            star.addEventListener('click', function () {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating; // define o valor no input hidden

                // Remove 'selected' de todas
                stars.forEach(s => s.classList.remove('selected'));
                // Adiciona em todas as estrelas até a clicada
                this.classList.add('selected');
                let previous = this.previousElementSibling;
                while (previous) {
                    previous.classList.add('selected');
                    previous = previous.previousElementSibling;
                }
            });
        });
    });

});

*/

document.addEventListener('DOMContentLoaded', function () {
    const reviewsContainer = document.querySelector('.reviews-section');
    const paginationContainer = document.querySelector('#reviews-pagination');

    // 1. Delegar paginação
    if (paginationContainer) {
        paginationContainer.addEventListener('click', function (event) {
            const paginationLink = event.target.closest('.pagination a');
            if (paginationLink) {
                event.preventDefault();
                handlePagination(paginationLink.href);
            }
        });
    }

    async function handlePagination(url) {
        try {
            const response = await fetch(url, {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            });

            if (!response.ok) throw new Error('Network error');

            const { html, pagination } = await response.json();

            // Atualizar conteúdo e paginação
            reviewsContainer.innerHTML = html;
            paginationContainer.innerHTML = pagination;

            initQuillEditors();
            initStarRating();

            window.history.pushState({}, '', url);

        } catch (error) {
            console.error('Erro:', error);
        }
    }

    // 2. Delegação para edição de formulários
    reviewsContainer.addEventListener('click', function (event) {
        const target = event.target;

        // Mostrar formulário
        if (target.closest('.show-editor-3')) {
            const form = target.closest('.review-post').querySelector('.editor-form-3');
            if (form) form.style.display = 'block';
        }

        // Ocultar formulário
        if (target.closest('.close-editor')) {
            const form = target.closest('.editor-form-3');
            if (form) form.style.display = 'none';
        }
    });

    // 3. Inicializar Quill
    function initQuillEditors() {
        document.querySelectorAll('.editor-container-3:not(.initialized)').forEach(container => {
            const quill = new Quill(container, {
                theme: 'snow',
                placeholder: 'Escreva a sua avaliação...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                    ],
                },
            });

            quill.root.innerHTML = container.dataset.initialContent || '';

            const form = container.closest('form');
            const hiddenInput = form.querySelector('.comment-edit');
            form.addEventListener('submit', () => {
                hiddenInput.value = quill.root.innerHTML;
            });

            container.classList.add('initialized');
        });
    }

    // 4. Delegação de classificação por estrelas
    function initStarRating() {
        reviewsContainer.addEventListener('click', function (event) {
            const star = event.target.closest('.fa-star[data-rating]');
            if (!star) return;

            const form = star.closest('.editor-form-3');
            const ratingInput = form.querySelector('.rating-edit');
            const stars = form.querySelectorAll('.fa-star');
            const rating = parseInt(star.dataset.rating);

            ratingInput.value = rating;
            stars.forEach((s, index) => {
                s.classList.toggle('selected', index < rating);
            });
        });
    }

    initQuillEditors();
    initStarRating();
});
