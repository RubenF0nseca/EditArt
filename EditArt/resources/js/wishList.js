document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.wishlist-toggle').forEach(function(el) {
        el.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            const bookId = this.getAttribute('data-book-id');
            console.log('BookId:', bookId);
            const origin = window.location.origin;
            const removeUrl = `${origin}/client/wishlist/remove/${bookId}`;
            console.log('URL de remoção (hardcode):', removeUrl);

            if (this.classList.contains('remove')) {
                // Usar POST com _method: 'DELETE'
                fetch(removeUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        _method: 'DELETE'
                    })
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
                            this.classList.remove('remove');
                            this.classList.add('add');
                            this.innerHTML = '<i class="fa-regular fa-heart"></i>';
                        }
                    })
                    .catch(err => console.error('Erro no fetch (remove):', err));
            } else if (this.classList.contains('add')) {
                // Lógica para adicionar permanece igual
                const addUrl = `${origin}/client/wishlist/add/${bookId}`;
                fetch(addUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('HTTP error, status = ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Resposta de adição:', data, this);
                        if (data.success) {
                            this.classList.remove('add');
                            this.classList.add('remove');
                            this.innerHTML = '<i class="fa-solid fa-heart"></i>';
                        }
                    })
                    .catch(err => console.error('Erro no fetch (add):', err));
            }
        });
    });
});

