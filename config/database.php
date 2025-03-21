<?php
class Database {
    private string $host = "localhost";
    private string $db_name = "test1";
    private string $username = "root";
    private string $password = "0949550795";
    private ?PDO $conn = null;

    public function getConnection(): ?PDO {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
                $this->conn = new PDO($dsn, $this->username, $this->password, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $exception) {
                error_log("Connection error: " . $exception->getMessage());
                return null;
            }
        }
        return $this->conn;
    }
}
