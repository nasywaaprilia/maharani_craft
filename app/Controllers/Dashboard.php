<?php namespace App\Controllers;
class Dashboard extends BaseController
{
    public function __construct()
    {
        $this->cek_login();
    }
    
    public function index()
    {
        if($this->cek_login() == FALSE){
            session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
            return redirect()->to('/auth/login');
        }
        echo view('dashboard');
    }
    
}
