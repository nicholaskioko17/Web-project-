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
</head>
<body>
    <h2>Welcome, Super User!</h2>

    <ul>
        <li><a href="update_profile.php">Update Profile</a></li>
        <li><a href="manage_users.php">Manage Other Users</a></li>
        <li><a href="view_articles.php">View Articles</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

</body>
</html>
