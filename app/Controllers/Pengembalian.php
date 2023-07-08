<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\AdminModel;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\RakModel;
use App\Models\PinjamModel;
use App\Models\PengembalianModel;
use App\Models\DendaModel;
use App\Models\BiayaDendaModel;
use Myth\Auth\Models\UserModel;

use CodeIgniter\Config\Services;

class Pengembalian extends BaseController
{

    protected $db;
    protected $builder;
    protected $bukuModel;
    protected $kategoriModel;
    protected $rakModel;
    protected $pinjamModel;
    protected $pengembalianModel;
    protected $adminModel;
    protected $biayaDendaModel;
    protected $dendaModel;
    protected $userModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->adminModel = new AdminModel();
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
        $this->rakModel = new RakModel();
        $this->pinjamModel = new PinjamModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->biayaDendaModel = new BiayaDendaModel();
        $this->dendaModel = new DendaModel();
        /*  $this->userModel = new UserModel(); */

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pengembalian Buku | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_pengembalian');
        $this->builder->select('tbl_pengembalian.id as pengembalianid, tbl_pengembalian.id_pengembalian, tbl_pengembalian.buku_id, tbl_pengembalian.user_id, tbl_pengembalian.tgl_balik, tbl_pengembalian.lama_pinjam, tbl_pengembalian.status, tbl_pengembalian.tgl_pinjam, tbl_pengembalian.created_at, tbl_pengembalian.deleted_at, tbl_pengembalian.updated_at, tbl_buku.title, tbl_buku.jml - COUNT(tbl_pinjam.id) as jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_denda.biaya_id, tbl_buku.id_buku, tbl_buku.sampul, users.nama, users.anggota, tbl_biaya_denda.harga_denda, tbl_pinjam.id_pinjam, tbl_denda.denda');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pengembalian.buku_id');
        $this->builder->join('tbl_denda', 'tbl_denda.pinjam_id = tbl_pengembalian.id', 'left');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_pengembalian.pinjam_id');
        $this->builder->join('users', 'users.id = tbl_pengembalian.user_id');
        $this->builder->join('tbl_biaya_denda', 'tbl_biaya_denda.id = tbl_denda.biaya_id', 'left');
        $this->builder->where('tbl_pengembalian.deleted_at', null);
        $this->builder->groupBy('tbl_pengembalian.id, tbl_pengembalian.id_pengembalian, tbl_pengembalian.buku_id, tbl_pengembalian.user_id, tbl_pengembalian.tgl_balik, tbl_pengembalian.lama_pinjam, tbl_pengembalian.status, tbl_pengembalian.tgl_pinjam, tbl_pengembalian.created_at, tbl_pengembalian.deleted_at, tbl_pengembalian.updated_at, tbl_buku.title, tbl_buku.jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_denda.biaya_id, tbl_buku.id_buku, tbl_buku.sampul, users.nama, users.anggota, tbl_biaya_denda.harga_denda, tbl_denda.denda, tbl_pinjam.id_pinjam');

        $query = $this->builder->get();
        $data['pengembalian'] = $query->getResult();

        return view('pengembalian/index', $data);
    }

}
