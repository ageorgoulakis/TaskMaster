<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Login</title>
</head>
<body>
    <h2>User Login</h2>
    <form action="login.php" method="post">
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="login" value="Login">
    </form>

    <?php
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM Users WHERE Email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['Password'])) {
                session_start();
                $_SESSION['user_id'] = $user['UserID'];
                $_SESSION['user_name'] = $user['Name'];
                echo "Login successful! Redirecting to dashboard...";
                header("Refresh: 2; URL=dashboard.php");
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with this email.";
        }
    }
    ?>
</body>
</html>
