<?php namespace App\Models;

use CodeIgniter\Model;

class Laporan_model extends Model
{
    protected $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect();
    }

    public function getLaporanProduk($bulan = null, $tahun = null)
    {
        $builder = $this->db->table('produk p')
    ->select('p.nama_produk, p.satuan,
        (SELECT COALESCE(SUM(jumlah), 0) FROM listpo WHERE id_produk = p.id_produk' . ($bulan ? ' AND MONTH(tanggal) = '.$bulan : '') . ($tahun ? ' AND YEAR(tanggal) = '.$tahun : '') . ') AS jumlah_po,
        (SELECT COALESCE(SUM(stok_produk), 0) FROM detail_hasilproduksi WHERE id_produk = p.id_produk' . ($bulan ? ' AND MONTH(created_at) = '.$bulan : '') . ($tahun ? ' AND YEAR(created_at) = '.$tahun : '') . ') AS jumlah_produksi,
        (SELECT COALESCE(SUM(jumlah), 0) FROM detail_penjualan WHERE id_produk = p.id_produk' . ($bulan ? ' AND MONTH(created_at) = '.$bulan : '') . ($tahun ? ' AND YEAR(created_at) = '.$tahun : '') . ') AS jumlah_terjual,
        ((SELECT COALESCE(SUM(stok_produk), 0) FROM detail_hasilproduksi WHERE id_produk = p.id_produk) - 
         (SELECT COALESCE(SUM(jumlah), 0) FROM detail_penjualan WHERE id_produk = p.id_produk)) AS stok_tersedia')
    ->groupBy('p.id_produk');


        if ($bulan) {
            $builder->where('MONTH(po.tanggal)', $bulan);
            $builder->where('MONTH(hp.created_at)', $bulan);
            $builder->where('MONTH(dp.created_at)', $bulan);
        }

        if ($tahun) {
            $builder->where('YEAR(po.tanggal)', $tahun);
            $builder->where('YEAR(hp.created_at)', $tahun);
            $builder->where('YEAR(dp.created_at)', $tahun);
        }

        $builder->groupBy('p.id_produk');
        return $builder->get()->getResult();
    }

    public function getLaporanBahanBaku($bulan = null, $tahun = null)
{
    $builder = $this->db->table('bahan_baku b')
        ->select('b.nama_bahan, b.satuan, b.stok AS stok_awal,
                  COALESCE(SUM(dbk.jumlah), 0) as jumlah_keluar,
                  (b.stok - COALESCE(SUM(dbk.jumlah), 0)) as stok_tersedia')
        ->join('detail_bahankeluar dbk', 'dbk.id_bahan = b.id_bahan', 'left')
        ->join('bahan_keluar bk', 'bk.id_bahankeluar = dbk.id_bahankeluar', 'left');

    if ($bulan) {
        $builder->where('MONTH(bk.tanggal)', $bulan);
    }
    if ($tahun) {
        $builder->where('YEAR(bk.tanggal)', $tahun);
    }

    $builder->groupBy('b.id_bahan');

    return $builder->get()->getResult();
}

}
