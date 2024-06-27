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
    <title>Status Tracking</title>
</head>
<body>
    <h2>Status Tracking</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="status_tracking.php" method="post">
        Task ID: <input type="number" name="task_id" required><br>
        Status: <input type="text" name="status" required><br>
        <input type="submit" name="update_status" value="Update Status">
    </form>

    <?php
    if (isset($_POST['update_status'])) {
        $task_id = $_POST['task_id'];
        $status = $_POST['status'];

        $sql = "UPDATE Tasks
                SET Status = '$status', LastUpdateTimestamp = NOW()
                WHERE TaskID = $task_id";

        if ($conn->query($sql) === TRUE) {
            echo "Status updated successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
