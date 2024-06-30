<?php
session_start();
include("db1.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Debug: Log the email and password
        error_log("Attempting login with Email: $email, Password: $password");

        // Prepare the statement
        $stmt = $con1->prepare("SELECT Email, password FROM form WHERE Email = ?");
        if (!$stmt) {
            error_log("Prepare failed: (" . $con1->errno . ") " . $con1->error);
            exit();
        }
        $stmt->bind_param("s", $email);
        if (!$stmt->execute()) {
            error_log("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
            exit();
        }
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            // Debug: Check fetched data
            error_log("Fetched user data: " . print_r($user_data, true));

            // Verify the password using simple string comparison
            if ($password === $user_data['password']) {
                $_SESSION['email'] = $email;

                // Set secure cookies
                setcookie("email", $email, time() + (86400 * 30), "/", "", true, true); // 30 days validity, HttpOnly and Secure
                setcookie("loggedIn", "true", time() + (86400 * 30), "/", "", true, true); // 30 days validity, HttpOnly and Secure

                // Redirect to the main page
                header("Location: entrepueners.php");
                exit();
            } else {
                // Debug: Password mismatch
                error_log("Password mismatch for user: $email");

                // Redirect if the password is incorrect
                header("Location: Elogin.php?error=Incorrect password.");
                exit();
            }
        } else {
            // Debug: User not found
            error_log("User not found: $email");

            // Redirect if the user is not found
            header("Location: Elogin.php?error=User not found.");
            exit();
        }
    } else {
        // Debug: Missing email or password
        error_log("Missing email or password");

        // Redirect if email or password is missing
        header("Location: Elogin.php?error=Please enter both email and password.");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Elogin.css">
</head>
<body>
    <div class="container">
        <a href="HTMLPage1.php"><img src="img/image (2).png" class="brand-logo" alt="Brand Logo"></a>
        <form id="login-form" method="POST">
            <h2>Login</h2>
            <div class="form-group">
                <label for="company">Company Name:</label>
                <input type="text" id="company" name="Cname" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login" id="submit">Login</button>
        </form>
        <div class="create-account">
            <span>Don't have an account? <a href="Esignup.php">Create one</a></span>
            <p>Login as a <a href="login.php">Customer</a>.</p>
        </div>
    </div>
</body>
</html>


