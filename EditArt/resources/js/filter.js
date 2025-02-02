/*======================================================================
    Pesquisa, paginação e seleção de géneros sem atualização de página
======================================================================== */
document.addEventListener("DOMContentLoaded", function () {
    /*----------------------------------------------------------
	   Pesquisa sem atualização de página
    ------------------------------------------------------------*/
    let searchInput = document.querySelector("#search-input");

    searchInput.addEventListener("input", function () {
        let query = this.value;

        // Criar URL com parâmetros
        const url = new URL(window.location.href);
        url.searchParams.set('title', query);
        if (!query) url.searchParams.delete('title'); // Limpe o parâmetro se a pesquisa estiver vazia

        fetch(`${url.toString()}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
            .then(response => response.json())
            .then(data => {
                document.querySelector("#books-container").innerHTML = data.html;
                window.history.pushState({}, '', url.toString()); // Atualizar URL
            })
            .catch(error => console.error("Erro:", error));
    });

    /*----------------------------------------------------------
	   Paginação sem atualização de página
    ------------------------------------------------------------*/
    document.addEventListener('click', function (event) {
        const paginationLink = event.target.closest('.pagination a');
        if (paginationLink) {
            event.preventDefault();

            // Adicionar parâmetros de pesquisa atuais ao URL de paginação
            const currentParams = new URLSearchParams(window.location.search);
            const pageUrl = new URL(paginationLink.href);

            // Transferimos todos os parâmetros atuais (título, género) para o URL de paginação
            currentParams.forEach((value, key) => {
                if (!pageUrl.searchParams.has(key)) {
                    pageUrl.searchParams.set(key, value);
                }
            });

            fetch(pageUrl.toString(), {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
                .then(response => response.json())
                .then(data => {
                    document.querySelector("#books-container").innerHTML = data.html;
                    window.history.pushState({}, '', pageUrl.toString());
                })
                .catch(error => console.error("Erro:", error));
        }
    });
    /*----------------------------------------------------------
	   Seleção de géneros sem atualização de página
    ------------------------------------------------------------*/
    document.addEventListener('click', function (event) {
        const genreLink = event.target.closest('.widget .icon-list a');
        if (genreLink) {
            event.preventDefault();

            // Obter ID de género do URL
            const url = new URL(genreLink.href);
            const genreId = url.searchParams.get('genre');

            // Atualizar URL atual com parâmetro de género
            const currentUrl = new URL(window.location.href);
            if (genreId) {
                currentUrl.searchParams.set('genre', genreId);
            } else {
                currentUrl.searchParams.delete('genre'); // Para "Todos os géneros"
            }

            fetch(currentUrl.toString(), {
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
                .then(response => response.json())
                .then(data => {
                    document.querySelector("#books-container").innerHTML = data.html;
                    window.history.pushState({}, '', currentUrl.toString());

                    // Atualize o campo de pesquisa se estiver no URL
                    const searchInput = document.querySelector('#search-input');
                    const searchParam = currentUrl.searchParams.get('title');
                    searchInput.value = searchParam || '';
                })
                .catch(error => console.error("Erro:", error));
        }
    });
});
