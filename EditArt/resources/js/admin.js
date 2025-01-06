document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-authors");
    const dropdown = document.getElementById("dropdown-authors");
    const selectedContainer = document.getElementById("selected-authors");
    const hiddenInput = document.getElementById("authors");

    // Inicializar autores selecionados a partir do valor do input oculto
    let selectedAuthors = hiddenInput.value ? hiddenInput.value.split(',') : [];

    // Mostrar/esconder dropdown
    searchInput.addEventListener("focus", () => {
        dropdown.style.display = "block";
    });

    searchInput.addEventListener("blur", () => {
        setTimeout(() => {
            dropdown.style.display = "none";
        }, 200);
    });

    // Filtrar itens do dropdown
    searchInput.addEventListener("input", function () {
        const filter = searchInput.value.toLowerCase();
        const items = dropdown.querySelectorAll(".dropdown-item");

        items.forEach((item) => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? "block" : "none";
        });
    });

    // Selecionar item do dropdown
    dropdown.addEventListener("click", function (e) {
        if (e.target.classList.contains("dropdown-item")) {
            const selectedValue = e.target.getAttribute("data-value");
            const selectedText = e.target.textContent;

            if (!selectedAuthors.includes(selectedValue)) {
                selectedAuthors.push(selectedValue);
                updateHiddenInput();
                addTag(selectedValue, selectedText);
            }

            searchInput.value = "";
            dropdown.style.display = "none";
        }
    });

    // Função para criar uma tag do autor selecionado
    function addTag(value, text) {
        const tag = document.createElement("div");
        tag.classList.add("author-tag");
        tag.textContent = text;

        const removeBtn = document.createElement("span");
        removeBtn.classList.add("remove-tag");
        removeBtn.textContent = "x";
        removeBtn.setAttribute("data-value", value);

        removeBtn.addEventListener("click", function () {
            selectedAuthors = selectedAuthors.filter((id) => id !== value);
            updateHiddenInput();
            tag.remove();
        });

        tag.appendChild(removeBtn);
        selectedContainer.appendChild(tag);
    }

    // Função para atualizar o input oculto
    function updateHiddenInput() {
        hiddenInput.value = selectedAuthors.join(',');
    }

    // Adicionar evento para remover tags existentes
    const removeTags = document.querySelectorAll(".remove-tag");
    removeTags.forEach((btn) => {
        btn.addEventListener("click", function () {
            const value = btn.getAttribute("data-value");
            selectedAuthors = selectedAuthors.filter((id) => id !== value);
            updateHiddenInput();
            btn.parentElement.remove();
        });
    });
});
