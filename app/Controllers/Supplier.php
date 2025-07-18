<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Supplier_model;

class Supplier extends Controller
{
    protected $supplier_model;

    public function __construct()
    {
        helper(['form']);
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

        $query = $this->supplier_model;

        if (!empty($keyword)) {
            $query = $query->groupStart()
                ->like('id_supplier', $keyword)
                ->orLike('nama_supplier', $keyword)
                ->orLike('alamat', $keyword)
                ->groupEnd();
        }

        $supplier = $query->orderBy('id_supplier', 'ASC')->paginate($paginate, 'supplier');

        $data = [
            'supplier' => $supplier,
            'keyword' => $keyword,
            'pager' => $this->supplier_model->pager,
            'nomor' => ($this->request->getGet('page_supplier') ?? 1 - 1) * $paginate
        ];

        return view('supplier/index', $data);
    }

    public function create()
    {
        return view('supplier/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $data = [
            'id_supplier' => $this->request->getPost('id_supplier'),
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp')
        ];

        if (!$validation->run($data, 'supplier')) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('supplier/create'));
        }

        $this->supplier_model->insertSupplier($data);
        session()->setFlashdata('success', 'Created Supplier successfully');
        return redirect()->to(base_url('supplier'));
    }

    public function edit($id)
    {
        $data['supplier'] = $this->supplier_model->getSupplier($id)->getRowArray();
        return view('supplier/edit', $data);
    }

    public function update()
    {
        $id = $this->request->getPost('id_supplier');
        $validation = \Config\Services::validation();
        $data = [
            'id_supplier' => $id,
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('no_hp')
        ];

        if (!$validation->run($data, 'supplier_edit')) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('supplier/edit/' . $id));
        }

        $this->supplier_model->updateSupplier($data, $id);
        session()->setFlashdata('info', 'Updated Supplier');
        return redirect()->to(base_url('supplier'));
    }

    public function delete($id)
    {
        $this->supplier_model->deleteSupplier($id);
        session()->setFlashdata('warning', 'Deleted Supplier Successfully');
        return redirect()->to(base_url('supplier'));
    }
}
