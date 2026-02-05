<?php
include("../config/db.php");

$id = $_GET['id'];
$res = mysqli_query($con, "SELECT stock FROM products WHERE product_id=$id");
$row = mysqli_fetch_assoc($res);

echo json_encode([
    "stock" => $row['stock']
]);
