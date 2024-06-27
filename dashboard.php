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
    <title>Dashboard Overview</title>
</head>
<body>
    <h2>Dashboard Overview</h2>
    <a href="logout.php">Logout</a>
    <br><br>
    <button onclick="window.location.href='create_task.php';">Create Task</button>
    <button onclick="window.location.href='create_project.php';">Create Project</button>
    <button onclick="window.location.href='notifications.php';">Notifications</button>
    <button onclick="window.location.href='profile.php';">Profile</button>
    <button onclick="window.location.href='view_tasks.php';">View Tasks</button>
    <button onclick="window.location.href='update_task.php';">Update Task</button>
    <button onclick="window.location.href='delete_task.php';">Delete Task</button>
    <button onclick="window.location.href='status_tracking.php';">Status Tracking</button>
    <button onclick="window.location.href='progress_visualization.php';">Progress Visualization</button>
    <button onclick="window.location.href='task_prioritization.php';">Task Prioritization</button>
    <br><br>
    <?php
    $user_id = $_SESSION['user_id'];
    echo "Current User ID: " . $user_id . "<br>";

    $sql = "SELECT t.TaskID, t.TaskName, t.DueDate, t.Status
            FROM Tasks t
            WHERE t.AssignedTo = $user_id
            ORDER BY t.DueDate ASC";

    $result = $conn->query($sql);

    if ($result === FALSE) {
        echo "Error: " . $conn->error;
    } elseif ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Task ID</th>
                    <th>Task Name</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['TaskID']}</td>
                    <td>{$row['TaskName']}</td>
                    <td>{$row['DueDate']}</td>
                    <td>{$row['Status']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<tr><td colspan='4'>No tasks found</td></tr>";
    }
    ?>
</body>
</html>
