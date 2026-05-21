<?php

namespace App\Models;

use App\Config\Database;

class BaseModel
{
    protected $conn;
    protected $table;
    protected $primaryKey = 'id';

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY {$this->primaryKey} DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        $id = $this->conn->real_escape_string($id);
        $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = '{$id}'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function insert($data)
    {
        $columns = implode(',', array_keys($data));
        $values = implode("','", array_map([$this->conn, 'real_escape_string'], array_values($data)));
        
        $query = "INSERT INTO {$this->table} ({$columns}) VALUES ('{$values}')";
        
        if ($this->conn->query($query)) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function update($id, $data)
    {
        $id = $this->conn->real_escape_string($id);
        $set = [];
        
        foreach ($data as $key => $value) {
            $value = $this->conn->real_escape_string($value);
            $set[] = "{$key} = '{$value}'";
        }
        
        $set_string = implode(',', $set);
        $query = "UPDATE {$this->table} SET {$set_string} WHERE {$this->primaryKey} = '{$id}'";
        
        return $this->conn->query($query);
    }

    public function delete($id)
    {
        $id = $this->conn->real_escape_string($id);
        $query = "DELETE FROM {$this->table} WHERE {$this->primaryKey} = '{$id}'";
        return $this->conn->query($query);
    }

    protected function custom($query)
    {
        $result = $this->conn->query($query);
        if ($result === true) return true;
        return $result->fetch_all(MYSQLI_ASSOC) ?? [];
    }
}
