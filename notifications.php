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
    <title>Notifications</title>
</head>
<body>
    <h2>Notifications</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <table border="1">
        <tr>
            <th>Notification ID</th>
            <th>Task ID</th>
            <th>Type</th>
            <th>Content</th>
            <th>Timestamp</th>
        </tr>
        <?php
        $user_id = $_SESSION['user_id']; // Example user ID, replace with session or login user ID
        $sql = "SELECT NotificationID, TaskID, NotificationType, NotificationContent, NotificationTimestamp
                FROM Notifications
                WHERE UserID = $user_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>{$row['NotificationID']}</td><td>{$row['TaskID']}</td><td>{$row['NotificationType']}</td><td>{$row['NotificationContent']}</td><td>{$row['NotificationTimestamp']}</td></tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No notifications found</td></tr>";
        }
        ?>
    </table>
</body>
</html>
