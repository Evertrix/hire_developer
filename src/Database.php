<?php
class Database {
    # @object, The PDO object
    protected $pdo;

    # @object, PDO statement object
    protected $sqlMain;

    protected static $instance = null;

    # @array, The parameters of the SQL query
    protected array $parameters = [];
    protected $connection = null;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        $dsn = "mysql:host=localhost;dbname=hire_developers_db;charset=UTF8";

        $options = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try {
            $this->connection = new PDO($dsn, 'root', 'root', $options);

            if ($this->connection) {
                echo "Connected to the hire_developers_db database successfully!";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}