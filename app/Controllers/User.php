<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class User extends BaseController
{
    public function buku()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '1') {
            return redirect()->to(base_url('petugas'));
        }

        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->findAll();

        return view('user/buku', $data);
    }
    public function pinjam($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '1') {
            return redirect()->to(base_url('petugas'));
        }

        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($id);

        if ($buku['stok'] == 0) {
            // session()->setFlashdata('error', 'Stok buku habis.');
            return redirect()->to(base_url('buku'))->with('error', 'Stok buku habis.');
        }

        return view('user/pinjam', ['buku' => $buku]);
    }
    public function pinjams($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '1') {
            return redirect()->to(base_url('petugas'));
        }

        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($id);

        $peminjamanModel = new PeminjamanModel();
        $peminjamanModel->save([
            'id_peminjam' => session()->get('id'),
            'id_buku' => $id,
            'waktu_pinjam' => date('Y-m-d'),
            'waktu_kembali' => $this->request->getPost('waktu_kembali'),
            'status' => 'Masih Dipinjam',
        ]);
        $bukuModel->update($id, [
            'stok' => $buku['stok'] - 1,
        ]);

        return redirect()->to(base_url('peminjaman'));
    }
    public function peminjaman()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '1') {
            return redirect()->to(base_url('petugas'));
        }
        $id_peminjam = session()->get('id');

        $peminjamanModel = new PeminjamanModel();
        $data['peminjaman'] = $peminjamanModel->getPeminjamanWithBuku($id_peminjam);

        return view('user/history', $data);
    }
}
