document.addEventListener("DOMContentLoaded", function () {
    function setupDropdown(searchInput, dropdown, selectedContainer, hiddenContainer, inputName) {
        let selectedArray = Array.from(hiddenContainer.querySelectorAll(`input[name="${inputName}[]"]`)).map(input => input.value);


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

                if (!selectedArray.includes(selectedValue)) {
                    selectedArray.push(selectedValue);

                    // input para envio no formulario
                    const hiddenInput = document.createElement("input");
                    hiddenInput.type = "hidden";
                    hiddenInput.name = `${inputName}[]`;
                    hiddenInput.value = selectedValue;
                    hiddenContainer.appendChild(hiddenInput);

                    // Criar a tag
                    const tag = document.createElement("div");
                    tag.classList.add("author-tag");
                    tag.textContent = selectedText;

                    // btn remover a tag
                    const removeBtn = document.createElement("span");
                    removeBtn.classList.add("remove-tag");
                    removeBtn.textContent = "x";
                    removeBtn.setAttribute("data-value", selectedValue);
                    removeBtn.addEventListener("click", function () {
                        selectedArray = selectedArray.filter(id => id !== selectedValue);
                        hiddenInput.remove();
                        tag.remove();
                    });

                    tag.appendChild(removeBtn);
                    selectedContainer.appendChild(tag);
                }

                searchInput.value = "";
                dropdown.style.display = "none";
            }
        });

        // Remover tags ja selecionadas
        selectedContainer.addEventListener("click", function (e) {
            if (e.target.classList.contains("remove-tag")) {
                const value = e.target.getAttribute("data-value");
                selectedArray = selectedArray.filter(id => id !== value);

                hiddenContainer.querySelector(`input[value="${value}"]`).remove();
                e.target.parentElement.remove();
            }
        });
    }

    // Configurar dropdown de Autores
    setupDropdown(
        document.getElementById("search-authors"),
        document.getElementById("dropdown-authors"),
        document.getElementById("selected-authors"),
        document.getElementById("authors-container"),
        "authors"
    );

    // Configurar dropdown de Gêneros
    setupDropdown(
        document.getElementById("search-genres"),
        document.getElementById("dropdown-genres"),
        document.getElementById("selected-genres"),
        document.getElementById("genres-container"),
        "genres"
    );
});
