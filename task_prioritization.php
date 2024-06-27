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
    <title>Task Prioritization</title>
</head>
<body>
    <h2>Task Prioritization</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="task_prioritization.php" method="post">
        Task ID: <input type="number" name="task_id" required><br>
        Priority Level: <input type="number" name="priority_level" required><br>
        <input type="submit" name="set_priority" value="Set Priority">
    </form>

    <?php
    if (isset($_POST['set_priority'])) {
        $task_id = $_POST['task_id'];
        $priority_level = $_POST['priority_level'];
        $set_by = $_SESSION['user_id']; // Example user ID, replace with session or login user ID

        $sql = "INSERT INTO TaskPriorities (TaskID, PriorityLevel, SetBy, SetDate)
                VALUES ($task_id, $priority_level, $set_by, NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Priority set successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
