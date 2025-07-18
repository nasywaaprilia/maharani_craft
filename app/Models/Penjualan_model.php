<?php
namespace App\Models;

use CodeIgniter\Model;

class Penjualan_model extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id_penjualan';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_penjualan',
        'tanggal'
    ];

    public function getPenjualan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }

    public function insertPenjualan($data)
    {
        return $this->insert($data);
    }

    public function updatePenjualan($data, $id)
    {
        return $this->update($id, $data);
    }

    public function deletePenjualan($id)
    {
        return $this->delete($id);
    }
}
