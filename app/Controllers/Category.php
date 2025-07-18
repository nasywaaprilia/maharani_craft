<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Category_model;

class Category extends Controller
{
    public function index()
    {
        $model = new Category_model();
        $data['kategori'] = $model->getCategory();
        echo view('category/index', $data);
    }

    public function create()
    {
        return view('category/create');
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $data = array(
            'id_kategori'     => $this->request->getPost('id_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
        );

        if ($validation->run($data, 'category') == FALSE) {
            session()->setFlashdata('inputs', $this->request->getPost());
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('category/create'));
        } else {
            $model = new Category_model();
            $simpan = $model->insertCategory($data);
            if ($simpan) {
                session()->setFlashdata('success', 'Created Category successfully');
                return redirect()->to(base_url('category'));
            }
        }
    }
    public function edit($id)
{
    $model = new Category_model();
    $data['kategori'] = $model->getCategory($id)->getRowArray();
    echo view('category/edit', $data);
}

public function update()
{
    $id = $this->request->getPost('id_kategori');
    $validation = \Config\Services::validation();
    $data = [
        'id_kategori'     => $this->request->getPost('id_kategori'),
        'nama_kategori' => $this->request->getPost('nama_kategori')
    ];

    if ($validation->run($data, 'category_edit') == FALSE) {
        session()->setFlashdata('inputs', $this->request->getPost());
        session()->setFlashdata('errors', $validation->getErrors());
        return redirect()->to(base_url('category/edit/' . $id));
    } else {
        $model = new Category_model();
        $ubah = $model->updateCategory($data, $id);
        if ($ubah) {
            session()->setFlashdata('info', 'Updated Category');
            return redirect()->to(base_url('category'));
        }
    }
}
    public function delete($id)
    {
        $model = new Category_model();
        $hapus = $model->deleteCategory($id);
        if($hapus){
            session()->setFlashdata('warning','Deleted Category Successfully');
            return redirect()->to(base_url('category'));
        }
    }
}
