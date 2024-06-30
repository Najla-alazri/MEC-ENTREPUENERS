<?php
session_start();
include("db.php");

// Redirect to profile if already logged in
if (isset($_SESSION['email'])) {
    header("Location: profile.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $con->prepare("SELECT Email, password FROM form WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user_data = $result->fetch_assoc();

            if (password_verify($password, $user_data['password'])) {
                $_SESSION['email'] = $email;

                setcookie("email", $email, time() + (86400 * 30), "/");  // 30 days validity
                setcookie("loggedIn", true, time() + (86400 * 30), "/"); // 30 days validity

                header("Location: Shop.php");
                exit();
            } else {
                header("Location: login.php?error=Incorrect password.");
                exit();
            }
        } else {
            header("Location: login.php?error=User not found.");
            exit();
        }
    } else {
        header("Location: login.php?error=Please enter both email and password.");
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-signup.css">
</head>
<body>
    <div class="login-box">
        <a href="HTMLPage1.php"><img src="img/image (2).png" class="brand-logo" alt=""></a>
        <h2>Login</h2>
        <?php if (isset($_GET['error'])) { ?>
            <div class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php } ?>
        <form method="POST" action="">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" id="submit" value="Login">
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="signup.php">Create one here</a>.</p>
            <p>Login as a <a href="Elogin.php">business owner</a>.</p>
        </div>
    </div>
</body>
</html>

