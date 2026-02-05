<?php
include("../config/db.php");  

if (isset($_POST['update'])) {
    $pid = $_POST['pid'];
    $stock = $_POST['stock'];
    mysqli_query($con, "UPDATE products SET stock=$stock WHERE product_id=$pid");
}

$res = mysqli_query($con, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Inventory</title>
<style>
body{
    font-family:'Segoe UI',sans-serif;
    background:#f4f6f8;
}
.container{
    max-width:1000px;
    margin:40px auto;
}
h2{
    text-align:center;
    margin-bottom:20px;
}
table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    border-radius:10px;
    overflow:hidden;
}
th,td{
    padding:15px;
    text-align:center;
}
th{
    background:#2e7d32;
    color:#fff;
}
tr:nth-child(even){
    background:#f2f2f2;
}
input[type=number]{
    width:70px;
    padding:6px;
}
button{
    background:#2e7d32;
    color:#fff;
    border:none;
    padding:8px 15px;
    border-radius:6px;
    cursor:pointer;
}
button:hover{
    background:#1b5e20;
}
</style>
</head>

<body>
<div class="container">
<h2>📊 Manage Inventory</h2>

<table>
<tr>
    <th>ID</th><th>Name</th><th>Stock</th><th>Update</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($res)) { ?>
<tr>
<form method="post">
    <td><?= $row['product_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td>
        <input type="number" name="stock" value="<?= $row['stock'] ?>">
    </td>
    <td>
        <input type="hidden" name="pid" value="<?= $row['product_id'] ?>">
        <button name="update">Update</button>
    </td>
</form>
</tr>
<?php } ?>
</table>
</div>
</body>
</html>
