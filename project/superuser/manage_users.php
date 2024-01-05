<?php
session_start();

require_once('constants.php');
require_once('database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$db = new Database();
$conn = $db->getConnection();

// Add New User
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $user_name = $_POST['user_name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];
    $address = $_POST['address'];

    // Validate form data (you should add proper validation)

    $stmt = $conn->prepare("INSERT INTO users (Full_Name, email, phone_Number, User_Name, Password, UserType, Address) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $full_name, $email, $phone_number, $user_name, $password, $user_type, $address);

    if ($stmt->execute()) {
        echo "User added successfully.";
    } else {
        echo "Error adding user: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all users for display
$result = $conn->query("SELECT userId, Full_Name, email, phone_Number, User_Name, UserType FROM users");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
</head>
<body>
    <h2>Manage Users</h2>

    <!-- Add New User Form -->
    <form action="" method="post">
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

        <label for="user_type">User Type:</label>
        <select name="user_type">
            <option value="Super_User">Super User</option>
            <option value="Administrator">Administrator</option>
            <!-- Add other user types as needed -->
        </select><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="3"></textarea><br>

        <button type="submit" name="add_user">Add User</button>
    </form>

    <!-- Display Users -->
    <h3>User List</h3>
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Username</th>
            <th>User Type</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['userId']; ?></td>
                <td><?php echo $row['Full_Name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['phone_Number']; ?></td>
                <td><?php echo $row['User_Name']; ?></td>
                <td><?php echo $row['UserType']; ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
