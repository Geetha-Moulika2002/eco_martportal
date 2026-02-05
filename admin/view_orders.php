<?php
include("../config/db.php");

// Handle status update
if(isset($_POST['update_status'])){
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];
    mysqli_query($con, "UPDATE orders SET status='$status' WHERE order_id=$order_id");
    header("Location: view_orders.php"); // refresh page
    exit;
}

$q = "SELECT o.order_id, u.name, p.name AS product, o.quantity, o.carbon_footprint, o.status, o.created_at 
      FROM orders o
      JOIN users u ON o.user_id = u.id
      JOIN products p ON o.product_id = p.product_id";
$res = mysqli_query($con, $q);
?>
<!DOCTYPE html>
<html>
<head>
<title>All Orders</title>
<style>
body{font-family:'Segoe UI',sans-serif;background:#f4f6f8;}
.container{max-width:1100px;margin:40px auto;}
h2{text-align:center;margin-bottom:20px;}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:10px;overflow:hidden;}
th,td{padding:14px;text-align:center;}
th{background:#3949ab;color:#fff;}
tr:nth-child(even){background:#f2f2f2;}
select, button {padding:5px 10px; border-radius:5px; border:1px solid #ccc; cursor:pointer;}
button {background:#27ae60;color:#fff; border:none;}
button:hover {opacity:0.9;}
</style>
</head>
<body>
<div class="container">
<h2>🧾 All Orders</h2>
<table>
<tr>
    <th>Order ID</th>
    <th>User</th>
    <th>Product</th>
    <th>Qty</th>
    <th>Carbon (kg)</th>
    <th>Status</th>
    <th>Date</th>
</tr>
<?php while ($row = mysqli_fetch_assoc($res)) { ?>
<tr>
    <td><?= $row['order_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['product'] ?></td>
    <td><?= $row['quantity'] ?></td>
    <td><?= $row['carbon_footprint'] ?></td>
    <td>
        <form method="post">
            <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
            <select name="status">
                <option value="Pending" <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                <option value="Processing" <?= $row['status']=='Processing'?'selected':'' ?>>Processing</option>
                <option value="Shipped" <?= $row['status']=='Shipped'?'selected':'' ?>>Shipped</option>
                <option value="Out for Delivery" <?= $row['status']=='Out for Delivery'?'selected':'' ?>>Out for Delivery</option>
                <option value="Delivered" <?= $row['status']=='Delivered'?'selected':'' ?>>Delivered</option>
            </select>
            <button name="update_status">Update</button>
        </form>
    </td>
    <td><?= $row['created_at'] ?></td>
</tr>
<?php } // <-- properly closed while loop ?>
</table>
</div>
</body>
</html>
