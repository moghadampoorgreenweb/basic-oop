<?php

namespace Model;

use Helper\Config;

class Task extends BaseModel
{
    public function verifyUser($email, $password)
    {
        $get = $this->connection->query("SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        $this->data = $get->fetch(\PDO::FETCH_OBJ);

        return $this->data;
    }
}