<?php
include 'includes/db.php'; // Include database connection

// Fetch all products
$result = $conn->query("SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - EM Quality Shoes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <h1>All Products</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </nav>
    </header>
    <div class="product-list">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product">
                <h2><?php echo $row['name']; ?></h2>
                <p><?php echo $row['description']; ?></p>
                <p>Price: $<?php echo $row['price']; ?></p>
                <img src="images/products/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
                <a href="product.php?id=<?php echo $row['id']; ?>">View Details</a>
            </div>
        <?php endwhile; ?>
    </div>
    <footer>
        <p>© 2024 EM Quality Shoes</p>
    </footer>
</body>
</html>
