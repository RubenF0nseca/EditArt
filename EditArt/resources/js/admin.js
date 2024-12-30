document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("search-authors");
    const dropdown = document.getElementById("dropdown-authors");
    const selectedContainer = document.getElementById("selected-authors");
    const hiddenInput = document.getElementById("authors");

    let selectedAuthors = []; // IDs dos autores selecionados

    // Mostrar/esconder dropdown
    searchInput.addEventListener("focus", () => {
        dropdown.style.display = "block";
    });

    searchInput.addEventListener("blur", () => {
        setTimeout(() => {
            dropdown.style.display = "none";
        }, 200); // Pequeno atraso para permitir clique nos itens
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

            // Verifica se o autor já foi selecionado
            if (!selectedAuthors.includes(selectedValue)) {
                selectedAuthors.push(selectedValue);

                // Adiciona o autor ao campo oculto
                hiddenInput.value = selectedAuthors.join(",");

                // Cria a tag do autor selecionado
                const tag = document.createElement("div");
                tag.classList.add("author-tag");
                tag.textContent = selectedText;

                // Botão para remover a tag
                const removeBtn = document.createElement("span");
                removeBtn.classList.add("remove-tag");
                removeBtn.textContent = "x";
                removeBtn.addEventListener("click", function () {
                    // Remove o autor selecionado
                    selectedAuthors = selectedAuthors.filter((id) => id !== selectedValue);
                    hiddenInput.value = selectedAuthors.join(",");
                    tag.remove();
                });

                tag.appendChild(removeBtn);
                selectedContainer.appendChild(tag);
            }

            // Limpa o campo de pesquisa e esconde o dropdown
            searchInput.value = "";
            dropdown.style.display = "none";
        }
    });
});
