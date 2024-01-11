<?php
session_start();
require_once('includes/constant.php');
require_once('includes/database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['username'];
    $password = $_POST['password'];

    $db = new Database();
    $conn = $db->getConnection();

    $stmt = $conn->prepare("SELECT userId, UserType, Password FROM users WHERE User_Name=?");
    $stmt->bind_param("s", $user_name);
    $stmt->execute();
    $stmt->bind_result($user_id, $user_type, $hashed_password);
    
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_type'] = $user_type;

        switch ($user_type) {
            case 'Super_User':
                header("Location: reception.php");
                break;
            case 'Administrator':
                header("Location: administrator.php");
                break;
            case 'Author':
                header("Location: author.php");
                break;
            default:
                
                break;
        }
    } else {
        echo "Invalid username or password.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    
     <!-- top navigation starts here -->
     <?php require "includes/navigation.php"; ?>
        <!-- top navigation ends here -->
    <div class="header">
    <h2>Login</h2>
    </div>
    <!-- the main content section starts here -->
    <div class="row">
        <div class="content">
    
    <form action="index.php" method="post">
    <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" id="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <div class="mb-3">

        <button type="submit">Login</button>
            </div>
    </form>
</body>
</html>
