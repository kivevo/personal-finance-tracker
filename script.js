document.addEventListener('DOMContentLoaded', function () {
    // Example data for the charts
    const monthlySpendingData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Monthly Spending',
            data: [1200, 1500, 1300, 1600, 1400, 1800, 1700, 1900, 2000, 2100, 2200, 2300], // Example data
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    const categorySpendingData = {
        labels: ['Groceries', 'Rent', 'Utilities', 'Transportation', 'Entertainment'],
        datasets: [{
            label: 'Category Spending',
            data: [500, 1200, 300, 450, 250], // Example data
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
        }]
    };

    // Create the Monthly Spending Chart
    const monthlySpendingCtx = document.getElementById('monthlySpendingChart').getContext('2d');
    new Chart(monthlySpendingCtx, {
        type: 'bar',
        data: monthlySpendingData,
        options: {
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Create the Category Spending Chart
    const categorySpendingCtx = document.getElementById('categorySpendingChart').getContext('2d');
    new Chart(categorySpendingCtx, {
        type: 'pie',
        data: categorySpendingData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return `${tooltipItem.label}: $${tooltipItem.raw}`;
                        }
                    }
                }
            }
        }
    });
});
