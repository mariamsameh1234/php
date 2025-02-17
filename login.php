<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 

    $stored_email = "mariam@gamil.com";  
    $stored_password = "123456";  

    if ($email === $stored_email && $password === $stored_password) {
        $_SESSION['email'] = $email;
        header("Location: content.php");
        exit();
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h1>Cafeteria</h1>

<?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>

<form action="content.php" method="post">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Login</button>
</form>

<a href="forgot_password.php">Forgot Password?</a>

<?php include('footer.php'); ?>

</body>
</html>

