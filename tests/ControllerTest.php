<?php
use PHPUnit\Framework\TestCase;

require_once 'controller.php';
require_once 'db.php';

class ControllerTest extends TestCase
{
    private $db;

    protected function setUp(): void
    {
        $this->db = new SQLite3(':memory:');
        $this->db->exec("CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE,
            password TEXT
        )");
        $this->db->exec("CREATE TABLE products (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            description TEXT,
            image TEXT,
            price REAL,
            premium INTEGER DEFAULT 0
        )");
        if (session_status() == PHP_SESSION_NONE && !headers_sent()) {
            session_start();
        }
    }

    protected function tearDown(): void
    {
        $this->db->close();
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
    }

    public function testHandleRegistration()
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'password';
        $_POST['confirm_password'] = 'password';
        $errors = handleRegistration($this->db);
        $this->assertEmpty($errors);

        $_POST['username'] = '';
        $errors = handleRegistration($this->db);
        $this->assertNotEmpty($errors);

        $_POST['username'] = 'testuser';
        $_POST['password'] = 'password';
        $_POST['confirm_password'] = 'wrongpassword';
        $errors = handleRegistration($this->db);
        $this->assertNotEmpty($errors);
    }

    public function testHandleLogin()
    {
        registerUser($this->db, 'testuser', 'password');
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['username'] = 'testuser';
        $_POST['password'] = 'password';
        $errors = handleLogin($this->db);
        $this->assertEmpty($errors);

        $_POST['username'] = '';
        $errors = handleLogin($this->db);
        $this->assertNotEmpty($errors);

        $_POST['username'] = 'testuser';
        $_POST['password'] = 'wrongpassword';
        $errors = handleLogin($this->db);
        $this->assertNotEmpty($errors);
    }

    public function testGetProducts()
    {
        $this->db->exec("INSERT INTO products (name, description, image, price) VALUES ('Test Product', 'Test Description', 'test.jpg', 10.00)");
        $products = getProducts($this->db);
        $this->assertNotEmpty($products);
        $this->assertIsArray($products);
    }

    public function testGetProductsLoggedIn()
    {
        registerUser($this->db, 'testuser', 'password');
        loginUser($this->db, 'testuser', 'password');
        $this->db->exec("INSERT INTO products (name, description, image, price) VALUES ('Test Product', 'Test Description', 'test.jpg', 10.00)");
        $products = getProducts($this->db);
        $this->assertNotEmpty($products);
        $this->assertIsArray($products);
    }

}
?>
