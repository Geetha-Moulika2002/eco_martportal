<?php include("../config/db.php"); ?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<style>
body{
    margin:0;
    font-family:'Segoe UI',sans-serif;
    background:linear-gradient(120deg,#a8edea,#fed6e3);
    min-height:100vh;
}
.dashboard{
    max-width:900px;
    margin:40px auto;
    padding:20px;
}
h1{
    text-align:center;
    margin-bottom:40px;
}
.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}
.card{
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,.15);
    text-align:center;
    transition:.3s;
}
.card:hover{
    transform:translateY(-5px);
}
.card a{
    text-decoration:none;
    color:#333;
    font-weight:bold;
    font-size:18px;
}
.icon{
    font-size:40px;
    margin-bottom:10px;
}
</style>
</head>

<body>
<div class="dashboard">
    <h1>⚙️ Admin Dashboard</h1>

    <div class="cards">
        <div class="card">
            <div class="icon">📦</div>
            <a href="manage_products.php">Manage Products</a>
        </div>

        <div class="card">
            <div class="icon">📊</div>
            <a href="manage_inventory.php">Inventory</a>
        </div>

        <div class="card">
            <div class="icon">🧾</div>
            <a href="view_orders.php">Orders</a>
        </div>
    </div>
</div>
</body>
</html>
