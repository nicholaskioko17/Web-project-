<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Super_User') {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process the form submission and update the user details in the database
    $user_id = $_POST['user_id'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $user_name = $_POST['user_name'];

    // Perform the necessary validation and update user logic here

    // Example: Update user in the database
    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("UPDATE users SET Full_Name=?, email=?, phone_Number=?, User_Name=? WHERE userId=?");
    $stmt->bind_param("ssssi", $full_name, $email, $phone_number, $user_name, $user_id);

    if ($stmt->execute()) {
        echo "User details updated successfully!";
    } else {
        echo "Error updating user details: " . $stmt->error;
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
    <title>Update User</title>
</head>
<body>
    <h2>Update User</h2>
    <?php
    // Retrieve user details for the specified user_id
    $user_id = $_GET['user_id'] ?? null;

    if ($user_id) {
        $db = new Database();
        $conn = $db->getConnection();

        $stmt = $conn->prepare("SELECT Full_Name, email, phone_Number, User_Name FROM users WHERE userId=?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($full_name, $email, $phone_number, $user_name);
        $stmt->fetch();

        $stmt->close();
        $conn->close();
    ?>
    <form action="update_users.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $full_name; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>" required><br>

        <label for="user_name">Username:</label>
        <input type="text" name="user_name" value="<?php echo $user_name; ?>" required><br>

        <button type="submit">Update User</button>
    </form>
    <?php
    } else {
        echo "Invalid user ID.";
    }
    ?>
</body>
</html>
