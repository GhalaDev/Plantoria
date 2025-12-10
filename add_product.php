<?php
// الاتصال بقاعدة البيانات
include('db.php');

if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $query = "INSERT INTO products (name, price, description, category) VALUES ('$name', '$price', '$description', '$category')";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "تم إضافة المنتج بنجاح!";
    } else {
        echo "فشل إضافة المنتج!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>Add New Product</h2>
    <form method="POST" action="add_product.php">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" required><br><br>

        <input type="submit" name="add_product" value="Add Product">
    </form>

</body>
</html>