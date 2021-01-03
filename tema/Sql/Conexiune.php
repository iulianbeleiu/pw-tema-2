<?php

class Conexiune
{
    private static $instance = null;

    private $connection = null;

    private $host = 'database';

    private $user = 'root';

    private $password = 'root';

    private $databaseName = 'tema';

    private function __construct() {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};
                port=3306;
                dbname={$this->databaseName}",
                $this->user,
                $this->password
            );
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new Conexiune();
        }

        return self::$instance;
    }

    public function getConnection(): Pdo
    {
        return $this->connection;
    }
}