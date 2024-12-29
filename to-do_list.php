<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List with Edit and Delete Options</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px auto;
            max-width: 600px;
            text-align: center;
        }
        form {
            margin-bottom: 20px;
        }
        input {
            padding: 10px;
            margin: 5px;
            width: 70%;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .delete-btn, .edit-btn {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
        }
        .edit-btn {
            background-color: #ff9800;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .edit-btn:hover {
            background-color: #e68900;
        }
    </style>
</head>
<body>
    <h1 style="color: red">To-Do List for Names</h1>
    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit">Add Name</button>
    </form>

    <?php
    session_start();

    // Initialize the to-do list if not already set
    if (!isset($_SESSION['tasks'])) {
        $_SESSION['tasks'] = [];
    }

    // Add a new task
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['task'])) {
        $task = htmlspecialchars(trim($_POST['task']));
        $_SESSION['tasks'][] = $task;
    }

    // Handle delete
    if (isset($_GET['delete'])) {
        $index = intval($_GET['delete']);
        if (isset($_SESSION['tasks'][$index])) {
            array_splice($_SESSION['tasks'], $index, 1);
        }
    }

    // Handle edit
    if (isset($_POST['edit_task']) && isset($_POST['edit_index'])) {
        $edit_index = intval($_POST['edit_index']);
        $edit_task = htmlspecialchars(trim($_POST['edit_task']));
        if (isset($_SESSION['tasks'][$edit_index])) {
            $_SESSION['tasks'][$edit_index] = $edit_task;
        }
    }
    ?>

    <h2 style="color: red;">Add & Delete Names:</h2>
    <ul>
        <?php
        foreach ($_SESSION['tasks'] as $index => $task) {
            echo "<li>
                    $task
                    <a href='?edit=$index'><button class='edit-btn'>Edit</button></a>
                    <a href='?delete=$index'><button class='delete-btn'>Delete</button></a>
                  </li>";
        }
        ?>
    </ul>

    <?php
    // Show edit form if edit is clicked
    if (isset($_GET['edit'])) {
        $edit_index = intval($_GET['edit']);
        if (isset($_SESSION['tasks'][$edit_index])) {
            $task_to_edit = $_SESSION['tasks'][$edit_index];
            echo "<form method='POST'>
                    <input type='hidden' name='edit_index' value='$edit_index'>
                    <input type='text' name='edit_task' value='$task_to_edit' required>
                    <button type='submit'>Update Name</button>
                  </form>";
        }
    }
    ?>
</body>
</html>
