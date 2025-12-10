<?php
// إعداد الاتصال بقاعدة البيانات
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "plantoria";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من وجود المعرف (ID) في الرابط
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // استعلام لجلب البيانات الخاصة بالمنتج
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

// تحديث البيانات عند إرسال النموذج
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];

    // استعلام لتحديث المنتج
    $update_sql = "UPDATE products SET name = '$name', price = '$price', category = '$category' WHERE id = $id";

    if ($conn->query($update_sql) === TRUE) {
        echo "Product updated successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!-- نموذج تحديث المنتج -->
<form method="POST" action="update_product.php?id=<?= $product['id'] ?>">
    <label for="name">Product Name:</label>
    <input type="text" name="name" value="<?= $product['name'] ?>" required>

    <label for="price">Price:</label>
    <input type="text" name="price" value="<?= $product['price'] ?>" required>

    <label for="category">Category:</label>
    <input type="text" name="category" value="<?= $product['category'] ?>" required>

    <input type="submit" value="Update Product">
</form>