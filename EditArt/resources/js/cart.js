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
