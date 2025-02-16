<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Insights</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        /* Existing styles */
        .chart-container {
            width: 80%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .chart-wrapper {
            position: relative;
            height: 400px;
            width: 100%;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .download-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 200px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .download-btn:hover {
            background-color: #45a049;
        }

        #loading {
            display: none;
            text-align: center;
            margin: 10px 0;
            color: #666;
        }

        /* New footer styles */
        .footer {
            margin-top: auto;
            text-align: center;
            padding: 20px;
            background-color: #fffdfd;
            width: 100%;
            position: relative;
            left: 0;
            bottom: 0;
            box-sizing: border-box;
        }

        .footer p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        #charts-container {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
    <div id="charts-container">
        <div class="chart-container">
            <h2>Peak Hours</h2>
            <div class="chart-wrapper">
                <canvas id="peakHoursChart"></canvas>
            </div>
        </div>

        <div class="chart-container">
            <h2>Peak Days</h2>
            <div class="chart-wrapper">
                <canvas id="peakDaysChart"></canvas>
            </div>
        </div>

        <div class="chart-container">
            <h2>Most Sold Items</h2>
            <div class="chart-wrapper">
                <canvas id="mostSoldChart"></canvas>
            </div>
        </div>
    </div>

    <button class="download-btn" onclick="downloadPDF()">Download Report</button>
    <div id="loading">Generating PDF...</div>

    <footer class="footer">
        <p>©️ by Café Modern Bites | foodix®️, All Rights Reserved.</p>
    </footer>

    <script>
        // Your existing JavaScript code remains the same
        async function fetchData() {
            try {
                const response = await axios.get('http://192.168.8.199:5000/get_insights');
                const data = response.data;

                Chart.defaults.responsive = true;
                Chart.defaults.maintainAspectRatio = false;

                // Peak Hours Chart
                new Chart(document.getElementById('peakHoursChart'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data.peak_hours),
                        datasets: [{
                            label: 'Peak Hours',
                            data: Object.values(data.peak_hours),
                            backgroundColor: 'rgba(54, 162, 235, 0.6)'
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });

                // Peak Days Chart
                new Chart(document.getElementById('peakDaysChart'), {
                    type: 'bar',
                    data: {
                        labels: Object.keys(data.peak_days),
                        datasets: [{
                            label: 'Peak Days',
                            data: Object.values(data.peak_days),
                            backgroundColor: 'rgba(75, 192, 192, 0.6)'
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'top',
                            }
                        }
                    }
                });

                // Most Sold Items Chart
                const top10Items = Object.keys(data.most_sold_items).slice(0, 10);
                const top10Values = Object.values(data.most_sold_items).slice(0, 10);

                new Chart(document.getElementById('mostSoldChart'), {
                    type: 'pie',
                    data: {
                        labels: top10Items,
                        datasets: [{
                            label: 'Most Sold Items',
                            data: top10Values,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.6)',
                                'rgba(54, 162, 235, 0.6)',
                                'rgba(255, 206, 86, 0.6)',
                                'rgba(75, 192, 192, 0.6)',
                                'rgba(153, 102, 255, 0.6)',
                                'rgba(255, 159, 64, 0.6)',
                                'rgba(105, 105, 255, 0.6)',
                                'rgba(0, 206, 209, 0.6)',
                                'rgba(255, 140, 0, 0.6)',
                                'rgba(128, 0, 128, 0.6)'
                            ]
                        }]
                    },
                    options: {
                        plugins: {
                            legend: {
                                position: 'right'
                            }
                        }
                    }
                });
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        async function downloadPDF() {
            const { jsPDF } = window.jspdf;
            const loading = document.getElementById('loading');
            loading.style.display = 'block';

            try {
                const pdf = new jsPDF('p', 'mm', 'a4');
                const container = document.getElementById('charts-container');
                const charts = container.getElementsByClassName('chart-container');
                
                for (let i = 0; i < charts.length; i++) {
                    if (i > 0) {
                        pdf.addPage();
                    }

                    const canvas = await html2canvas(charts[i], {
                        scale: 2,
                        useCORS: true,
                        logging: false
                    });

                    const imgData = canvas.toDataURL('image/jpeg', 1.0);
                    const pdfWidth = pdf.internal.pageSize.getWidth();
                    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;

                    pdf.addImage(imgData, 'JPEG', 0, 0, pdfWidth, pdfHeight);
                }

                const date = new Date();
                const timestamp = date.toISOString().split('T')[0];
                pdf.save(`Restaurant_Insights_${timestamp}.pdf`);
            } catch (error) {
                console.error('Error generating PDF:', error);
                alert('Error generating PDF. Please try again.');
            } finally {
                loading.style.display = 'none';
            }
        }

        fetchData();
    </script>
</body>
</html>