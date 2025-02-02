document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', async function() {
            const bookId = this.dataset.bookId;

            try {
                const response = await fetch(`/cart/add/${bookId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    document.getElementById('cart-counter').textContent = data.cartCount;

                    // Feedback visual -> TODO
                    Toastify({
                        text: data.message,
                        duration: 3000,
                        close: true,
                        backgroundColor: "#4CAF50"
                    }).showToast();
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        });
    });
});

// ----------------------------------------------------------
// update cart
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.update-cart').forEach(input => {
        input.addEventListener('change', async function() {
            const bookId = this.dataset.bookId;
            const newQuantity = parseInt(this.value, 10);

            // Bloquear input durante atualização
            this.disabled = true;
            const originalValue = this.value;
            this.value = 'Atualizando...';


            try {
                const response = await fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id: bookId,
                        quantity: newQuantity
                    })

                });

                const data = await response.json();

                if (data.success) {

                    // Atualizar valores dinamicamente
                    document.querySelectorAll(`[data-book-id="${bookId}"] .line-total`).forEach(el => {
                        el.textContent = data.lineTotal + ' €';
                    });

                    document.getElementById('total-sem-iva').textContent = data.total_sem_iva + ' €';
                    document.getElementById('iva').textContent = data.iva + ' €';
                    document.getElementById('total-pagar').textContent = data.total_pagar + ' €';
                    document.getElementById('shipping').textContent = data.shipping + ' €';
                }
            } catch (error) {
                console.error('Erro:', error);
            } finally {
                this.disabled = false;
                this.value = originalValue;
            }
        });
    });
});
