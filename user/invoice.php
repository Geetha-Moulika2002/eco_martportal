<?php 
include("../config/db.php");    

$res = mysqli_query($con, "
    SELECT o.order_id, p.name, p.price, o.quantity, o.carbon_footprint, o.status
    FROM orders o
    JOIN products p ON o.product_id = p.product_id
    WHERE o.user_id = ".$_SESSION['user']['id']."
    ORDER BY o.order_id DESC
    LIMIT 1
");    

$row = mysqli_fetch_assoc($res);  
$total = $row['price'] * $row['quantity'];  
?>  

<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body{
            margin:0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(120deg, #d4fc79, #96e6a1);
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        .invoice{
            background:#fff;
            padding:30px;
            width:350px;
            border-radius:12px;
            box-shadow:0 15px 40px rgba(0,0,0,0.2);
        }
        .invoice h2{
            text-align:center;
            margin-bottom:20px;
            color:#2e7d32;
        }
        .invoice p{
            font-size:15px;
            margin:10px 0;
            display:flex;
            justify-content:space-between;
        }
        .invoice p b{
            color:#333;
        }
        .total{
            font-size:18px;
            font-weight:bold;
            margin-top:15px;
            color:#1b5e20;
        }
        .btn{
            display:block;
            margin-top:25px;
            text-align:center;
            background:#2e7d32;
            color:#fff;
            padding:12px;
            border-radius:8px;
            text-decoration:none;
            font-weight:bold;
        }
        .btn:hover{
            background:#1b5e20;
        }
    </style>
</head>
<body>
<div class="invoice">
    <h2>🧾 Invoice</h2>
    
    <p><b>Order ID</b><span><?= $row['order_id'] ?></span></p>
    <p><b>Product</b><span><?= $row['name'] ?></span></p>
    <p><b>Price</b><span>₹<?= $row['price'] ?></span></p>
    <p><b>Quantity</b><span><?= $row['quantity'] ?></span></p>

    <p class="total"><b>Total</b><span>₹<?= $total ?></span></p>

    <p><b>Carbon Impact</b><span><?= $row['carbon_footprint'] ?> kg CO₂</span></p>
    
    <!-- NEW STATUS LINE -->
    <p><b>Status</b><span><?= $row['status'] ?></span></p>

    <a class="btn" href="dashboard.php">Back to Dashboard</a>
</div>
</body>
</html>
