<?php


class Database
{
    public $connection;

    public function __construct($config, $username = 'root', $password = 'Helena12!')

    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        
        $this->connection = new PDO($dsn, $username, $password, 
        [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function getPdo()
    {
        return $this->connection;
    }
}
