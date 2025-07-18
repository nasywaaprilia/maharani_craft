<?php
namespace App\Models;
use CodeIgniter\Model;
class Product_model extends Model
{
    protected $table = 'produk';

    protected $primaryKey = 'id_produk'; 

    protected $returnType = 'array';


    protected $allowedFields = [
        'id_produk',
        'id_kategori',
        'nama_produk',
        'satuan',
        'harga_produk',
        'gambar_produk',
    ];

    public function getProduct($id = false)
    {
        if ($id === false) {
            return $this->table('produk')
                ->join('kategori', 'kategori.id_kategori = produk.id_kategori')
                ->get()
                ->getResultArray();
        } else {
            return $this->table('produk')
                ->join('kategori', 'kategori.id_kategori = produk.id_kategori')
                ->where('produk.id_produk', $id)
                ->get()
                ->getRowArray();
        }
    }
    public function insertProduct($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
    public function updateProduct($data, $id)
{
    return $this->db->table($this->table)->update($data, ['id_produk' => $id]);
}
public function deleteProduct($id)
{
    return $this->db->table($this->table)->delete(['id_produk' => $id]);
}

        
    
}
