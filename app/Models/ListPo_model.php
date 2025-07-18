<?php
namespace App\Models;
use CodeIgniter\Model;
class ListPo_model extends Model
{
    protected $table = 'listpo';

    protected $primaryKey = 'id_po'; 

    protected $returnType = 'array';

    protected $allowedFields = [
        'id_po',
        'nama_customer',
        'tanggal',
        'id_produk',
        'jumlah',
        'no_hp',
    ];

    public function getListPo($id = false)
    {
        if ($id === false) {
            return $this->table('listpo')
                ->join('produk', 'produk.id_produk = listpo.id_produk')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('listpo')
                ->join('produk', 'produk.id_produk = listpo.id_produk')
                ->where('listpo.id_produk', $id)
                ->get()
                ->getRowArray();
        }
    }
    public function insertListPo($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateListPo($data, $id)
{
    return $this->db->table($this->table)->update($data, ['id_po' => $id]);
}
public function deleteListPo($id)
{
    return $this->db->table($this->table)->delete(['id_po' => $id]);
}

        
    
}
