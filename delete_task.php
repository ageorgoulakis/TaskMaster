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
    <title>Delete Task</title>
</head>
<body>
    <h2>Delete Task</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="delete_task.php" method="post">
        Task ID: <input type="number" name="task_id" required><br>
        <input type="submit" name="delete" value="Delete Task">
    </form>

    <?php
    if (isset($_POST['delete'])) {
        $task_id = $_POST['task_id'];

        $sql = "DELETE FROM Tasks WHERE TaskID = $task_id";

        if ($conn->query($sql) === TRUE) {
            echo "Task deleted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
