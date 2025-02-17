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
                if (PHP_SAPI !== 'cli') {
                    header('Location: login.php');
                    exit();
                }
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
                $_SESSION['user_id'] = $user['id'];
                if (PHP_SAPI !== 'cli') {
                    header('Location: index.php');
                    exit();
                }
            } else {
                $errors[] = "Invalid username or password";
            }
        }
    }
    return $errors;
}

function getProducts($db) {
    if (isset($_SESSION['user_id'])) {
        $query = "SELECT * FROM products";
        $result = $db->query($query);
        $products = [];
        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $products[] = $row;
        }
        return $products;
    } else {
        $query = "SELECT * FROM products WHERE premium IS NULL OR premium = 0";
        $result = $db->query($query);
        $products = [];
         while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $products[] = $row;
        }
        return $products;
    }
}

function isUserLoggedIn() {
    return isset($_SESSION['user_id']);
}
?>
