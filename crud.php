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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
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
        #navabr {
            font-size: 34px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" id="navabr"> CRUD Application </a>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <footer class="bg-dark text-white pt-5 pb-4  mt-5">
  <div class="container text-center text-md-left">
    <div class="row text-center text-md-left">
      
      <!-- About Section -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">About Us</h5>
        <p>
          We are dedicated to providing high-quality services. Follow us on our social channels for updates.
        </p>
      </div>

      <!-- Links Section -->
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Links</h5>
        <p>
          <a href="#home" class="text-white" style="text-decoration: none;">Home</a>
        </p>
        <p>
          <a href="#about" class="text-white" style="text-decoration: none;">About</a>
        </p>
        <p>
          <a href="#services" class="text-white" style="text-decoration: none;">Services</a>
        </p>
        <p>
          <a href="#contact" class="text-white" style="text-decoration: none;">Contact</a>
        </p>
      </div>

      <!-- Contact Section -->
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Contact</h5>
        <p>
          <i class="fas fa-home mr-3"></i> Sialkot, Pakistan
        </p>
        <p>
          <i class="fas fa-envelope mr-3"></i> muhammadbilal036356@gmail.com
        </p>
        <p>
          <i class="fas fa-phone mr-3"></i> +92 307 9599169
        </p>
      </div>

      <!-- Social Section -->
      <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
        <h5 class="text-uppercase mb-4 font-weight-bold text-warning">Follow Us</h5>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-facebook fa-lg mr-4"></i>
        </a>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-twitter fa-lg mr-4"></i>
        </a>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-instagram fa-lg mr-4"></i>
        </a>
        <a href="#" class="text-white text-decoration-none">
          <i class="fab fa-linkedin fa-lg mr-4"></i>
        </a>
      </div>
    </div>

    <hr class="mb-4" />

    <!-- Copyright Section -->
    <div class="row align-items-center">
      <div class="col-md-7 col-lg-8">
        <p class="text-white">
          © 2024 PHP CAWM | All rights reserved
        </p>
      </div>
      <div class="col-md-5 col-lg-4">
        <p class="text-white text-md-right">
          Developed by <span class="text-warning">Muhammad Bilal</span>
        </p>
      </div>
    </div>
  </div>
</footer>

</body>

</html>