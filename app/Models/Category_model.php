<?php namespace App\Models;

use CodeIgniter\Model;

class Category_model extends Model {
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $allowedFields = ['nama_kategori', 'status_kategori'];

    // Fungsi untuk mendapatkan data kategori (semua atau berdasarkan ID)
    public function getCategory($id = false) {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_kategori' => $id]);
        }
    }

    // Fungsi untuk menambah data kategori baru
    public function insertCategory($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Fungsi untuk memperbarui data kategori berdasarkan ID
    public function updateCategory($data, $id) {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus data kategori berdasarkan ID
    public function deleteCategory($id) {
        return $this->delete(['id_kategori' => $id]);
    }
}
