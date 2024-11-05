<?php
include 'includes/db.php'; // Include database connection
$product_id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = $product_id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1><?php echo $product['name']; ?></h1>
    <img src="images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
    <p><?php echo $product['description']; ?></p>
    <p>Price: $<?php echo $product['price']; ?></p>
    <h2>Reviews</h2>
    <!-- Display reviews here -->
</body>
<?php
// Existing code to fetch product details...

// Handle review submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $user_id = $_SESSION['user_id'];

    $conn->query("INSERT INTO reviews (product_id, user_id, rating, comment) VALUES ($product_id, $user_id, $rating, '$comment')");
    echo "Review submitted!";
}
?>
<h2>Submit a Review</h2>
<form method="POST">
    <label for="rating">Rating:</label>
    <select name="rating" required>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select>
    <textarea name="comment" placeholder="Write your review here..." required></textarea>
    <input type="submit" value="Submit Review">
</form>
<h2>Reviews</h2>
<?php
$reviews = $conn->query("SELECT * FROM reviews WHERE product_id = $product_id");
while ($review = $reviews->fetch_assoc()): ?>
    <div class="review">
        <strong>User ID: <?php echo $review['user_id']; ?></strong>
        <p>Rating: <?php echo $review['rating']; ?></p>
        <p><?php echo $review['comment']; ?></p>
        <p>Reviewed on: <?php echo $review['created_at']; ?></p>
    </div>
<?php endwhile; ?>

</html>
