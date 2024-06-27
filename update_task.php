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
    <title>Update Task</title>
</head>
<body>
    <h2>Update Task</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="update_task.php" method="post">
        Task ID: <input type="number" name="task_id" required><br>
        Task Name: <input type="text" name="task_name" required><br>
        Description: <textarea name="description"></textarea><br>
        Due Date: <input type="date" name="due_date" required><br>
        Priority: <input type="number" name="priority" required><br>
        Status: <input type="text" name="status" required><br>
        Progress: <input type="number" name="progress" required><br>
        <input type="submit" name="update" value="Update Task">
    </form>

    <?php
    if (isset($_POST['update'])) {
        $task_id = $_POST['task_id'];
        $task_name = $_POST['task_name'];
        $description = $_POST['description'];
        $due_date = $_POST['due_date'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $progress = $_POST['progress'];

        $sql = "UPDATE Tasks
                SET TaskName = '$task_name', Description = '$description', DueDate = '$due_date', Priority = $priority, Status = '$status', ProgressPercentage = $progress, LastUpdateTimestamp = NOW()
                WHERE TaskID = $task_id";

        if ($conn->query($sql) === TRUE) {
            echo "Task updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
