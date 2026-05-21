<?php

namespace App\Models;

class GalleryModel extends BaseModel
{
    protected $table = 'tb_galeri';
    protected $primaryKey = 'id_galeri';

    public function getById($id)
    {
        $id = intval($id);
        $query = "SELECT * FROM {$this->table} WHERE id_galeri = {$id}";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->table} ORDER BY tanggal DESC";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatest($limit = 6)
    {
        $limit = intval($limit);
        $query = "SELECT * FROM {$this->table} ORDER BY tanggal DESC LIMIT {$limit}";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
