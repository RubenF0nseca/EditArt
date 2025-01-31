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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.update-cart').forEach(input => {
        input.addEventListener('change', async function () {
            const bookId = this.getAttribute('data-book-id');
            const newQuantity = parseInt(this.value, 10);

            if (newQuantity < 1 || isNaN(newQuantity)) {
                this.value = 1; // Impedir valores inválidos
                return;
            }

            try {
                const response = await fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        book_id: bookId,
                        quantity: newQuantity
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Atualiza a quantidade no input
                    this.value = data.quantity;

                    // Atualiza a linha correta no DOM
                    const cartRow = document.querySelector(`tr[data-book-id="${bookId}"]`);
                    if (cartRow) {
                        cartRow.querySelector('.line-total').textContent = data.lineTotal + " €";
                    }

                    // Atualiza subtotal e total do carrinho
                    document.querySelector('#subtotal').textContent = data.subtotal + " €";
                    document.querySelector('#total').textContent = data.total + " €";
                }
            } catch (error) {
                console.error('Erro ao atualizar o carrinho:', error);
            }
        });
    });
});
