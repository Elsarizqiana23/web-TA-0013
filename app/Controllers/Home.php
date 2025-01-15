<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PeminjamanModel;
use App\Models\BukuModel;

class Home extends BaseController
{
    protected $peminjamanModel;
    protected $userModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->peminjamanModel = new PeminjamanModel();
        $this->bukuModel = new BukuModel();
    }
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '1') {
            return redirect()->to(base_url('petugas'));
        }

        $id_peminjam = session()->get('id');

        return view('user/index', [
            'nama' => session()->get('nama'),
            'totalBuku' => $this->bukuModel->countAllResults(),
            'totalPeminjaman' => count($this->peminjamanModel->getPeminjamanWithBuku($id_peminjam)),
        ]);
    }
}
