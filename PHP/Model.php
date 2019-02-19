<?php

abstract class Model
{
    private $_db;
    private function getDatabase()
    {
        try
        {
            $db = new PDO("mysql:host=localhost;dbname=database_music;charset=UTF8", "phpmyadmin", "123456789");
        }catch (Exception $e)
        {
            return (false);
        }
        $this->_db = $db;
    }
    protected function getDb()
    {
        if ($this->_db === null)
            $this->getDatabase();
        return ($this->_db);
    }
}