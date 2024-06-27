<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <form action="register.php" method="post">
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Password: <input type="password" name="password" required><br>
        <input type="submit" name="register" value="Register">
    </form>

    <?php
    if (isset($_POST['register'])) {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

        // Insert data into the Users table
        $sql = "INSERT INTO Users (Name, Email, Password, RegistrationDate) VALUES ('$name', '$email', '$password', NOW())";

        // Check if the query was successful
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
