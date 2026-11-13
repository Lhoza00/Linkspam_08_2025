<?php
class Database {
    private $db_server = "localhost";
    private $db_user = "root";
    private $db_pass = "";
    private $db_name = "linkspamdb";
    private $conn;

    // Establish connection using PDO
    function connect() {
        try {
            $dsn = "mysql:host={$this->db_server};dbname={$this->db_name};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,      // Fetch associative arrays
                PDO::ATTR_EMULATE_PREPARES   => false,                 // Use real prepared statements
            ];
            $this->conn = new PDO($dsn, $this->db_user, $this->db_pass, $options);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
        return $this->conn;
    }

    // Read data (SELECT queries)
    function read($query, $params = []) {
        $conn = $this->connect();
        try {
            $stmt = $conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Read error: " . $e->getMessage());
            return false;
        }
    }

    // Save data (INSERT, UPDATE, DELETE)
    function save($query, $params = []) {
        $conn = $this->connect();
        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Save error: " . $e->getMessage());
            return false;
        }
    }
}
?>
<?php 
    if($_SERVER['PHP_SELF'] === '/Linkspam/Database.php'){
        session_start();
        if(empty($_SESSION['myuserId'])){
            session_destroy();
            header('Location: /Linkspam/Index.php');
            exit;
        }else{
            header('Location: /Linkspam/Home.php');
            exit;
        }
    }
?>
