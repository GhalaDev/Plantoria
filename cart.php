<?php
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "plantoria"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
        <a href="cart.php">
            <img src="img/cart_logo.png" class="cart-icon">
        </a>
    </div>
</nav>
<a href="index.php" class="back">← Back</a>


    <h2>Accessories & Gardening Tools</h2>

    <div class="cards">

        <!-- Watering Can -->
        <div class="card">
            <h2>Watering Can</h2>
            <img src="img/watercan.jpg" alt="Watering Can">

            <div class="buybar">
                <button
                    class="cart"
                    data-id="watercan"
                    data-name="Watering Can"
                    data-price="25"
                    data-image="img/watercan.jpg"
                >
                    <img src="img/cart.png">
                    <span class="price">25 SAR</span>
                </button>

                <a href="#" class="details">Details</a>
            </div>
        </div>

        <!-- Gardening Shears -->
        <div class="card">
            <h2>Shears</h2>
            <img src="img/shears.jpg" alt="Shears">

            <div class="buybar">
                <button
                    class="cart"
                    data-id="shears"
                    data-name="Gardening Shears"
                    data-price="35"
                    data-image="/img/shears.jpg"
                >
                    <img src="img/cart.png">
                    <span class="price">35 SAR</span>
                </button>

                <a href="#" class="details">Details</a>
            </div>
        </div>

        <!-- Soil Bag -->
        <div class="card">
            <h2>Soil Bag</h2>
            <img src="img/soil.jpg" alt="Soil Bag">

            <div class="buybar">
                <button
                    class="cart"
                    data-id="soil"
                    data-name="Soil Bag"
                    data-price="18"
                    data-image="/img/soil.jpg"
                >
                    <img src="img/cart.png">
                    <span class="price">18 SAR</span>
                </button>

                <a href="#" class="details">Details</a>
            </div>
        </div>

    </div>

    <script>
        function getCart(){ 
            var data = localStorage.getItem('cart');
            return data ? JSON.parse(data) : [];
        }
        function saveCart(c){ localStorage.setItem('cart', JSON.stringify(c)); }

        function addToCart(item){
            var cart = getCart();
            var idx = -1;

            for (var i=0; i<cart.length; i++){
                if(cart[i].id === item.id){
                    idx = i;
                    break;
                }
            }

            var qty = item.qty ? item.qty : 1;
            if(idx >= 0) cart[idx].qty += qty;
            else cart.push(item);

            saveCart(cart);
            alert(item.name + " added to cart!");
        }

        var cartButtons = document.querySelectorAll(".cart");

        for(var b=0; b<cartButtons.length; b++){
            cartButtons[b].onclick = function(){
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

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart • Plantoria</title>
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
        <a href="cart.php">
            <img src="img/cart_logo.png" class="cart-icon">
        </a>
    </div>
  </nav>

  <h2 style="text-align:center; margin:30px;">Your Cart</h2>

  <section class="cart-panel">
    <div class="cart-container">
    </div>

    <div class="cart-total">
      <h3>Total: <span>0 SAR</span></h3>
    </div>

  </section>

  <script>
    function getCart() {
      var data = localStorage.getItem('cart');
      return data ? JSON.parse(data) : [];
    }

    function saveCart(c) { 
      localStorage.setItem('cart', JSON.stringify(c)); 
    }

    function renderCart() {
      var cart = getCart();
      var wrap = document.querySelector('.cart-container');
      var totalEl = document.querySelector('.cart-total span');
      if (!wrap) return;

      if (cart.length === 0) {
        wrap.innerHTML = '<p class="empty">Your cart is empty.</p>';
        if (totalEl) totalEl.textContent = '0 SAR';
        return;
      }

      var html = '';
      var total = 0;
      for (var i = 0; i < cart.length; i++) {
        var it = cart[i];
        total += (parseFloat(it.price) * it.qty);
        html += ''
          + '<div class="cart-item" data-id="' + it.id + '">'
          +   '<img src="' + it.image + '" alt="' + it.name + '">'
          +   '<div class="cart-info">'
          +     '<h3>' + it.name + '</h3>'
          +     '<p>' + parseFloat(it.price).toFixed(2) + ' SAR</p>'
          +   '</div>'
          +   '<div style="display:flex;align-items:center;gap:8px">'
          +     '<button onclick="changeQty(\'' + it.id + '\',-1)">-</button>'
          +     '<span>' + it.qty + '</span>'
          +     '<button onclick="changeQty(\'' + it.id + '\',1)">+</button>'
          +   '</div>'
          +   '<button class="remove" onclick="removeItem(\'' + it.id + '\')">Remove</button>'
          + '</div>';
      }
      wrap.innerHTML = html;
      if (totalEl) totalEl.textContent = total.toFixed(2) + ' SAR';
    }

    function changeQty(id, d) {
      var cart = getCart();
      for (var i = 0; i < cart.length; i++) {
        if (cart[i].id === id) {
          cart[i].qty += d;
          if (cart[i].qty <= 0) {
            cart.splice(i, 1);
          }
          break;
        }
      }
      saveCart(cart);
      renderCart();
    }

    function removeItem(id) {
      var cart = getCart();
      var newCart = [];
      for (var i = 0; i < cart.length; i++) {
        if (cart[i].id !== id) newCart.push(cart[i]);
      }
      saveCart(newCart);
      renderCart();
    }

    renderCart();
  </script>

</body>
</html>