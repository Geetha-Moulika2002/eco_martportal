<?php
include("../config/db.php");

$res = mysqli_query($con, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Products</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="products">
<?php while ($p = mysqli_fetch_assoc($res)) { ?>
    <div class="card">
        <h3><?= $p['name'] ?></h3>
        <p>₹<?= $p['price'] ?></p>
        <a class="btn" href="place_order.php?id=<?= $p['product_id'] ?>">Buy</a>
    </div>
<?php } ?>
</div>

</body>
</html>
