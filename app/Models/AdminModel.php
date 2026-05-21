<?php

namespace App\Models;

class AdminModel extends BaseModel
{
    protected $table = 'tb_admin';
    protected $primaryKey = 'id_admin';

    public function getByUsername($username)
    {
        $username = $this->conn->real_escape_string($username);
        $query = "SELECT * FROM {$this->table} WHERE username = '{$username}'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function getById($id)
    {
        $id = intval($id);
        $query = "SELECT id_admin, username, nama_admin FROM {$this->table} WHERE id_admin = {$id}";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function verifyPassword($plain_password, $hashed_password)
    {
        return password_verify($plain_password, $hashed_password);
    }

    public function hashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}
