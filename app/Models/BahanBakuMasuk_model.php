<?php namespace App\Models;

use CodeIgniter\Model;

class BahanBakuMasuk_model extends Model {
    protected $table = 'bahan_baku';
    protected $primaryKey = 'id_bahan';
    protected $allowedFields = ['nama_bahan', 'satuan', 'stok', 'id_supplier', 'tanggal_masuk'];

    // Fungsi untuk mendapatkan data kategori (semua atau berdasarkan ID)
    public function getBahanBakuMasuk($id = false) {
        if ($id === false) {
            return $this->table('bahan_baku')
                ->join('supplier', 'supplier.id_supplier = bahan_baku.id_supplier')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('bahan_baku')
                ->join('supplier', 'supplier.id_supplier = bahan_baku.id_supplier')
                ->where('bahan_baku.id_bahan', $id)
                ->get()
                ->getRowArray();
        }
    }

    // Fungsi untuk menambah data kategori baru
    public function insertBahanBakuMasuk($data) {
        return $this->db->table($this->table)->insert($data);
    }

    // Fungsi untuk memperbarui data kategori berdasarkan ID
    public function updateBahanBakuMasuk($data, $id) {
        return $this->update($id, $data);
    }

    // Fungsi untuk menghapus data kategori berdasarkan ID
    public function deleteBahanBakuMasuk($id) {
        return $this->delete(['id_bahan' => $id]);
    }
}
