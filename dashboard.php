<?php
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit();
    }
    require_once 'templates/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>Dashboard</h1>
            <p>Welcome, User!</p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>
</div>

<?php
    require_once 'templates/footer.php';
?>
