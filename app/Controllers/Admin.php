<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;
use App\Models\UserModel;
use App\Models\PeminjamanModel;

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        if (session()->get('role') == '2') {
            return redirect()->to(base_url());
        }
        $bukuModel = new BukuModel();
        $userModel = new UserModel();
        $peminjamanModel = new PeminjamanModel();
        $totalBuku = $bukuModel->countAllResults();
        $totalUser = $userModel->countAllResults();
        $totalPeminjaman = $peminjamanModel->countAllResults();

        return view('admin/index', [
            'totalBuku' => $totalBuku,
            'totalUser' => $totalUser,
            'totalPeminjaman' => $totalPeminjaman
        ]);
    }
    public function user()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $users = $userModel->findAll();

        return view('admin/user', [
            'users' => $users
        ]);
    }
    public function editUser($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        return view('admin/edit_user', [
            'user' => $user
        ]);
    }
    public function updateUser($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $user = $userModel->find($id);

        $rules = [
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi',
                    'min_length' => 'Nama minimal 3 karakter',
                ],
            ],
        ];

        if ($this->request->getPost('username') !== $user['username']) {
            $rules['username'] = [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah terdaftar, silahkan pakai username lain',
                ],
            ];
        }

        if (!empty($this->request->getPost('password'))) {
            $rules['password'] = [
                'rules' => 'min_length[5]|max_length[200]',
                'errors' => [
                    'min_length' => 'Password minimal 5 karakter',
                ],
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->to('petugas/user')->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'role' => $this->request->getPost('role'),
        ];

        if ($this->request->getPost('username') !== $user['username']) {
            $data['username'] = $this->request->getPost('username');
        }

        if (!empty($this->request->getPost('password'))) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        $userModel->update($id, $data);

        return redirect()->to(base_url('petugas/user'))->with('success', 'User berhasil diupdate');
    }
    public function tambahUser()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        return view('admin/tambah_user');
    }

    public function createUser()
    {
        $rules = [
            'nama' => [
                'rules' => 'required|min_length[3]|max_length[50]',
                'errors' => [
                    'required' => 'Nama wajib diisi',
                    'min_length' => 'Nama minimal 3 karakter',
                ],
            ],
            'password' => [
                'rules' => 'required|min_length[5]|max_length[200]',
                'errors' => [
                    'required' => 'Password wajib diisi',
                    'min_length' => 'Password minimal 5 karakter',
                ],
            ],
            'username' => [
                'rules' => 'required|is_unique[user.username]',
                'errors' => [
                    'required' => 'Username wajib diisi',
                    'is_unique' => 'Username sudah terdaftar, silahkan pakai username lain',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('petugas/user')->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ];
        // dd($data);
        $model->save($data);

        return redirect()->to(base_url('petugas/user'))->with('success', 'User berhasil ditambahkan');
    }

    public function deleteUser($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userModel = new UserModel();
        $userModel->delete($id);

        return redirect()->to(base_url('petugas/user'))->with('success', 'User berhasil dihapus');
    }

    public function peminjaman()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $peminjamanModel = new PeminjamanModel();
        $peminjaman = $peminjamanModel->getPeminjaman();

        return view('admin/peminjaman', [
            'data' => $peminjaman
        ]);
    }
    public function kembali($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $peminjamanModel = new PeminjamanModel();
        $peminjaman = $peminjamanModel->find($id);

        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($peminjaman['id_buku']);

        $peminjamanModel->update($id, [
            'waktu_kembali' => date('Y-m-d'),
            'status' => 'Sudah Dikembalikan',
        ]);

        $bukuModel->update($peminjaman['id_buku'], [
            'stok' => $buku['stok'] + 1,
        ]);

        return redirect()->to(base_url('petugas/peminjaman'))->with('success', 'Buku berhasil dikembalikan');
    }

}
