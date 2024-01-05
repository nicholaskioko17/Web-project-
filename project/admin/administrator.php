<?php
session_start();
require_once('constants.php');
require_once('database.php');
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Administrator') {
    header("Location: index.php");
    exit();
}

// Administrator Dashboard Content
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
</head>
<body>
    <h2>Welcome, Administrator!</h2>
    <!-- Administrator Dashboard Content Here -->
</body>
</html>
