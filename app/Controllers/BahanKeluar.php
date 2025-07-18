<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanKeluar_model;
use App\Models\BahanBakuMasuk_model;
use App\Models\HasilProduksi_model;
use App\Models\DetailBahanKeluar_model;
class BahanKeluar extends Controller
{
    protected $bahankeluar_model;
    protected $bahanbakumasuk_model;
    protected $hasilproduksi_model;
    protected $detail_model;

    public function __construct()
    {
        helper(['form']);
        $this->hasilproduksi_model = new HasilProduksi_model();
        $this->bahanbakumasuk_model = new BahanBakuMasuk_model();
        $this->bahankeluar_model = new BahanKeluar_model();
        $this->detail_model = new DetailBahanKeluar_model(); 

        if (session()->get('level') != 'Produksi') {
            header('Location: ' . base_url('/dashboard'));
            exit;
        }
        
    }

    public function index()
{
    $paginate = 5;
    $keyword = $this->request->getGet('keyword');
    $produksi = $this->request->getGet('produksi');

    $query = $this->bahankeluar_model;

    // Filter keyword
    if (!empty($keyword)) {
        $query = $query->groupStart()
            ->like('id_bahankeluar', $keyword)
            ->orLike('tanggal', $keyword)
            ->orLike('id_produksi', $keyword)
            ->groupEnd();
    }

    // Filter ID Produksi
    if (!empty($produksi)) {
        $query = $query->where('id_produksi', $produksi);
    }

    $bahankeluar = $query
        ->orderBy('id_bahankeluar', 'ASC')
        ->paginate($paginate, 'bahankeluar');

    $ids = array_column($bahankeluar, 'id_bahankeluar');

    $detailBahanKeluar = [];
    if (!empty($ids)) {
        $detailBahanKeluar = $this->detail_model
            ->select('detail_bahankeluar.*, bahan_baku.nama_bahan')
            ->whereIn('id_bahankeluar', $ids)
            ->join('bahan_baku', 'bahan_baku.id_bahan = detail_bahankeluar.id_bahan')
            ->findAll();

    }

    // Tambahkan variabel tambahan
    $data['keyword'] = $this->request->getGet('keyword') ?? '';
    $data['bahan'] = $this->request->getGet('bahan') ?? '';
    $bahanList = $this->bahanbakumasuk_model->select('id_bahan, nama_bahan')->findAll();
    $data['bahan_list'] = ['' => 'Pilih Bahan'] + array_column($bahanList, 'nama_bahan', 'id_bahan');

    $data['bahan_keluar'] = $bahankeluar;
    $data['detail_bahankeluar'] = $detailBahanKeluar;
    $data['pager'] = $this->bahankeluar_model->pager;

    // Ini baris penting untuk nomor urut
    $page = $this->request->getGet('page_bahankeluar') ?? 1;
    $data['nomor'] = ($page - 1) * $paginate;

    $produksiData = $this->hasilproduksi_model->select('id_produksi')->findAll();
    $produksi_list = ['' => 'Pilih ID Produksi'];
    foreach ($produksiData as $p) {
            $produksi_list[$p['id_produksi']] = $p['id_produksi'];
    }
    $data['produksi_list'] = $produksi_list;


    return view('bahankeluar/index', $data);
}

    public function create()
    {
        $data['produksi_list'] = $this->hasilproduksi_model->findAll();
        $data['bahanbaku_list'] = $this->bahanbakumasuk_model->findAll();
        return view('bahankeluar/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

    $id_bahankeluar = $this->request->getPost('id_bahankeluar');
    $id_produksi = $this->request->getPost('id_produksi');
    $tanggal = $this->request->getPost('tanggal');

    // Data utama bahan keluar
    $dataBahanKeluar = [
        'id_bahankeluar' => $id_bahankeluar,
        'id_produksi' => $id_produksi,
        'tanggal' => $tanggal
    ];

    // Ambil array data bahan (multiple input)
    $bahanList = $this->request->getPost('id_bahan');
    $jumlahList = $this->request->getPost('jumlah');
    $satuanList = $this->request->getPost('satuan');


    // Simpan ke table bahan_keluar
    $this->bahankeluar_model->insert($dataBahanKeluar);

    // Simpan detail bahan_keluar
    $detailData = [];
    foreach ($bahanList as $key => $id_bahan) {
        $detailData[] = [
            'id_bahankeluar' => $id_bahankeluar,
            'id_bahan' => $id_bahan,
            'jumlah' => $jumlahList[$key],
            'satuan' => $satuanList[$key]
        ];
    }

    $this->detail_model->insertBatch($detailData);

    session()->setFlashdata('success', 'Data hasil produksi berhasil disimpan.');
    return redirect()->to(base_url('bahankeluar'));
    }

    public function edit($id)
    {
        $data['bahankeluar'] = $this->bahankeluar_model->find($id);
        $data['detail'] = $this->detail_model->getByBahanKeluar($id);
        $data['bahan_list'] = $this->bahanbakumasuk_model->findAll();
        $data['produksi_list'] = $this->hasilproduksi_model->findAll();
        return view('bahankeluar/edit', $data);
    }

    public function update()
{
    $id = $this->request->getPost('id_bahankeluar');

    // Ambil data utama dari form
    $dataBahanKeluar = [
        'id_produksi' => $this->request->getPost('id_produksi'),
        'tanggal'     => $this->request->getPost('tanggal')
    ];

    // Update data utama
    $this->bahankeluar_model->update($id, $dataBahanKeluar);

    // Ambil data detail bahan
    $bahanList  = $this->request->getPost('id_bahan');
    $jumlahList = $this->request->getPost('jumlah');
    $satuanList = $this->request->getPost('satuan');

    // Hapus data detail lama
    $this->detail_model->where('id_bahankeluar', $id)->delete();

    // Simpan ulang data detail
    $detailData = [];
    foreach ($bahanList as $key => $id_bahan) {
        $detailData[] = [
            'id_bahankeluar' => $id,
            'id_bahan'       => $id_bahan,
            'jumlah'         => $jumlahList[$key],
            'satuan'         => $satuanList[$key]
        ];
    }

    $this->detail_model->insertBatch($detailData);

    session()->setFlashdata('info', 'Data bahan keluar berhasil diperbarui.');
    return redirect()->to(base_url('bahankeluar'));
}

    public function delete($id)
    {
        $this->detail_model->deleteByBahanKeluar($id);
        $this->bahankeluar_model->delete($id);
        session()->setFlashdata('warning', 'Data berhasil dihapus.');
        return redirect()->to(base_url('bahankeluar'));
    }
}
