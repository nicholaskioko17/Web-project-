<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Author') {
    header("Location: index.php");
    exit();
}

// Fetch and display list of all articles authored by the current user
$author_id = $_SESSION['user_id'];

$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT article_title, article_full_text FROM articles WHERE authorId = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $author_id);
$stmt->execute();
$stmt->bind_result($article_title, $article_full_text);

$articles = [];

while ($stmt->fetch()) {
    $articles[] = [
        'title' => $article_title,
        'full_text' => $article_full_text
    ];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Articles</title>
</head>
<body>
    <h2>List of Articles</h2>
    <?php if (empty($articles)): ?>
        <p>No articles found.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($articles as $article): ?>
                <li>
                    <strong><?php echo $article['title']; ?></strong><br>
                    <?php echo $article['full_text']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
