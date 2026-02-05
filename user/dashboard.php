<?php
include("../config/db.php");

// Get user's latest orders
$res = mysqli_query($con, "SELECT o.order_id, p.name AS product, o.quantity, o.carbon_footprint, o.status
                            FROM orders o
                            JOIN products p ON o.product_id = p.product_id
                            WHERE o.user_id = ".$_SESSION['user']['id']."
                            ORDER BY o.order_id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .orders-table {width:100%; max-width:800px; margin:20px auto; border-collapse:collapse; background:#fff;}
        .orders-table th, .orders-table td {padding:12px; border:1px solid #ddd; text-align:center;}
        .orders-table th {background:#2ecc71; color:#fff;}
        .status {font-weight:bold;}
        .status.Pending {color:#f39c12;}
        .status.Processing {color:#2980b9;}
        .status.Shipped {color:#8e44ad;}
        .status["Out for Delivery"] {color:#d35400;}
        .status.Delivered {color:#27ae60;}
    </style>
</head>
<body>
<div class="dashboard">
    <h1>Welcome 🌱</h1>
    <a href="products.php">Browse Products</a>
    <a href="eco_impact.php">Eco Impact</a>
    <a href="../auth/logout.php">Logout</a>

    <h2>Your Orders & Tracking</h2>
    <table class="orders-table">
        <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Carbon (kg)</th>
            <th>Status</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($res)){ ?>
        <tr>
            <td><?= $row['order_id'] ?></td>
            <td><?= $row['product'] ?></td>
            <td><?= $row['quantity'] ?></td>
            <td><?= $row['carbon_footprint'] ?></td>
            <td class="status <?= str_replace(' ','_',$row['status']) ?>"><?= $row['status'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
