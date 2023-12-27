const chartElement = document.getElementById('chart');

new Chart(chartElement, {
    type: 'bar',
    data: {
        datasets: [{
            label: 'przychód w ciągu ostatnich 12 miesięcy (w PLN) ',
            data: orderEveryMonth,
            borderWidth: 2,
            backgroundColor: '#05489b'
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
