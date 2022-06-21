<?php

namespace Model;

use Helper\Config;

class BaseModel
{
    protected $connection;
    protected $data;

    public function __construct()
    {
        $host = Config::database('mysql.host');
        $dbname = Config::database('mysql.db_name');
        try {
            $this->connection = new \PDO("mysql:host={$host};dbname={$dbname}", Config::database('mysql.db_user'), Config::database('mysql.db_password'));
        } catch(\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function __get($property)
    {

        return $this->data->{$property};
    }
}