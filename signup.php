<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link rel="stylesheet" href="signup.css">
    <?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['Fname'];
    $lastname = $_POST['Lname'];
    $email = $_POST['Email'];
    $password = $_POST['password'];
    $Cpassword = $_POST['Cpassword'];
    $phonenumber = $_POST['phoneNO'];

    if (!empty($email) && !empty($password) && !is_numeric($email)) {
        if ($password === $Cpassword) {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Prepare the SQL query with hashed password
            $stmt = $con->prepare("INSERT INTO form (Fname, Lname, Email, password, phoneNO) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $phonenumber);

            if ($stmt->execute()) {
                echo "<script type='text/javascript'>alert('Successfully registered');</script>";
                echo "<script type='text/javascript'>window.location.href = 'Shop.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Database insertion failed');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Passwords do not match');</script>";
        }
    } else {
        echo "<script type='text/javascript'>alert('Please enter some valid information');</script>";
    }
}
?>

</head>
<body>
    <div class="container">
        <a href="HTMLPage1.php"><img src="img/image (2).png" class="brand-logo" alt=""></a>
        <h2>Create Account</h2>
        <form id="createAccountForm" onsubmit="return validateForm()" method="POST">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="Fname" required>
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="Lname" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="Email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" id="confirm_password" name="Cpassword" required>

            <label for="phone_number">Phone Number</label>
            <input type="number" id="phone_number" name="phoneNO" required>
            <button id="submit" type="submit">Create Account</button>
            <div class="account">
                <span>Already have an account?<a href="login.php">sign in</a></span>
            </div>
        </form>
    </div>
    <script src="js/Script1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>