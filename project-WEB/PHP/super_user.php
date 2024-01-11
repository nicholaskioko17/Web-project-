<?php
session_start();
require_once('constant.php');
require_once('database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Super_User') {
    header("Location: index.php");
    exit();
}

// Super User Dashboard Content
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
    <!-- Super User Dashboard Content Here -->
</body>
</html>
