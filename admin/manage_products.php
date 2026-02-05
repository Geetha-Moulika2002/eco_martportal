<?php 
include("../config/db.php");

// Handle add product
if(isset($_POST['add'])){
    $name = $_POST['name'];
    $cat = $_POST['category'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    mysqli_query($con, "INSERT INTO products(name, category, price, stock, seller_id) 
                        VALUES('$name','$cat','$price','$stock',1)");
    header("Location: manage_products.php");
    exit;
}

// Handle delete product
if(isset($_GET['delete'])){
    $pid = $_GET['delete'];
    mysqli_query($con, "DELETE FROM products WHERE product_id=$pid");
    header("Location: manage_products.php");
    exit;
}

// Fetch all products
$res = mysqli_query($con, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Products</title>
    <style>
        body{font-family:'Segoe UI',sans-serif; background:#f4f6f8; padding:20px;}
        h2{text-align:center; margin-bottom:20px;}
        form, table{max-width:800px; margin:20px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 5px 15px rgba(0,0,0,0.1);}
        form input{padding:10px; margin:5px; border-radius:5px; border:1px solid #ccc;}
        form button{padding:10px 20px; background:#27ae60; color:#fff; border:none; border-radius:5px; cursor:pointer;}
        form button:hover{opacity:0.9;}
        table{width:100%; border-collapse:collapse;}
        th,td{padding:12px; border-bottom:1px solid #ddd; text-align:center;}
        th{background:#2ecc71; color:#fff;}
        tr:nth-child(even){background:#f2f2f2;}
        a.delete{background:#e74c3c; color:#fff; padding:5px 10px; border-radius:5px; text-decoration:none;}
        a.delete:hover{opacity:0.8;}
    </style>
</head>
<body>

<h2>Manage Products</h2>

<!-- ADD PRODUCT FORM -->
<form method="post">
    <input type="text" name="name" placeholder="Product Name" required>
    <input type="text" name="category" placeholder="Category" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="number" name="stock" placeholder="Stock" required>
    <button name="add">Add Product</button>
</form>

<!-- PRODUCT TABLE -->
<table>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Category</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Action</th>
</tr>
<?php while($row = mysqli_fetch_assoc($res)){ ?>
<tr>
    <td><?= $row['product_id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['category'] ?></td>
    <td>₹<?= $row['price'] ?></td>
    <td><?= $row['stock'] ?></td>
    <td>
        <a href="manage_products.php?delete=<?= $row['product_id'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
    </td>
</tr>
<?php } ?>
</table>

</body>
</html>
