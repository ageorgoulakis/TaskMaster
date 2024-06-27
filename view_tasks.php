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
    <title>View Tasks</title>
</head>
<body>
    <h2>View Tasks</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <table border="1">
        <tr>
            <th>Task ID</th>
            <th>Task Name</th>
            <th>Description</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Progress</th>
        </tr>
        <?php
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT TaskID, TaskName, Description, DueDate, Status, ProgressPercentage
                FROM Tasks
                WHERE AssignedTo = $user_id OR CreatedBy = $user_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['TaskID']}</td><td>{$row['TaskName']}</td><td>{$row['Description']}</td><td>{$row['DueDate']}</td><td>{$row['Status']}</td><td>{$row['ProgressPercentage']}%</td></tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No tasks found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
