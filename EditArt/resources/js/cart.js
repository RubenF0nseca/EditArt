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


                console.log("Dados recebidos:", data);

                if (data.success) {
                    const lineTotalElement = this.closest('tr').querySelector('.line-total');
                    if (lineTotalElement) {
                        lineTotalElement.textContent = data.lineTotal + " €";
                    }
                    // Atualiza todos os elementos
                    document.querySelector('#total-sem-iva').textContent = data.total_sem_iva + " €";
                    document.querySelector('#iva').textContent = data.iva + " €";
                    document.querySelector('#total-pagar').textContent = data.total_pagar + " €";
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        });
    });
});
