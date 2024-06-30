<?php
session_start();
include("db.php");

$email = $_SESSION['email'];

// Query database for user information
$stmt = $con->prepare("SELECT * FROM form WHERE Email = ?");
if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user_data = $result->fetch_assoc();
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>User Profile</title>
        </head>
        <body>
            <h1>Welcome, <?php echo htmlspecialchars($user_data['Fname']); ?></h1>
            <p>Email: <?php echo htmlspecialchars($user_data['Email']); ?></p>
            <p>Phone: <?php echo htmlspecialchars($user_data['phoneNO']); ?></p>
            <a href="logout.php">Logout</a>
        </body>
        </html>
<?php
    } else {
        // User not found, redirect to login page
        header("Location: login.php");
        exit();
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Database query error.";
}

// Close the database connection
$con->close();
?>


