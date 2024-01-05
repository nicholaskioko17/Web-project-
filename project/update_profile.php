<?php
session_start();
require_once('includes/constants.php');
require_once('includes/database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$db = new Database();
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Validate form data (you should add proper validation)

    $stmt = $conn->prepare("UPDATE users SET Full_Name=?, email=?, phone_Number=?, Address=?, Password=? WHERE userId=?");
    $stmt->bind_param("sssssi", $full_name, $email, $phone_number, $address, $password, $user_id);

    if ($stmt->execute()) {
        echo "Profile updated successfully.";
    } else {
        echo "Error updating profile: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch user details from the database for pre-filling the form
$stmt = $conn->prepare("SELECT Full_Name, email, phone_Number, Address FROM users WHERE userId=?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($full_name, $email, $phone_number, $address);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
</head>
<body>
    <h2>Update Profile</h2>
    <form action="" method="post">
        <label for="full_name">Full Name:</label>
        <input type="text" name="full_name" value="<?php echo $full_name; ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $email; ?>" required><br>

        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo $phone_number; ?>" required><br>

        <label for="address">Address:</label>
        <textarea name="address" rows="3"><?php echo $address; ?></textarea><br>

        <label for="password">New Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
