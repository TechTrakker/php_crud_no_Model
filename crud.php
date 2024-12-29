<?php
include 'db.php';

 
$name = $email = $phone = "";
$edit_id = null;

 
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "INSERT INTO users (name, email, phone) VALUES ('$name', '$email', '$phone')";
    $conn->query($sql);
    header('Location: crud.php');
}

 
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE id=$id");
    header('Location: crud.php');
}

 
if (isset($_GET['edit'])) {
    $edit_id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM users WHERE id=$edit_id");
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
}

// Update record
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $conn->query("UPDATE users SET name='$name', email='$email', phone='$phone' WHERE id=$id");
    header('Location: crud.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP CRUD Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .form-container {
            max-width: 500px;
            margin-bottom: 20px;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        .form-container button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .form-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>PHP CRUD Application</h1>

<div class="form-container">
    <form action="crud.php" method="POST">
        <input type="hidden" name="id" value="<?= $edit_id ?>">
        <input type="text" name="name" placeholder="Name" value="<?= $name ?>" required>
        <input type="email" name="email" placeholder="Email" value="<?= $email ?>" required>
        <input type="text" name="phone" placeholder="Phone" value="<?= $phone ?>" required>
        <?php if ($edit_id): ?>
            <button type="submit" name="update">Update</button>
        <?php else: ?>
            <button type="submit" name="create">Create</button>
        <?php endif; ?>
    </form>
</div>
<?php
include 'db.php';  
?>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = $conn->query("SELECT * FROM users");
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['name'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['phone'] ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
                <a href="crud.php?edit=<?= $row['id'] ?>">Edit</a> |
                <a href="crud.php?delete=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
