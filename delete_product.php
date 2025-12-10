<?php
// الاتصال بقاعدة البيانات
include('db.php');

if(isset($_GET['id'])){
    $product_id = $_GET['id'];

    $query = "DELETE FROM products WHERE id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "تم حذف المنتج بنجاح!";
    } else {
        echo "فشل حذف المنتج!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>Product Deleted Successfully</h2>
    <a href="view_products.php">Go back to product list</a>

</body>
</html>