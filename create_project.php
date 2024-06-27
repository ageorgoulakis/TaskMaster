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
head>
    <title>Create Project</title>
</head>
<body>
    <h2>Create Project</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="create_project.php" method="post">
        Project Name: <input type="text" name="project_name" required><br>
        <input type="submit" name="create" value="Create Project">
    </form>

    <?php
    if (isset($_POST['create'])) {
        $project_name = $_POST['project_name'];

        $sql = "INSERT INTO Projects (ProjectName) VALUES ('$project_name')";

        if ($conn->query($sql) === TRUE) {
            echo "Project created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
