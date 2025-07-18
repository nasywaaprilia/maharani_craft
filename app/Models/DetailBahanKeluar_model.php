<?php
namespace App\Models;

use CodeIgniter\Model;

class DetailBahanKeluar_model extends Model
{
    protected $table = 'detail_bahankeluar';
    
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_bahankeluar',
        'id_bahan',
        'jumlah',
        'satuan'
    ];

    public function getByBahanKeluar($id_bahankeluar)
    {
        return $this->select('detail_bahankeluar.*, bahan_baku.nama_bahan')
                    ->join('bahan_baku', 'bahan_baku.id_bahan = detail_bahankeluar.id_bahan')
                    ->where('id_bahankeluar', $id_bahankeluar)
                    ->findAll();
    }

    public function insertBatchDetail($data)
    {
        return $this->insertBatch($data);
    }

    public function deleteByBahanKeluar($id_bahankeluar)
    {
        return $this->where('id_bahankeluar', $id_bahankeluar)->delete();
    }
}
