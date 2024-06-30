<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="Esignup.css">
</head>
<body>
    <div class="container">
        <a href="HTMLPage1.php"><img src="img/image (2).png" class="brand-logo" alt="Brand Logo"></a>
        <form id="createAccountForm" onsubmit="return validateForm()" method="POST">
            <h2>Sign up</h2>
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" id="first_name" name="Fname" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" id="last_name" name="Lname" required>
            </div>
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
            <button type="submit" id="submit">Sign up</button>
        </form>
        <div class="account">
            <span>Already have an account? <a href="Elogin.php">Sign in</a></span>
        </div>
    </div>

    <?php
    session_start();
    include("db1.php");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstname = trim($_POST['Fname']);
        $lastname = trim($_POST['Lname']);
        $company = trim($_POST['Cname']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        if (!empty($email) && !empty($password) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Check if the email already exists
            $stmt = $con1->prepare("SELECT * FROM form WHERE Email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Email already exists, sign in the user
                $_SESSION['email'] = $email;
                echo "<script type='text/javascript'>alert('Email already registered. Signing you in.');</script>";
                echo "<script type='text/javascript'>window.location.href = 'entrepueners.php';</script>";
            } else {
                // Email does not exist, proceed with registration
                $stmt = $con1->prepare("INSERT INTO form (Fname, Lname, Cname, Email, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $firstname, $lastname, $company, $email, $password);

                if ($stmt->execute()) {
                    $_SESSION['email'] = $email;
                    echo "<script type='text/javascript'>alert('Successfully registered');</script>";
                    echo "<script type='text/javascript'>window.location.href = 'entrepueners.php';</script>";
                } else {
                    // Display the MySQL error
                    $error = $stmt->error;
                    echo "<script type='text/javascript'>alert('Database insertion failed: " . addslashes($error) . "');</script>";
                }
            }

            $stmt->close();
        } else {
            echo "<script type='text/javascript'>alert('Please enter some valid information');</script>";
        }
    }
    ?>
</body>
</html>


