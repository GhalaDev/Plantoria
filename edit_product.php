<?php
// الاتصال بقاعدة البيانات
include('db.php');

if(isset($_GET['id'])){
    $product_id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}

if(isset($_POST['update_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $query = "UPDATE products SET name='$name', price='$price', description='$description', category='$category' WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "تم تعديل المنتج بنجاح!";
    } else {
        echo "فشل تعديل المنتج!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>Edit Product</h2>
    <form method="POST" action="edit_product.php?id=<?php echo $product_id; ?>">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

        <label for="price">Price:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" required><?php echo $product['description']; ?></textarea><br><br>

        <label for="category">Category:</label>
        <input type="text" name="category" value="<?php echo $product['category']; ?>" required><br><br>

        <input type="submit" name="update_product" value="Update Product">
    </form>

</body>
</html>