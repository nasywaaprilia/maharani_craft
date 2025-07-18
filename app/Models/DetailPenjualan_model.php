<?php
namespace App\Models;

use CodeIgniter\Model;

class DetailPenjualan_model extends Model
{
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_penjualan',
        'id_produk',
        'jumlah',
        'satuan'
    ];

    public function getByPenjualan($id_penjualan)
    {
        return $this->where('id_penjualan', $id_penjualan)
                    ->join('produk', 'produk.id_produk = detail_penjualan.id_produk')
                    ->findAll();
    }

    public function insertBatchDetail($data)
    {
        return $this->insertBatch($data);
    }

    public function deleteByPenjualan($id_penjualan)
    {
        return $this->where('id_penjualan', $id_penjualan)->delete();
    }
}
