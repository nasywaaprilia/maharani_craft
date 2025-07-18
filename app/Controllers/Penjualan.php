<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Penjualan_model;
use App\Models\Product_model;
use App\Models\DetailPenjualan_model;

class Penjualan extends Controller
{
    protected $penjualan_model;
    protected $product_model;
    protected $detail_model;

    public function __construct()
    {
        helper(['form']);
        $this->penjualan_model = new Penjualan_model();
        $this->product_model = new Product_model();
        $this->detail_model = new DetailPenjualan_model(); 

        if (session()->get('level') != 'Penjualan') {
            header('Location: ' . base_url('/dashboard'));
            exit;
        }
        
    }

    public function index()
    {
        $paginate = 5;
        $query = $this->penjualan_model;

        $keyword = $this->request->getGet('keyword');
        $produk = $this->request->getGet('produk');

        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('id_penjualan', $keyword)
                ->orLike('tanggal', $keyword)
                ->groupEnd();
        }

        if (!empty($produk)) {
            $query = $query->join('detail_penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan')
                           ->where('detail_penjualan.id_produk', $produk);
        }

        $penjualan = $query->orderBy('penjualan.id_penjualan', 'ASC')
                           ->paginate($paginate, 'penjualan');

        $ids = array_column($penjualan, 'id_penjualan');

        $detailPenjualan = [];
        if (!empty($ids)) {
            $detailPenjualan = $this->detail_model
                ->whereIn('id_penjualan', $ids)
                ->join('produk', 'produk.id_produk = detail_penjualan.id_produk')
                ->findAll();
        }

        $data['keyword'] = $this->request->getGet('keyword') ?? '';
        $data['produk'] = $this->request->getGet('produk') ?? '';
        $produkList = $this->product_model->select('id_produk, nama_produk')->findAll();
        $data['produk_list'] = ['' => 'Pilih Produk'] + array_column($produkList, 'nama_produk', 'id_produk');

        $data['penjualan'] = $penjualan;
        $data['detail_penjualan'] = $detailPenjualan;
        $data['pager'] = $this->penjualan_model->pager;

        $page = $this->request->getGet('page_penjualan') ?? 1;
        $data['nomor'] = ($page - 1) * $paginate;

        return view('penjualan/index', $data);
    }

    public function create()
    {
        $produk = $this->product_model->findAll();
        $data['produk'] = $produk;
        return view('penjualan/create', $data);
    }

    public function store()
    {
        $id_penjualan = $this->request->getPost('id_penjualan');
        $tanggal = $this->request->getPost('tanggal');

        $dataPenjualan = [
            'id_penjualan' => $id_penjualan,
            'tanggal' => $tanggal
        ];

        $produkList = $this->request->getPost('id_produk');
        $jumlahList = $this->request->getPost('jumlah');
        $satuanList = $this->request->getPost('satuan');

        $this->penjualan_model->insert($dataPenjualan);

        $detailData = [];
        foreach ($produkList as $key => $id_produk) {
            $detailData[] = [
                'id_penjualan' => $id_penjualan,
                'id_produk' => $id_produk,
                'jumlah' => $jumlahList[$key],
                'satuan' => $satuanList[$key]
            ];
        }
        $this->detail_model->insertBatch($detailData);

        session()->setFlashdata('success', 'Data penjualan berhasil disimpan.');
        return redirect()->to(base_url('penjualan'));
    }

    public function show($id)
    {
        $data['penjualan'] = $this->penjualan_model->find($id);
        $data['detail'] = $this->detail_model->getByPenjualan($id);
        return view('penjualan/show', $data);
    }

    public function edit($id)
    {
        $data['penjualan'] = $this->penjualan_model->find($id);
        $data['detail'] = $this->detail_model->getByPenjualan($id);
        $data['produk_list'] = $this->product_model->findAll();
        return view('penjualan/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_penjualan');

        $dataPenjualan = [
            'tanggal' => $this->request->getPost('tanggal')
        ];

        $produkList = $this->request->getPost('id_produk');
        $jumlahList = $this->request->getPost('jumlah');
        $satuanList = $this->request->getPost('satuan');

        $this->penjualan_model->update($id, $dataPenjualan);
        $this->detail_model->deleteByPenjualan($id);

        $detailData = [];
        foreach ($produkList as $key => $id_produk) {
            $detailData[] = [
                'id_penjualan' => $id,
                'id_produk' => $id_produk,
                'jumlah' => $jumlahList[$key],
                'satuan' => $satuanList[$key]
            ];
        }

        $this->detail_model->insertBatch($detailData);

        session()->setFlashdata('info', 'Data penjualan berhasil diperbarui.');
        return redirect()->to(base_url('penjualan'));
    }

    public function delete($id)
    {
        $this->detail_model->deleteByPenjualan($id);
        $this->penjualan_model->delete($id);
        session()->setFlashdata('warning', 'Data berhasil dihapus.');
        return redirect()->to(base_url('penjualan'));
    }
}
