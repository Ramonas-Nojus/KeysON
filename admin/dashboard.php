<?php include '../inlcudes/autoload.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.css">
    <link rel="stylesheet" href="./style/dashboard.css">
</head>
<body>

<?php 
    
    $order = new Order;

    $graphData = $order->getGraphData();

    $statusData = $order->getStatusData();

    $dates = [];
    $prices = [];

    foreach ($graphData as $row) {
        $dates[] = $row['order_date'];
        $prices[] = $row['total_price'];
        $orders[] = $row['order_count'];
    }
    
    ?>

<header>
        <div class="logo">
            <img src="/img/logo-no-background-2.png" alt="Your Logo">
        </div>
        <nav>
            <ul>
                <li><a class="dropbtn" href="/">Home</a></li>
                <li><a class="dropbtn" href="/admin/">Orders</a></li>
                <li><a class="dropbtn" href="/admin/my_orders.php">My Assigned Orders</a></li>
                <li><a class="dropbtn" href="/admin/dashboard.php">Dashboard</a></li>
                <li><a class="dropbtn" href="/admin/logout.php">Logout</a></li>
            </ul>
        </nav>
</header>
    <div class="container">
        <h1>Analytics</h1>

        <div class="grid">
            <div class="chart-container">
                <h3>Profit</h3>
                <canvas id="profitChart"></canvas>
            </div>
            
            <div class="chart-container">
                <h3>Orders</h3>
                <canvas id="ordersChart"></canvas>
            </div>
        </div>

        <div class="center">
            <div class="order-status">
                <div class="complete">
                    <h3>Complete Orders</h3>
                    <div class="count"><?php  echo $statusData[0]['order_complete']; ?></div>
                </div>
                <div class="incomplete">
                    <h3>Incomplete Orders</h3>
                    <div class="count"><?php echo $statusData[0]['order_incomplete']; ?></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

   

    <script>
        // JavaScript code for initializing and rendering charts
        document.addEventListener('DOMContentLoaded', function () {
            // Placeholder data for charts
            const profitData = {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Profit',
                    data: <?php echo json_encode($prices); ?>,
                    backgroundColor: 'rgba(125,17,185,1)',
                    borderColor: 'rgba(125,17,185,1)',
                    borderWidth: 5
                }]
            };

            const ordersData = {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: 'Orders',
                    data: <?php echo json_encode($orders); ?>,
                    backgroundColor: 'rgba(125,17,185,1)',
                    borderColor: 'rgba(125,17,185,1)',
                    borderWidth: 5
                }]
            };

            // Render profit chart
            const profitCtx = document.getElementById('profitChart').getContext('2d');
            const profitChart = new Chart(profitCtx, {
                type: 'line',
                data: profitData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            // Render orders chart
            const ordersCtx = document.getElementById('ordersChart').getContext('2d');
            const ordersChart = new Chart(ordersCtx, {
                type: 'line',
                data: ordersData,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });

            const customLegend = document.getElementById('custom-legend');
            profitData.labels.forEach((label, index) => {
                const item = document.createElement('div');
                item.classList.add('legend-item');

                const colorBox = document.createElement('span');
                colorBox.classList.add('color-box');
                colorBox.style.backgroundColor = profitChart.data.datasets[0].backgroundColor[index]; // Set color from dataset
                item.appendChild(colorBox);

                const text = document.createElement('span');
                text.textContent = label;
                item.appendChild(text);

                customLegend.appendChild(item);
            });

            // Add additional charts as needed
        });
    </script>
</body>
</html>
