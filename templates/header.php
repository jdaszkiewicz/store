<!DOCTYPE html>
<html lang="en">
<?php
require_once 'controller.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exotic Fruits Store</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Exotic Fruits Store</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <?php
                    if (isUserLoggedIn()) {
                        echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>';
                        echo '<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
