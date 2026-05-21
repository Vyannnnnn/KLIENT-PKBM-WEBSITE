<?php

namespace App\Models;

class ContactModel extends BaseModel
{
    protected $table = 'tb_kontak';
    protected $primaryKey = 'id_kontak';

    public function saveMessage($nama, $email, $telepon = '', $pesan)
    {
        $nama = $this->conn->real_escape_string($nama);
        $email = $this->conn->real_escape_string($email);
        $telepon = $this->conn->real_escape_string($telepon);
        $pesan = $this->conn->real_escape_string($pesan);

        $query = "INSERT INTO {$this->table} (nama, email, telepon, pesan, status) 
                  VALUES ('{$nama}', '{$email}', '{$telepon}', '{$pesan}', 'baru')";
        
        return $this->conn->query($query);
    }

    public function getMessages()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC) ?? [];
    }

    public function markAsRead($id)
    {
        $id = intval($id);
        $query = "UPDATE {$this->table} SET status = 'dibaca' WHERE {$this->primaryKey} = {$id}";
        return $this->conn->query($query);
    }

    public function getById($id)
    {
        $id = intval($id);
        $query = "SELECT * FROM {$this->table} WHERE {$this->primaryKey} = {$id}";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }
}
