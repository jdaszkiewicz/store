<?php
require_once 'db.php';
require_once 'auth.php';

function handleRegistration($db) {
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($username)) {
            $errors[] = "Username is required.";
        }
        if (empty($password)) {
            $errors[] = "Password is required.";
        }
        if ($password != $confirm_password) {
            $errors[] = "Passwords do not match.";
        }

        if (empty($errors)) {
            if (registerUser($db, $username, $password)) {
                header('Location: login.php');
                exit();
            } else {
                $errors[] = "Registration failed";
            }
        }
    }
    return $errors;
}

function handleLogin($db) {
    $errors = [];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $errors[] = "Username is required.";
        }
        if (empty($password)) {
            $errors[] = "Password is required.";
        }

        if (empty($errors)) {
            $user = loginUser($db, $username, $password);
            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                header('Location: dashboard.php');
                exit();
            } else {
                $errors[] = "Invalid username or password";
            }
        }
    }
    return $errors;
}

function getProducts($db) {
    $query = "SELECT * FROM products";
    $result = $db->query($query);
    $products = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $products[] = $row;
    }
    return $products;
}
?>
