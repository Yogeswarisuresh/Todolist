<?php
// Database connection
$conn = new mysqli('localhost', 'root', 'Yogi$2004@18', 'todo_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add task
if (isset($_POST['submit'])) {
    $task = $_POST['task'];
    $sql = "INSERT INTO tasks (task) VALUES ('$task')";
	// runs the above query in mysql
    $conn->query($sql);
}

// Delete task
if (isset($_GET['del_task'])) {
    $id = $_GET['del_task'];
    $sql = "DELETE FROM tasks WHERE id=$id";
    $conn->query($sql);
}

// Fetch tasks
$tasks = $conn->query("SELECT * FROM tasks");
?>
<!DOCTYPE html>
<html>
<head>
    <title>To-Do List Application</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <h2>To-Do List</h2>
    <form method="POST" action="index.php">
        <input type="text" name="task" required>
        <button type="submit" name="submit">Add Task</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; while ($row = $tasks->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $row['task']; ?></td>
                    <td><a href="index.php?del_task=<?php echo $row['id']; ?>">Delete</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>
