<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Super_User') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the form submission and add the new user to the database
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Perform the necessary validation and add user logic here

    // Example: Insert user into the database
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType) VALUES (?, ?, ?, ?, ?, 'Author')");
    $stmt->bind_param("sssss", $full_name, $email, $phone_number, $user_name, $password);

    if ($stmt->execute()) {
        echo "User added successfully!";
    } else {
        echo "Error adding user: " . $stmt->error;
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
    <title>Add New User</title>
</head>
<body>
    <h2>Add New User</h2>
    <form action="add_user.php" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" required><br>

        <label for="user_name">Username:</label>
        <input type="text" name="user_name" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Add User</button>
    </form>
</body>
</html>
