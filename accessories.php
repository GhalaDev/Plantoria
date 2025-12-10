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
