<?php
session_start();
require_once('includes/constant.php');
require_once('includes/database.php');

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'Administrator') {
    header("Location: index.php");
    exit();
}

// Function to fetch and display the list of all authors
function listAuthors() {
    $db = new Database();
    $conn = $db->getConnection();

    $result = $conn->query("SELECT userId, Full_Name, email, phone_Number, User_Name FROM users WHERE UserType = 'Author'");
    
    echo "<h3>List of Authors</h3>";
    echo "<table border='1'>
            <tr>
                <th>User ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>User Name</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['userId']}</td>
                <td>{$row['Full_Name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone_Number']}</td>
                <td>{$row['User_Name']}</td>
                <td>
                    <a href='update_author.php?author_id={$row['userId']}'>Update</a> |
                    <a href='delete_author.php?author_id={$row['userId']}'>Delete</a>
                </td>
            </tr>";
    }

    echo "</table>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Dashboard</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
<?php require "includes/navigation.php"; ?>
        <!-- top navigation ends here -->
    <div class="header">
        <h1>Administrator</h1>
    </div>
    <!-- the main content section starts here -->
    <div class="row">
        <div class="content">
        <ol>
        <li><a href="update_profile.php">Update Profile</a></li>
        <li><a href="manage_authors.php">Manage Other Users</a></li>
        <li><a href="view_articles.php">View Articles</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ol>

    
</body>
</html>
