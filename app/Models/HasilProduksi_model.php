<?php
namespace App\Models;

use CodeIgniter\Model;

class HasilProduksi_model extends Model
{
    protected $table = 'hasilproduksi';
    protected $primaryKey = 'id_produksi';
    protected $returnType = 'array';
    protected $allowedFields = [
        'id_produksi',
        'tanggal_produksi',
        'keterangan'
    ];

    public function getHasilProduksi($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->find($id);
        }
    }

    public function insertHasilProduksi($data)
    {
        return $this->insert($data);
    }

    public function updateHasilProduksi($data, $id)
    {
        return $this->update($id, $data);
    }

    public function deleteHasilProduksi($id)
    {
        return $this->delete($id);
    }
}
