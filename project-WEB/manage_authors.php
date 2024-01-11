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
    
    <!-- Manage Other Users Options -->
    <h3>Manage Other Users:</h3>
    <ul>
        <li><a href="add_author.php">Add a new Author</a></li>
        <li><a href="#" onclick="listAuthors()">See a list of all Authors</a></li>
        <li><a href="#" onclick="printAuthorsList()">Print Authors list</a></li>
        
    <li><a href="logout.php">Logout</a></li>
    </ul>

    <!-- Display List of Authors -->
    <div id="authorList"></div>

    <!-- JavaScript to dynamically load and print author list -->
    <script>
        function listAuthors() {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("authorList").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "list_authors.php", true);
            xmlhttp.send();
        }

        function printAuthorsList() {
            var printContents = document.getElementById("authorList").innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</body>
</html>
