<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile Management</title>
</head>
<body>
    <h2>Profile Management</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <?php
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT Name, Email, ProfilePicture, Preferences FROM Users WHERE UserID = $user_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
    <form action="profile.php" method="post" enctype="multipart/form-data">
        Name: <input type="text" name="name" value="<?php echo $row['Name']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $row['Email']; ?>" required><br>
        Profile Picture: <input type="file" name="profile_picture"><br>
        Preferences: <textarea name="preferences"><?php echo $row['Preferences']; ?></textarea><br>
        <input type="submit" name="update" value="Update Profile">
    </form>
    <?php
    } else {
        echo "User not found";
    }

    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $preferences = $_POST['preferences'];
        $profile_picture = $_FILES['profile_picture']['name'];

        if ($profile_picture) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($profile_picture);
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        } else {
            $target_file = $row['ProfilePicture'];
        }

        $sql = "UPDATE Users SET Name = '$name', Email = '$email', ProfilePicture = '$target_file', Preferences = '$preferences', LastUpdateTimestamp = NOW() WHERE UserID = $user_id";

        if ($conn->query($sql) === TRUE) {
            echo "Profile updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
