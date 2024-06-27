<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Assign Role</title>
</head>
<body>
    <h2>Assign Role</h2>
    <form action="assign_role.php" method="post">
        User ID: <input type="number" name="user_id" required><br>
        Role:
        <select name="role_id" required>
            <option value="1">Admin</option>
            <option value="2">Project Manager</option>
            <option value="3">Team Member</option>
        </select><br>
        <input type="submit" name="assign" value="Assign Role">
    </form>

    <?php
    if (isset($_POST['assign'])) {
        // Retrieve form data
        $user_id = $_POST['user_id'];
        $role_id = $_POST['role_id'];

        // Insert data into the UserRoles table
        $sql = "INSERT INTO UserRoles (UserID, RoleID, AssignmentDate) VALUES ('$user_id', '$role_id', NOW())";

        // Check if the query was successful
        if ($conn->query($sql) === TRUE) {
            echo "Role assigned successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
