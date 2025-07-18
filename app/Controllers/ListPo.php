<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Listpo_model;
use App\Models\Product_model;

class Listpo extends Controller
{
    protected $listpo_model;
    protected $product_model;

    public function __construct()
    {
        helper(['form']);
        $this->listpo_model = new Listpo_model();
        $this->product_model = new Product_model();

        if (session()->get('level') != 'Penjualan') {
            header('Location: ' . base_url('/dashboard'));
            exit;
        }
        
    }

    public function index()
    {
        $paginate = 10;
        $keyword = $this->request->getGet('keyword');

        $query = $this->listpo_model
        ->select('listpo.*, produk.nama_produk')
        ->join('produk', 'listpo.id_produk = produk.id_produk', 'left');

        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('id_po', $keyword)
                ->orLike('nama_customer', $keyword)
                ->groupEnd();
        }

        $listpo = $query->orderBy('id_po', 'ASC')->paginate($paginate, 'listpo');

        $data = [
            'listpo' => $listpo,
            'keyword' => $keyword,
            'pager' => $this->listpo_model->pager,
            'nomor' => ($this->request->getGet('page_listpo') ?? 1 - 1) * $paginate
        ];

        return view('listpo/index', $data);
    }

    public function create()
    {
        $produkAktif = $this->product_model->findAll();
        $data['produk'] = ['' => 'Pilih Produk'] + array_column($produkAktif, 'nama_produk', 'id_produk');

        return view('listpo/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $data = [
            'id_po' => $this->request->getPost('id_po'),
            'id_produk' => $this->request->getPost('id_produk'),
            'nama_customer' => $this->request->getPost('nama_customer'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => $this->request->getPost('tanggal'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];

        if (!$validation->run($data, 'listpo')) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('listpo/create'));
        }

        $this->listpo_model->insert($data);
        session()->setFlashdata('success', 'List PO berhasil disimpan');
        return redirect()->to(base_url('listpo'));
    }

    public function edit($id)
    {
        $produkAktif = $this->product_model->findAll();
        $data['produk'] = ['' => 'Pilih Produk'] + array_column($produkAktif, 'nama_produk', 'id_produk');

        $data['listpo'] = $this->listpo_model->find($id);
        return view('listpo/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_po');
        $validation = \Config\Services::validation();
        $data = [
            'id_po' => $id,
            'id_produk' => $this->request->getPost('id_produk'),
            'nama_customer' => $this->request->getPost('nama_customer'),
            'jumlah' => $this->request->getPost('jumlah'),
            'tanggal' => $this->request->getPost('tanggal'),
            'no_hp' => $this->request->getPost('no_hp'),
        ];

        if (!$validation->run($data, 'listpo_edit')) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('listpo/edit/' . $id));
        }

        $this->listpo_model->update($id, $data);
        session()->setFlashdata('info', 'List PO berhasil diupdate');
        return redirect()->to(base_url('listpo'));
    }

    public function delete($id)
    {
        $this->listpo_model->delete($id);
        session()->setFlashdata('warning', 'List PO berhasil dihapus');
        return redirect()->to(base_url('listpo'));
    }
}
