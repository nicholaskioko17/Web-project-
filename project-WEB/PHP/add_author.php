<?php
session_start();
require_once('includes/constant.php');
require_once('includes/database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Administrator') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType) VALUES (?, ?, ?, ?, ?, 'Author')");
    $stmt->bind_param("sssss", $full_name, $email, $phone_number, $user_name, $password);

    if ($stmt->execute()) {
        echo "Author added successfully!";
    } else {
        echo "Error adding author: " . $stmt->error;
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
    <title>Add Author</title>
</head>
<body>
    <h2>Add a new Author</h2>

    <form action="" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>

        <label for="user_name">User Name:</label>
        <input type="text" name="user_name" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Add Author</button>
    </form>
</body>
</html>
