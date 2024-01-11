<?php
session_start();
require_once('includes/constant.php');
require_once('includes/database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Author') {
    header("Location: index.php");
    exit();
}

// Author Dashboard Content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Author Dashboard</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
     <!-- top navigation starts here -->
     <?php require "includes/navigation.php"; ?>
        <!-- top navigation ends here -->
    <div class="header">
        <h1>Author</h1>
    </div>
    <!-- the main content section starts here -->
    <div class="row">
        <div class="content">
    <h2>Welcome, Author!</h2><ul>
        <li><a href="update_profile.php">Update Profile</a></li>
        <li><a href="add_article.php">Manage Articles</a></li>
        <li><a href="view_articles.php">View Articles</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</body>
</html>
