<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\LaporanModel;
use CodeIgniter\Config\Services;

class Denda extends BaseController
{

    protected $db;
    protected $builder;
    protected $laporanModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->laporanModel = new LaporanModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Denda | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_denda');
        $this->builder->select('tbl_denda.id as dendaid, tbl_denda.pinjam_id,tbl_denda.id_denda, tbl_denda.denda, tbl_denda.biaya_id, tbl_denda.status, tbl_denda.updated_at, tbl_denda.status_denda, tbl_denda.lama_waktu, tbl_denda.tgl_denda, tbl_denda.created_at, tbl_denda.deleted_at, users.nama, users.anggota, tbl_pinjam.id_pinjam, tbl_biaya_denda.harga_denda ');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_denda.pinjam_id');
        $this->builder->join('tbl_biaya_denda', 'tbl_biaya_denda.id = tbl_denda.biaya_id');
        $this->builder->join('users', 'users.id = tbl_denda.user_id');
        $this->builder->orderBy('tbl_denda.created_at', 'DESC'); // Menambahkan pengurutan data berdasarkan kolom created_at secara descending

        $query = $this->builder->get();
        $data['denda'] = $query->getResult();

        return view('denda/index', $data);
    }

}
