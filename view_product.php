<?php

//connect database
include('db.php');


//add prooduct
if(isset($_POST['add_product'])){
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];

    $query = "INSERT INTO products (name, price, description, category) VALUES ('$name', '$price', '$description', '$category')";
    $result = mysqli_query($conn, $query);

    if($result){
        echo "<p style='color: green;'>Product added successfuly!</p>";
    } else {
        echo "<p style='color: red;'>Failed to add product!</p>";
    }
}

//view product
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

    <!-- Amin table-->
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
            <a class="adminlink" href="edit_product.php?id=<?php echo $row['id']; ?>">Update</a> |
            <a class="adminlink" href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
        </td>
    </tr>
    <?php } ?>
    </table>

    <!-- Add product -->
    <div class="add-product-container">
        <form method="POST" action="">
            <div class="add-product-box">
                <h3>Create New Product</h3>
                <label for="name">Product Name:</label>
                <input type="text" name="name" required><br><br>

                <label for="price">Price:</label>
                <input type="number" name="price" required><br><br>

                <label for="description">Description:</label>
                <textarea name="description" required></textarea><br><br>

                <label for="category">Category:</label>
                <select name="category" required>
                        <option value="indoor">Indoor</option>
                        <option value="outdoor">Outdoor</option>
                        <option value="accessories">Accessories</option>
                </select>
                <br><br>

                <button type="submit" name="add_product" class="add-button">Add Product</button>
            </div>
        </form>
    </div>

</body>
</html>