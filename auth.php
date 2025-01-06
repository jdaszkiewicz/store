<?php
    session_start();

    function registerUser($db, $username, $password) {
        $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $count = $result->fetchArray()[0];
        if ($count > 0) {
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $stmt->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        $result = $stmt->execute();
        return $result;
    }

    function loginUser($db, $username, $password) {
        $stmt = $db->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindValue(':username', $username, SQLITE3_TEXT);
        $result = $stmt->execute();
        $user = $result->fetchArray(SQLITE3_ASSOC);
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            session_write_close();
            return true;
        }
        return false;
    }

    function logoutUser() {
        session_unset();
        session_destroy();
        header('Location: login.php');
        exit();
    }
?>
