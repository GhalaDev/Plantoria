<?php
// الاتصال بقاعدة البيانات
include('db.php');

$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Products</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <h2>View Products</h2>
    <table class="product-table">
    <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Description</th>
        <th>Category</th>
        <th>Actions</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['price']; ?> SAR</td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td>
            <a class="adminlink" href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a> |
            <a class="adminlink" href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>


<!-- خانة إضافة المنتجات -->
<div class="add-product-container">
    <form action="add_product.php" method="POST">
        <div class="add-product-box">
            <h3>Add New Product</h3>
            <label for="product-name">Product Name:</label>
            <input type="text" id="product-name" name="product-name" required>
            
            <label for="product-price">Price:</label>
            <input type="number" id="product-price" name="product-price" required>
            
            <label for="product-description">Description:</label>
            <textarea id="product-description" name="product-description" required></textarea>

            <label for="product-category">Category:</label>
            <select id="product-category" name="product-category" required>
                <option value="indoor">Indoor</option>
                <option value="outdoor">Outdoor</option>
                <option value="accessories">Accessories</option>
            </select>

            <button type="submit" class="add-button">Add Product</button>
        </div>
    </form>
</div>

</body>
</html>