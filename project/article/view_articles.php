<?php
session_start();
require_once('constants.php');
require_once('database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();

// Fetch last 6 articles in descending order
$result = $conn->query("SELECT * FROM articles ORDER BY article_created_date DESC LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Articles</title>
</head>
<body>
    <h2>View Articles</h2>

    <!-- Display Articles -->
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div>
            <h3><?php echo $row['article_title']; ?></h3>
            <p><?php echo $row['article_full_text']; ?></p>
            <p>Created Date: <?php echo $row['article_created_date']; ?></p>
            <p>Last Update: <?php echo $row['article_last_update']; ?></p>
            <?php if ($row['article_display'] === 'yes') : ?>
                <p>Display: Yes</p>
            <?php else : ?>
                <p>Display: No</p>
            <?php endif; ?>
            <p>Order: <?php echo $row['article_order']; ?></p>

            <!-- Add export links here (PDF, textfile, Excel) -->
        </div>
    <?php endwhile; ?>
</body>
</html>
