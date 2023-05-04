<?php

class Session

{
    public function __construct()

    {
        session_start();
    }

    public function set($key, $value)

    {
        $_SESSION[$key] = $value;
    }

    public function get($key)

    {
        return $_SESSION[$key] ?? null;
    }

    public function delete($key)
    
    {
        unset($_SESSION[$key]);
    }
}

//INSERT INTO test.users (username, password) VALUES ('admin', '$2y$10$XNY3R2FhkJA39jB/W7PCiu5XGMtQZnrUFq6oCFpmmUqzSKJivyNTG%');