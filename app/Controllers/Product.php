<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Category_model;

class Product extends Controller
{
    protected $category_model;
    protected $product_model;
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->category_model = new Category_model();
        $this->product_model = new Product_model();
    }

    public function index()
    {
        // Mengambil input filter
        $category = $this->request->getGet('category');
        $keyword = $this->request->getGet('keyword');

        // Data awal
        $data['category'] = $category;
        $data['keyword'] = $keyword;

        // Ambil kategori aktif
        $kategori = $this->category_model->findAll();
        $data['kategori'] = ['' => 'Pilih Kategori'] + array_column($kategori, 'nama_kategori', 'id_kategori');

        // Filter kondisi
        $where = [];
        $like = [];
        $or_like = [];

        if (!empty($category)) {
            $where['produk.id_kategori'] = $category;
        }

        if (!empty($keyword)) {
            $like['produk.nama_produk'] = $keyword;
            $or_like = [
                'produk.deskripsi_produk' => $keyword
            ];
        }

        // Pagination
        $paginate = 5;
        $data['produk'] = $this->product_model->join('kategori', 'kategori.id_kategori = 
        produk.id_kategori')->where($where)->like($like)->orLike($or_like)->orderBy('produk.id_produk', 'ASC')->paginate($paginate, 'product');

        $data['pager'] = $this->product_model->pager;

        // Generate nomor urut
        $nomor = $this->request->getGet('page_product');
       if($nomor == null){
        $nomor = 1;
       }
        $data['nomor'] = ($nomor -1) * $paginate;

        // Tampilkan view dengan data
        return view('product/index', $data);
    }
    
    public function create()
{
    $kategori = $this->category_model->findAll();
    $data['kategori'] = ['' => 'Pilih Kategori'] + array_column($kategori, 'nama_kategori', 'id_kategori');
    return view('product/create', $data);
}

public function store()
{
    $validation = \Config\Services::validation();

    // get file
    $image = $this->request->getFile('gambar_produk');
    // random name file
    $name = $image->getRandomName();

    $data = array(
        'id_kategori' => $this->request->getPost('id_kategori'),
        'id_produk'   => $this->request->getPost('id_produk'),
        'nama_produk' => $this->request->getPost('nama_produk'),
        'satuan' => $this->request->getPost('satuan'),
        'harga_produk' => $this->request->getPost('harga_produk'),
        'gambar_produk' => $name,
        'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
    );

    if ($validation->run($data, 'product') == FALSE) {

        session()->setFlashdata('inputs', $this->request->getPost());
        session()->setFlashdata('errors', $validation->getErrors());
        return redirect()->to(base_url('product/create'));
    } else {
        // upload
        $image->move(ROOTPATH . 'public/uploads', $name);
        // insert
        $simpan = $this->product_model->insertProduct($data);
        if ($simpan) {
            session()->setFlashdata('success', 'Created Product successfully');
            return redirect()->to(base_url('product'));
        }
    }
}
    public function show($id)
    {
        $data['product'] = $this->product_model->getProduct($id);
        echo view('product/show', $data);
    }
    public function edit($id)
{
    $kategori = $this->category_model->findAll();
    $data['kategori'] = ['' => 'Pilih Category'] + array_column($kategori, 'nama_kategori', 'id_kategori');
    
    $data['product'] = $this->product_model->getProduct($id);
    echo view('product/edit', $data);
}


    public function update()
{
    $id = $this->request->getPost('id_produk');

    $validation = \Config\Services::validation();

    // get file
    $image = $this->request->getFile('gambar_produk');
    // random name file
    $name = $image->getRandomName();

    $data = array(
        'id_kategori' => $this->request->getPost('id_kategori'),
        'id_produk'       => $this->request->getPost('id_produk'),
        'nama_produk' => $this->request->getPost('nama_produk'),
        'satuan' => $this->request->getPost('satuan'),
        'harga_produk' => $this->request->getPost('harga_produk'),
        'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
    );

    if ($validation->run($data, 'product_edit') == FALSE) {
        session()->setFlashdata('inputs', $this->request->getPost());
        session()->setFlashdata('errors', $validation->getErrors());
        return redirect()->to(base_url('product/edit/'.$id));
    } else {
         // Ambil gambar yang diupload
        $image = $this->request->getFile('gambar_produk');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName(); // atau pakai getClientName() jika ingin nama asli
            $image->move(ROOTPATH . 'public/uploads', $newName);
            $data['gambar_produk'] = $newName; // hanya update gambar jika ada file baru
        } else {
            // Ambil gambar lama dari database jika user tidak upload baru
            $produkLama = $this->product_model->getProduct($id);
            if ($produkLama) {
                $data['gambar_produk'] = $produkLama['gambar_produk'];
            }    
    }
    $ubah = $this->product_model->updateProduct($data, $id);
    if ($ubah) {
        session()->setFlashdata('info', 'Updated Product successfully');
        return redirect()->to(base_url('product'));
    }
}
}
    public function delete($id)
    {

        $hapus = $this->product_model->deleteProduct($id);
        if($hapus)
        {
            session()->setFlashdata('warning','Deleted Product Succesfully');
            return redirect()->to(base_url('product'));
        }
    }
}
?>
