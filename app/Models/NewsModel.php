<?php

namespace App\Models;

class NewsModel extends BaseModel
{
    protected $table = 'tb_berita';
    protected $primaryKey = 'id_berita';

    public function getByIdWithCategory($id)
    {
        $id = $this->conn->real_escape_string($id);
        $query = "SELECT b.*, k.nama_kategori 
                  FROM {$this->table} b
                  LEFT JOIN tb_kategori k ON b.id_kategori = k.id_kategori
                  WHERE b.id_berita = '{$id}'";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function getAllWithCategory()
    {
        $query = "SELECT b.*, k.nama_kategori 
                  FROM {$this->table} b
                  LEFT JOIN tb_kategori k ON b.id_kategori = k.id_kategori
                  ORDER BY b.tanggal DESC
                  LIMIT 10";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestNews($limit = 3)
    {
        $limit = intval($limit);
        $query = "SELECT b.*, k.nama_kategori 
                  FROM {$this->table} b
                  LEFT JOIN tb_kategori k ON b.id_kategori = k.id_kategori
                  ORDER BY b.tanggal DESC
                  LIMIT {$limit}";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getByCategoryId($category_id, $limit = null)
    {
        $category_id = intval($category_id);
        $limit_clause = $limit ? "LIMIT " . intval($limit) : '';
        $query = "SELECT b.*, k.nama_kategori 
                  FROM {$this->table} b
                  LEFT JOIN tb_kategori k ON b.id_kategori = k.id_kategori
                  WHERE b.id_kategori = {$category_id}
                  ORDER BY b.tanggal DESC
                  {$limit_clause}";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
