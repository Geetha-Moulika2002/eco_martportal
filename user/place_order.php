<?php
include("../config/db.php");

$id = $_GET['id'];

if(isset($_POST['order'])){
  $qty = $_POST['qty'];
  $carbon = $qty * 0.5;

  mysqli_query($con,"
    INSERT INTO orders(user_id,product_id,quantity,address,carbon_footprint)
    VALUES(
      {$_SESSION['user']['id']},
      $id,
      $qty,
      '$_POST[address]',
      $carbon
    )
  ");

  header("Location: invoice.php");
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Place Order</title>
  <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="order-box">
  <h2>Place Order</h2>

  <form method="post">
    <input name="qty" type="number" required placeholder="Quantity">
    <textarea name="address" required placeholder="Delivery Address"></textarea>
    <button name="order">Confirm Order</button>
  </form>
</div>

</body>
</html>
