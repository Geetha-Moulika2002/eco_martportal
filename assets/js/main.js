function checkStock(productId) {
    fetch("../api/stock_check.php?id=" + productId)
    .then(res => res.json())
    .then(data => {
        document.getElementById("stock").innerHTML =
            "Available Stock: " + data.stock;
    });
}
