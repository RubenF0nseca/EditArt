document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.wishlist-toggle').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();  // Impede a propagação do evento
            // Se necessário, e.stopImmediatePropagation();

            const bookId = this.getAttribute('data-book-id');
            console.log('BookId:', bookId);
            if (this.classList.contains('add')) {
                fetch(`/client/wishlist/add/${bookId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('HTTP error, status = ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Resposta de remoção:', data, this);
                        if (data.success) {
                            this.classList.remove('add');
                            this.classList.add('remove');
                            this.innerHTML = '<i class="fa-solid fa-heart"></i>';
                        }
                    })
                    .catch(err => console.error('Erro no fetch (add):', err));
            } else if (this.classList.contains('remove')) {
                const button = this; // Armazene o elemento em uma variável
                const url = `/client/wishlist/remove/${bookId}`; // Use caminho relativo
                fetch(url, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('HTTP error, status = ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Resposta de remoção:', data, button);
                        if (data.success) {
                            button.classList.remove('remove');
                            button.classList.add('add');
                            button.innerHTML = '<i class="fa-regular fa-heart"></i>';
                        }
                    })
                    .catch(err => console.error('Erro no fetch (remove):', err));
            }
        });
    });
});
