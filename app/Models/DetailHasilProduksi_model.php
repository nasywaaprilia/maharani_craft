<?php
namespace App\Models;

use CodeIgniter\Model;

class DetailHasilProduksi_model extends Model
{
    protected $table = 'detail_hasilproduksi';
    protected $primaryKey = 'id_detail';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_produksi',
        'id_produk',
        'stok_produk',
        'satuan'
    ];

    public function getByProduksi($id_produksi)
    {
        return $this->where('id_produksi', $id_produksi)
                    ->join('produk', 'produk.id_produk = detail_hasilproduksi.id_produk')
                    ->findAll();
    }

    public function insertBatchDetail($data)
    {
        return $this->insertBatch($data);
    }

    public function deleteByProduksi($id_produksi)
    {
        return $this->where('id_produksi', $id_produksi)->delete();
    }
}
