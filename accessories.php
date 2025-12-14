<?php
include('db.php'); 

$sql = "SELECT * FROM products WHERE category = 'Accessories'";
$result = $conn->query($sql);

if (!$result) {
  die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Accessories & Tools</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/icon.png">
</head>
<body>

<nav class="navbar">
  <div class="nav-right">
    <a href="index.php"><img src="img/logo.png" class="logo"></a>
  </div>
  <div class="nav-center">
    <a href="index.php">Home</a>
    <a href="indoor.php">Indoor</a>
    <a href="outdoor.php">Outdoor</a>
    <a href="accessories.php">Accessories</a>
  </div>
  <div class="nav-left">
    <a href="cart.php"><img src="img/cart_logo.png" class="cart-icon"></a>
  </div>
</nav>

<a href="index.php" class="back">← Back</a>
<h2>Accessories & Gardening Tools</h2>

<div class="cards">
  <?php while($row = $result->fetch_assoc()) { ?>
    <div class="card">
      <h2><?= $row['name'] ?></h2>

      <img src="img/<?= $row['name'] ?>.jpg" alt="<?= $row['name'] ?>">

      <div class="buybar">
        <button class="cart"
          data-id="<?= $row['id'] ?>"
          data-name="<?= $row['name'] ?>"
          data-price="<?= $row['price'] ?>"
          data-image="img/<?= $row['name'] ?>.jpg">
          <img src="img/cart.png" alt="Add to cart">
          <span class="price"><?= $row['price'] ?> SAR</span>
        </button>

        <a href="<?= strtolower($row['name']) ?>.php" class="details">Details</a>
      </div>
    </div>
  <?php } ?>
</div>

<script>
  function getCart() {
    var data = localStorage.getItem('cart');
    return data ? JSON.parse(data) : [];
  }

  function saveCart(c) {
    localStorage.setItem('cart', JSON.stringify(c));
  }

  function addToCart(item) {
    var cart = getCart();
    var idx = -1;

    for (var i = 0; i < cart.length; i++) {
      if (cart[i].id === item.id) { idx = i; break; }
    }

    var qty = item.qty ? item.qty : 1;

    if (idx >= 0) cart[idx].qty += qty;
    else cart.push({ id:item.id, name:item.name, price:item.price, image:item.image, qty:qty });

    saveCart(cart);
    alert(item.name + " added to cart!");
  }

  var cartButtons = document.querySelectorAll(".cart");
  for (var b = 0; b < cartButtons.length; b++) {
    cartButtons[b].onclick = function() {
      addToCart({
        id: this.getAttribute("data-id"),
        name: this.getAttribute("data-name"),
        price: parseFloat(this.getAttribute("data-price") || "0"),
        image: this.getAttribute("data-image"),
        qty: 1
      });
    };
  }
</script>

</body>
</html>