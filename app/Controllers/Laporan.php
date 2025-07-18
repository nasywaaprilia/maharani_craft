<?php namespace App\Controllers;

use App\Models\Laporan_model;
use CodeIgniter\Controller;

class Laporan extends Controller
{
    protected $laporan_model;

    public function __construct()
    {
        $this->laporan_model = new Laporan_model();
    }

    public function index()
    {
        return view('laporan/index');
    }

    public function laporanProduk()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->laporan_model->getLaporanProduk($bulan, $tahun)
        ];

        return view('laporan/laporanproduk', $data);
    }

    public function laporanBahan()
    {
        $bulan = $this->request->getGet('bulan');
        $tahun = $this->request->getGet('tahun');

        $data = [
            'bulan' => $bulan,
            'tahun' => $tahun,
            'laporan' => $this->laporan_model->getLaporanBahanBaku($bulan, $tahun)
        ];

        return view('laporan/laporanbahan', $data);
    }
}
