<?php 

class Database
{
    public $hostname = 'localhost';
    public $username = 'root';
    public $password = '';
    public $db = 'business';

    public $conn = null;
    public function getConnection()
    {
        if (null === $this->conn) {
            $this->dbConnect();
        }
        echo "Connection successfull";
        return $this->conn;
    }

    /**
     * Establish database connection.
     */
    private function dbConnect()
    {
        try {
            $this->conn = new PDO("mysql:host=" . $this->hostname . ";dbname=" . $this->db,
                $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Connect error ' . $e->getMessage());
        }
    }
}
