/*======================================================================
    JS do Widget do Vendas
======================================================================== */

const ctx = document.getElementById('salesChart').getContext('2d');
const salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [
            {
                label: '2024',
                data: [10, 50, 250, 200, 500, 300, 400, 250, 500],
                borderColor: 'Teal',
                backgroundColor: 'rgba(0,128,128,0.51)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 3,
            },
            {
                label: '2025',
                data: [20, 40, 60, 200, 300, 350, 370, 300, 400],
                borderColor: 'salmon',
                backgroundColor: 'rgba(250,128,114,0.48)',
                tension: 0.4,
                fill: true,
                borderWidth: 2,
                pointRadius: 3,
            }
        ]
    },
    options: {
        responsive: true,
        animation: {
            duration: 2000,
            easing: 'easeInOutQuad'
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 600
            }
        }
    }
});
