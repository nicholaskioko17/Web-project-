<?php
session_start();
require_once('includes/constant.php');
require_once('includes/database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Super_User') {
    header("Location: index.php");
    exit();
}

// Fetch and display list of all users from the database
$db = new Database();
$conn = $db->getConnection();

$sql = "SELECT userId, Full_Name, email, phone_Number, User_Name FROM users WHERE UserType != 'Super_User'";
$result = $conn->query($sql);

$users = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Users</title>
</head>
<body>
    <h2>List of Users</h2>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Username</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['userId']; ?></td>
                <td><?php echo $user['Full_Name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['phone_Number']; ?></td>
                <td><?php echo $user['User_Name']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
