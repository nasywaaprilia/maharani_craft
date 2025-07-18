<?php namespace App\Models;

use CodeIgniter\Model;

class Supplier_model extends Model {
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $allowedFields = ['nama_supplier', 'alamat','no_hp'];

    // Fungsi untuk mendapatkan data kategori (semua atau berdasarkan ID)
    public function getSupplier($id = false) {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_supplier' => $id]);
        }
    }

    // Fungsi untuk menambah data kategori baru
    public function insertSupplier($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Fungsi untuk memperbarui data kategori berdasarkan ID
    public function updateSupplier($data, $id) {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus data kategori berdasarkan ID
    public function deleteSupplier($id) {
        return $this->delete(['id_supplier' => $id]);
    }
}
