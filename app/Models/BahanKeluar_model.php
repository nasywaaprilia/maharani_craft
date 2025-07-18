<?php
namespace App\Models;

use CodeIgniter\Model;

class BahanKeluar_model extends Model
{
    protected $table = 'bahan_keluar';
    protected $primaryKey = 'id_bahankeluar';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_bahankeluar',
        'id_produksi',
        'tanggal'
    ];

    public function getBahanKeluar($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }

    public function insertBahanKeluar($data)
    {
        return $this->insert($data);
    }

    public function updateBahanKeluar($data, $id)
    {
        return $this->update($id, $data);
    }

    public function deleteBahanKeluar($id)
    {
        return $this->delete($id);
    }
}
