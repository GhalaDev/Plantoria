<?php
// الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantoria";

$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // استعلام لإضافة منتج جديد
    $sql = "INSERT INTO products (name, price, category) VALUES ('$name', '$price', '$category')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!-- نموذج لإضافة منتج -->
<form method="POST" action="add_product.php">
    <label for="name">Product Name:</label>
    <input type="text" name="name" id="name" required>

    <label for="price">Price:</label>
    <input type="text" name="price" id="price" required>

    <label for="category">Category:</label>
    <input type="text" name="category" id="category" required>

    <input type="submit" value="Add Product">
</form>