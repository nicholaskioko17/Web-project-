<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Super_User') {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super User Dashboard</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
       <!-- top navigation starts here -->
   
       <?php require "includes/navigation.php"; ?>
        <!-- top navigation ends here -->
    <div class="header">
        <h1>Super User</h1>
    </div>
    <!-- the main content section starts here -->
    <div class="row">
        <div class="content">
        
    <h2>Super User Dashboard</h2>

    <ol>
        <li><a href="update_profile.php">Update Profile</a></li>
        <li><a href="manage_users.php">Manage Other Users</a></li>
        <li><a href="view_articles.php">View Articles</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>

</body>
</html>
