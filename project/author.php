<?php
session_start();
require_once('constants.php');
require_once('database.php');
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
</head>
<body>
    <h2>Welcome, Author!</h2>
    <!-- Author Dashboard Content Here -->
</body>
</html>
