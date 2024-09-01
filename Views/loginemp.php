<?php
session_start();
require_once 'C:/xampp/htdocs/ta/Controller/configg.php';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Get the PDO connection from the Config class
        $pdo = Config::getConnexion();

        // Query to find the user by their email
        $stmt = $pdo->prepare("SELECT * FROM employe WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Compare passwords directly if they are stored as plain text
        if ($user && $password === $user['password']) {
            // Password is correct, set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            header("Location: http://localhost/ta/views/index.php"); // Redirect to the front office after successful login
            exit();
        } else {
            $error = "Invalid username or password!";
        }
    } catch (Exception $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-color {
            background-color: #0e1c36;
            color: #fff;
        }
        .profile-image-pic {
            height: 200px;
            width: 200px;
            object-fit: cover;
        }
        .cardbody-color {
            background-color: #ebf2fa;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center text-dark mt-5">Login Form</h2>
            <div class="text-center mb-5 text-dark">Made with Bootstrap</div>
            <div class="card my-5">
                <form method="POST" action="" class="card-body cardbody-color p-lg-5">
                    <div class="text-center">
                        <img src="https://cdn.pixabay.com/photo/2016/03/31/19/56/avatar-1295397__340.png" class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px" alt="profile">
                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger text-center">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" id="Username" placeholder="User Name" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-color px-5 mb-5 w-100">Login</button>
                    </div>
                    <div id="emailHelp" class="form-text text-center mb-5 text-dark">Not Registered? 
                        <a href="#" class="text-dark fw-bold">Create an Account</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
