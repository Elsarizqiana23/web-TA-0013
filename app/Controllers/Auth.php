<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }
    public function registrasi()
    {
        return view('auth/registrasi');
    }
    public function signin()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $pass = $this->request->getPost('password');
        $user = $model->where('username', $username)->first();
        if ($user) {
            if (password_verify($pass, $user['password'])) {
                session()->set([
                    'isLoggedIn' => true,
                    'id' => $user['id'],
                    'nama' => $user['nama'],
                    'username' => $user['username'],
                    'role' => $user['role']
                ]);

                // dd(session()->get());
                if ($user['role'] === '1') {
                    return redirect()->to(base_url('/petugas'));
                } else if ($user['role'] === '2') {
                    return redirect()->to(base_url());
                }
            } else {
                session()->setFlashdata('error', 'Password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Username salah.');
            return redirect()->back()->withInput();
        }
    }
    public function register()
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
            return redirect()->to('registrasi')->with('errors', $this->validator->getErrors());
        }

        $model = new UserModel();
        $data = [
            'username' => $this->request->getPost('username'),
            'nama' => $this->request->getPost('nama'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => $this->request->getPost('role'),
        ];
        $model->save($data);

        return redirect()->to(base_url('login'))->with('pesan', 'Berhasil registrasi. Silahkan login');


    }
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url());
    }

}
