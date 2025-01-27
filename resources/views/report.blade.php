<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            position: relative;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #444;
        }

        .charts {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .chart-card canvas {
            max-height: 350px;
        }

        .download-btn {
            position: absolute;
            top: 10px;
            right: 20px;
            background-color: #4287f5;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #fafafa;
            color:#666;
            font-size: 14px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .download-btn:hover {
            background-color: #326fd1;
        }

        @media (max-width: 768px) {
            .charts {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <button class="download-btn" id="downloadBtn">Download Report</button>
        <h1>Order Payment and Sales Insights</h1>

        <div class="charts">
            <!-- Payment Methods Pie Chart -->
            <div class="chart-card">
                <h2>Payment Methods Distribution</h2>
                <canvas id="paymentChart"></canvas>
            </div>

            <!-- Items and Quantities Bar Chart -->
            <div class="chart-card">
                <h2>Sold Items</h2>
                <canvas id="quantityChart"></canvas>
            </div>
        </div>
    </div>
    <footer>
        ©️ by Café Modern Bites | foodix®️, All Rights Reserved.
    </footer>

    <script>
        // Data for Pie Chart
        var paymentMethods = @json($orders->pluck('payment_method'));
        var paymentTotals = @json($orders->pluck('total')).map(Number);

        var paymentCtx = document.getElementById('paymentChart').getContext('2d');
        var paymentChart = new Chart(paymentCtx, {
            type: 'pie',
            data: {
                labels: paymentMethods,
                datasets: [{
                    label: 'Payment Methods',
                    data: paymentTotals,
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FFC300', '#C70039'],
                    hoverOffset: 10,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = parseFloat(context.raw) || 0;
                                const total = paymentTotals.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${context.label}: ${percentage}%`;
                            }
                        }
                    }
                }
            }
        });

        // Data for Bar Chart
        var itemNames = @json($quantityData->pluck('name'));
        var quantities = @json($quantityData->pluck('total_quantity')).map(Number);

        var quantityCtx = document.getElementById('quantityChart').getContext('2d');
        var quantityChart = new Chart(quantityCtx, {
            type: 'bar',
            data: {
                labels: itemNames,
                datasets: [{
                    label: 'Quantities Sold',
                    data: quantities,
                    backgroundColor: '#4287f5',
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Items',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantities Sold',
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });

        // Download Report Functionality
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            pdf.text('Order Payment and Sales Insights', 10, 10);

            // Add the first chart
            const paymentChartCanvas = document.getElementById('paymentChart');
            pdf.addImage(paymentChartCanvas.toDataURL('image/png'), 'PNG', 10, 20, 90, 60);

            // Add the second chart
            const quantityChartCanvas = document.getElementById('quantityChart');
            pdf.addImage(quantityChartCanvas.toDataURL('image/png'), 'PNG', 10, 90, 90, 60);

            pdf.save('  ©️ by Café Modern Bites | foodix®️, All Rights Reserved..pdf');
        });
    </script>
</body>
</html>
