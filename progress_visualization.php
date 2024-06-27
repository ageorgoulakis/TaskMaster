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
    <title>Progress Visualization</title>
</head>
<body>
    <h2>Progress Visualization</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="progress_visualization.php" method="post">
        Task ID: <input type="number" name="task_id" required><br>
        Progress: <input type="number" name="progress" required><br>
        <input type="submit" name="update_progress" value="Update Progress">
    </form>

    <?php
    if (isset($_POST['update_progress'])) {
        $task_id = $_POST['task_id'];
        $progress = $_POST['progress'];

        $sql = "UPDATE Tasks
                SET ProgressPercentage = $progress, LastUpdateTimestamp = NOW()
                WHERE TaskID = $task_id";

        if ($conn->query($sql) === TRUE) {
            echo "Progress updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
