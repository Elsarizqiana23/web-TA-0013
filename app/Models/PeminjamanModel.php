<?php

namespace App\Models;

use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['id_peminjam', 'id_buku', 'waktu_pinjam', 'waktu_kembali', 'status'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getPeminjamanWithBuku($id_peminjam)
    {
        return $this->select('peminjaman.*, buku.judul, buku.penulis, buku.tahun')
            ->join('buku', 'buku.id = peminjaman.id_buku')
            ->where('peminjaman.id_peminjam', $id_peminjam)
            ->findAll();
    }
    public function getPeminjaman()
    {
        return $this->select('peminjaman.*, buku.judul, buku.penulis, buku.tahun, user.nama')
            ->join('buku', 'buku.id = peminjaman.id_buku')
            ->join('user', 'user.id = peminjaman.id_peminjam')
            ->findAll();
    }

}
