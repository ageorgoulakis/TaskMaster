<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

// Fetch users for dropdown
$user_sql = "SELECT UserID, Name FROM Users";
$user_result = $conn->query($user_sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>
</head>
<body>
    <h2>Create Task</h2>
    <button onclick="window.location.href='dashboard.php';">Back to Dashboard</button>
    <br><br>
    <form action="create_task.php" method="post">
        Task Name: <input type="text" name="task_name" required><br>
        Description: <textarea name="description"></textarea><br>
        Assigned To: 
        <select name="assigned_to" required>
            <?php
            if ($user_result->num_rows > 0) {
                while ($user_row = $user_result->fetch_assoc()) {
                    echo "<option value='{$user_row['UserID']}'>{$user_row['Name']}</option>";
                }
            } else {
                echo "<option value=''>No users found</option>";
            }
            ?>
        </select><br>
        Due Date: <input type="date" name="due_date" required><br>
        Priority: <input type="number" name="priority" required><br>
        Status: <input type="text" name="status" required><br>
        Project ID: <input type="number" name="project_id"><br>
        <input type="submit" name="create" value="Create Task">
    </form>

    <?php
    if (isset($_POST['create'])) {
        $task_name = $_POST['task_name'];
        $description = $_POST['description'];
        $created_by = $_SESSION['user_id'];
        $assigned_to = $_POST['assigned_to'];
        $due_date = $_POST['due_date'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];
        $project_id = $_POST['project_id'];

        $sql = "INSERT INTO Tasks (TaskName, Description, CreatedBy, AssignedTo, DueDate, Priority, Status, ProjectID)
                VALUES ('$task_name', '$description', $created_by, $assigned_to, '$due_date', $priority, '$status', $project_id)";

        if ($conn->query($sql) === TRUE) {
            echo "Task created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    ?>
</body>
</html>
