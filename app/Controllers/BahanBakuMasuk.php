<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\BahanBakuMasuk_model;
use App\Models\Supplier_model;

class BahanBakuMasuk extends Controller
{
    protected $bahan_model;
    protected $supplier_model;

    public function __construct()
    {
        helper(['form']);
        $this->bahan_model = new BahanBakuMasuk_model();
        $this->supplier_model = new Supplier_model();

        if (session()->get('level') != 'Gudang') {
            header('Location: ' . base_url('/dashboard'));
            exit;
        }
        
    }

    public function index()
    {
        $paginate = 10; // jumlah per halaman
        $keyword = $this->request->getGet('keyword');
        $query = $this->bahan_model;

        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('id_bahan', $keyword)
                ->orLike('nama_bahan', $keyword)
                ->orLike('satuan', $keyword)
                ->orLike('id_supplier', $keyword)
                ->groupEnd();
        }

        $bahan_baku = $query->orderBy('id_bahan', 'ASC')->paginate($paginate, 'bahan');

        $data = [
            'bahan_baku' => $bahan_baku,
            'keyword' => $keyword,
            'pager' => $this->bahan_model->pager,
            'nomor' => ($this->request->getGet('page_bahan') ?? 1 - 1) * $paginate
        ];

        return view('bahanbakumasuk/index', $data);
    }

    public function create()
    {
        $supplierList = $this->supplier_model->findAll();

        $supplierOptions = [];
        foreach ($supplierList as $row) {
            $supplierOptions[$row['id_supplier']] = $row['nama_supplier'];
        }

        $data = [
            'supplier' => $supplierOptions,
            'inputs' => session()->getFlashdata('inputs'),
        ];

        return view('bahanbakumasuk/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $data = [
            'id_bahan' => $this->request->getPost('id_bahan'),
            'nama_bahan' => $this->request->getPost('nama_bahan'),
            'satuan' => $this->request->getPost('satuan'),
            'stok' => $this->request->getPost('stok'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
        ];

        if (!$validation->run($data, 'bahanbakumasuk')) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('bahanbakumasuk/create'));
        }

        $this->bahan_model->insertBahanBakuMasuk($data);
        session()->setFlashdata('success', 'Created Bahan Baku Masuk successfully');
        return redirect()->to(base_url('bahanbakumasuk'));
    }

    public function edit($id)
    {
        $data['bahan_baku'] = $this->bahan_model->getBahanBakuMasuk($id);

        $supplierList = $this->supplier_model->findAll();
        $supplierOptions = [];
        foreach ($supplierList as $row) {
            $supplierOptions[$row['id_supplier']] = $row['nama_supplier'];
        }

        $data['supplier'] = $supplierOptions;

        return view('bahanbakumasuk/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_bahan');
        $validation = \Config\Services::validation();
        $data = [
            'id_bahan' => $id,
            'nama_bahan' => $this->request->getPost('nama_bahan'),
            'satuan' => $this->request->getPost('satuan'),
            'stok' => $this->request->getPost('stok'),
            'id_supplier' => $this->request->getPost('id_supplier'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
        ];

        if (!$validation->run($data, 'bahanbakumasuk_edit')) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('bahanbakumasuk/edit/' . $id));
        }

        $this->bahan_model->updateBahanBakuMasuk($data, $id);
        session()->setFlashdata('info', 'Updated Bahan Baku Masuk');
        return redirect()->to(base_url('bahanbakumasuk'));
    }

    public function delete($id)
    {
        $this->bahan_model->deleteBahanBakuMasuk($id);
        session()->setFlashdata('warning', 'Deleted Bahan Baku Masuk Successfully');
        return redirect()->to(base_url('bahanbakumasuk'));
    }
}
