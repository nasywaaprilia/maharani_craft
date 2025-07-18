<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\HasilProduksi_model;
use App\Models\Product_model;
use App\Models\DetailHasilProduksi_model;
class HasilProduksi extends Controller
{
    protected $hasilproduksi_model;
    protected $product_model;
    protected $detail_model;

    public function __construct()
    {
        helper(['form']);
        $this->hasilproduksi_model = new HasilProduksi_model();
        $this->product_model = new Product_model();
        $this->detail_model = new DetailHasilProduksi_model(); 

        if (session()->get('level') != 'Produksi') {
            header('Location: ' . base_url('/dashboard'));
            exit;
        }
        
    }

    public function index()
{
    $paginate = 5;
    $query = $this->hasilproduksi_model;

// Ambil filter dari input
$keyword = $this->request->getGet('keyword');
$produk = $this->request->getGet('produk');

// Filter keyword di id_produksi, tanggal, dan keterangan
if (!empty($keyword)) {
    $query = $query->groupStart()
        ->like('id_produksi', $keyword)
        ->orLike('tanggal_produksi', $keyword)
        ->orLike('keterangan', $keyword)
        ->groupEnd();
}

// Filter berdasarkan produk
if (!empty($produk)) {
    $query = $query->join('detail_hasilproduksi', 'hasilproduksi.id_produksi = detail_hasilproduksi.id_produksi')
                   ->where('detail_hasilproduksi.id_produk', $produk);
}

// Ambil hasil paginate dari query
$hasilProduksi = $query
            ->orderBy('hasilproduksi.id_produksi', 'ASC')
            ->paginate($paginate, 'hasilproduksi');

    $ids = array_column($hasilProduksi, 'id_produksi');

    $detailProduksi = [];
    if (!empty($ids)) {
        $detailProduksi = $this->detail_model
            ->whereIn('id_produksi', $ids)
            ->join('produk', 'produk.id_produk = detail_hasilproduksi.id_produk')
            ->findAll();
    }

    // Tambahkan variabel tambahan
    $data['keyword'] = $this->request->getGet('keyword') ?? '';
    $data['produk'] = $this->request->getGet('produk') ?? '';
    $produkList = $this->product_model->select('id_produk, nama_produk')->findAll();
    $data['produk_list'] = ['' => 'Pilih Produk'] + array_column($produkList, 'nama_produk', 'id_produk');

    $data['hasilproduksi'] = $hasilProduksi;
    $data['detail_produksi'] = $detailProduksi;
    $data['pager'] = $this->hasilproduksi_model->pager;

    // Ini baris penting untuk nomor urut
    $page = $this->request->getGet('page_hasilproduksi') ?? 1;
    $data['nomor'] = ($page - 1) * $paginate;

    return view('hasilproduksi/index', $data);
}

    public function create()
    {
        $produk = $this->product_model->findAll();
        $data['produk'] = $produk;
        return view('hasilproduksi/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();

    $id_produksi = $this->request->getPost('id_produksi');
    $tanggal = $this->request->getPost('tanggal_produksi');
    $keterangan = $this->request->getPost('keterangan');

    // Data utama hasilproduksi
    $dataProduksi = [
        'id_produksi' => $id_produksi,
        'tanggal_produksi' => $tanggal,
        'keterangan' => $keterangan
    ];

    // Ambil array data produk (multiple input)
    $produkList = $this->request->getPost('id_produk');
    $stokList = $this->request->getPost('stok_produk');
    $satuanList = $this->request->getPost('satuan');

    // Validasi bisa ditambah di sini sesuai kebutuhan

    // Simpan data utama
    $this->hasilproduksi_model->insert($dataProduksi);

    // Simpan detail produk
    $detailData = [];
    foreach ($produkList as $key => $id_produk) {
        $detailData[] = [
            'id_produksi' => $id_produksi,
            'id_produk' => $id_produk,
            'stok_produk' => $stokList[$key],
            'satuan' => $satuanList[$key]
        ];
    }

    $this->detail_model->insertBatch($detailData);

    session()->setFlashdata('success', 'Data hasil produksi berhasil disimpan.');
    return redirect()->to(base_url('hasilproduksi'));
    }

    public function show($id)
    {
        $data['produksi'] = $this->hasilproduksi_model->find($id);
        $data['detail'] = $this->detail_model->getByProduksi($id);
        return view('hasilproduksi/show', $data);
    }

    public function edit($id)
    {
        $data['produksi'] = $this->hasilproduksi_model->find($id);
        $data['detail'] = $this->detail_model->getByProduksi($id);
        $data['produk_list'] = $this->product_model->findAll();
        return view('hasilproduksi/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_produksi');

    $dataProduksi = [
        'tanggal_produksi' => $this->request->getPost('tanggal_produksi'),
        'keterangan' => $this->request->getPost('keterangan')
    ];

    $produkList = $this->request->getPost('id_produk');
    $stokList = $this->request->getPost('stok_produk');
    $satuanList = $this->request->getPost('satuan');

    // Update utama
    $this->hasilproduksi_model->update($id, $dataProduksi);

    // Hapus detail lama dan masukkan ulang
    $this->detail_model->deleteByProduksi($id);

    $detailData = [];
    foreach ($produkList as $key => $id_produk) {
        $detailData[] = [
            'id_produksi' => $id,
            'id_produk' => $id_produk,
            'stok_produk' => $stokList[$key],
            'satuan' => $satuanList[$key]
        ];
    }

    $this->detail_model->insertBatch($detailData);

    session()->setFlashdata('info', 'Data berhasil diperbarui.');
    return redirect()->to(base_url('hasilproduksi'));
    }

    public function delete($id)
    {
        $this->detail_model->deleteByProduksi($id);
        $this->hasilproduksi_model->delete($id);
        session()->setFlashdata('warning', 'Data berhasil dihapus.');
        return redirect()->to(base_url('hasilproduksi'));
    }
}
