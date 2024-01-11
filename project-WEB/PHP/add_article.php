<?php
session_start();
require_once('includes/constant.php');
require_once('includes/database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Author') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the form submission and add the new article to the database
    $author_id = $_SESSION['user_id'];
    $article_title = $_POST['article_title'];
    $article_full_text = $_POST['article_full_text'];

    // Perform the necessary validation and add article logic here

    // Example: Insert article into the database
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO articles (authorId, article_title, article_full_text) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $author_id, $article_title, $article_full_text);

    if ($stmt->execute()) {
        echo "Article added successfully!";
    } else {
        echo "Error adding article: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Article</title>
</head>
<body>
    <h2>Add New Article</h2>
    <form action="" method="post">
        <label for="article_title">Article Title:</label>
        <input type="text" name="article_title" required><br>

        <label for="article_full_text">Article Full Text:</label>
        <textarea name="article_full_text" rows="4" required></textarea><br>

        <button type="submit">Add Article</button>
    </form>
</body>
</html>
