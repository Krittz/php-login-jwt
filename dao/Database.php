<?php
class Database
{
    private static $instance = null;
    private $connection;
    private function __construct($database_file)
    {
        $this->connection = new SQLite3($database_file);
    }
    public static function getInstance($database_file)
    {
        if (self::$instance === null) {
            self::$instance = new self($database_file);
        }
        return self::$instance;
    }
    public function getConnection(){
        return $this->connection;
    }
}
