<?php
include("../config/db.php");

// Fetch user orders for graph
$res = mysqli_query($con, "SELECT order_id, carbon_footprint, created_at 
                            FROM orders 
                            WHERE user_id=".$_SESSION['user']['id']." 
                            ORDER BY created_at ASC");

$order_ids = [];
$carbon_values = [];
while($row = mysqli_fetch_assoc($res)){
    $order_ids[] = $row['order_id'];
    $carbon_values[] = $row['carbon_footprint'];
}

// Fetch total carbon footprint
$total_res = mysqli_query($con, "SELECT SUM(carbon_footprint) as total FROM orders WHERE user_id=".$_SESSION['user']['id']);
$total_row = mysqli_fetch_assoc($total_res);
$total_carbon = $total_row['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Eco Impact</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body{
            font-family:'Segoe UI',sans-serif;
            background:#f4fff6;
            padding:20px;
            text-align:center;
        }
        h2{margin-bottom:15px;}
        .total-carbon{
            font-size:20px;
            font-weight:bold;
            margin-bottom:20px;
            color:#2e7d32;
        }
        canvas{
            max-width:800px;
            margin:0 auto;
            background:#fff;
            padding:20px;
            border-radius:12px;
            box-shadow:0 5px 20px rgba(0,0,0,0.1);
        }
        a.btn{
            display:inline-block;
            margin-top:25px;
            text-decoration:none;
            padding:12px 20px;
            background:#27ae60;
            color:#fff;
            border-radius:8px;
        }
        a.btn:hover{opacity:0.9;}
    </style>
</head>
<body>
    <h2>🌍 Your Eco Impact</h2>
    <div class="total-carbon">Total Carbon Footprint: <?= $total_carbon ?> kg CO₂</div>
    <canvas id="ecoChart"></canvas>
    <br>
    <a class="btn" href="dashboard.php">Back to Dashboard</a>

    <script>
        const ctx = document.getElementById('ecoChart').getContext('2d');
        const ecoChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode($order_ids) ?>,
                datasets: [{
                    label: 'Carbon Footprint (kg CO₂)',
                    data: <?= json_encode($carbon_values) ?>,
                    backgroundColor: 'rgba(46, 125, 50, 0.7)',
                    borderColor: 'rgba(46, 125, 50, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Carbon Footprint (kg CO₂)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Order ID'
                        }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>
