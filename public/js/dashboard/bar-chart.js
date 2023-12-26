const chartElement = document.getElementById('chart');

new Chart(chartElement, {
    type: 'bar',
    data: {
        labels: ['st','lut','mrz','kw','maj','cz','lip','wrz','paź','lis','gr'],
        datasets: [{
            label: 'przychód w ciągu ostatnich 12 miesięcy (w PLN) ',
            data: [12, 19, 3, 5, 2, 3, 25],
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
