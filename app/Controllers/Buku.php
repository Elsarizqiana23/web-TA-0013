<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BukuModel;

class Buku extends BaseController
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
        $data['buku'] = $bukuModel->findAll();

        foreach ($data['buku'] as &$buku) {
            if (!empty($buku['gambar'])) {
                $buku['gambar'] = 'data:image/jpeg;base64,' . base64_encode($buku['gambar']);
            }
        }

        return view('admin/buku', $data);
    }
    public function gambar($id)
    {
        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($id);

        if ($buku && !empty($buku['gambar'])) {
            return $this->response
                ->setContentType('image/jpeg')
                ->setBody($buku['gambar']);
        }

        throw new \CodeIgniter\Exceptions\PageNotFoundException("Gambar tidak ditemukan.");
    }
    public function tambah()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '2') {
            return redirect()->to(base_url());
        }

        return view('admin/tambah_buku');
    }
    public function create()
    {
        // dd($this->request->getPost());
        $validationRules = [
            'judul' => 'required|min_length[3]|max_length[255]',
            'penulis' => 'required|min_length[3]|max_length[255]',
            'tahun' => 'required|numeric|exact_length[4]',
            'gambar' => 'uploaded[gambar]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
            'stok' => 'required|numeric|greater_than_equal_to[0]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $bukuModel = new BukuModel();
        $file = $this->request->getFile('gambar');

        $fileBinary = null;
        if ($file && $file->isValid()) {
            $fileBinary = file_get_contents($file->getTempName());
            // dd($fileBinary);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'penulis' => $this->request->getPost('penulis'),
            'tahun' => $this->request->getPost('tahun'),
            'gambar' => $fileBinary,
            'stok' => $this->request->getPost('stok')
        ];

        // dd($data);

        $bukuModel->save($data);

        session()->setFlashdata('success', 'Buku berhasil ditambahkan');
        return redirect()->to(base_url('petugas/buku'));
    }

    public function edit($id)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }
        if (session()->get('role') == '2') {
            return redirect()->to(base_url());
        }

        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->find($id);

        return view('admin/edit_buku', $data);
    }
    public function update($id)
    {
        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($id);

        $input = $this->request->getPost();

        $validationRules = [
            'judul' => 'permit_empty|min_length[3]|max_length[255]',
            'penulis' => 'permit_empty|min_length[3]|max_length[255]',
            'tahun' => 'permit_empty|numeric|exact_length[4]',
            'stok' => 'permit_empty|numeric|greater_than_equal_to[0]',
            'gambar' => 'permit_empty|uploaded[gambar]|max_size[gambar,2048]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [];
        foreach (['judul', 'penulis', 'tahun', 'stok'] as $field) {
            if (!empty($input[$field])) {
                $data[$field] = $input[$field];
            }
        }

        $fileGambar = $this->request->getFile('gambar');
        if ($fileGambar && $fileGambar->isValid() && !$fileGambar->hasMoved()) {
            $data['sampul'] = file_get_contents($fileGambar->getTempName());
        }

        if (!empty($data)) {
            $bukuModel->update($id, $data);
            session()->setFlashdata('success', 'Buku berhasil diupdate');
        }

        return redirect()->to(base_url('petugas/buku'));
    }
    public function delete($id)
    {
        $bukuModel = new BukuModel();
        $bukuModel->delete($id);

        session()->setFlashdata('success', 'Buku berhasil dihapus');
        return redirect()->to(base_url('petugas/buku'));
    }
}
