<?php

namespace App\Controllers;

use App\Models\BukuModel;
use App\Models\PinjamModel;
use App\Models\PengembalianModel;
use App\Models\RakModel;
use App\Models\KategoriModel;
use App\Models\DendaModel;
use App\Models\AdminModel;

class Home extends BaseController
{
    protected $db;
    protected $builder;
    protected $bukuModel;
    protected $pinjamModel;
    protected $pengembalianModel;
    protected $rakModel;
    protected $kategoriModel;
    protected $dendaModel;
    protected $adminModel;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        /* $this->builder = $this->db->table(('users')); */
        $this->builder = $this->db->table(('tbl_buku'));
        $this->bukuModel = new BukuModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->pinjamModel = new PinjamModel();
        $this->kategoriModel = new KategoriModel();
        $this->rakModel = new RakModel();
        $this->adminModel = new AdminModel();
        $this->dendaModel = new DendaModel();
        /*   $this->builder = $this->db->table(('tbl_denda'));
        $this->builder = $this->db->table(('tbl_pinjam')); */
    }

    public function index()
    {
        $data = [
            'title' => 'Sistem Informasi Perpustakaan',
        ];

        return view('home/index', $data);
    }

    public function searchRiwayat()
    {
        $data = [
            'title' => 'Pencarian | Sistem Informasi Perpustakaan',
        ];

        $search = $this->request->getGet('s'); // Mengambil nilai pencarian dari kolom input

        // Melakukan pencarian riwayat berdasarkan id_pinjam atau id_pengembalian
        $riwayatPinjam = [];
        $riwayatPengembalian = [];

        if ($search && is_string($search)) {
            if (preg_match('/^(PGL)-\w+$/', $search)) {
                $builder = $this->db->table('tbl_pengembalian');
                $builder->select('tbl_pengembalian.id as pengembalianid, tbl_pengembalian.id_pengembalian, tbl_pengembalian.denda_id, tbl_pengembalian.user_id, tbl_pengembalian.pinjam_id, tbl_pengembalian.status, tbl_pengembalian.buku_id, tbl_pengembalian.tgl_balik, tbl_pengembalian.lama_pinjam, tbl_pengembalian.tgl_pinjam, tbl_pengembalian.created_at, tbl_pengembalian.updated_at, tbl_pengembalian.deleted_at, tbl_buku.title,tbl_buku.id_buku,tbl_buku.sampul, tbl_denda.denda, users.nama, users.anggota, users.alamat, users.telepon, users.tgl_lahir, users.tempat_lahir, tbl_pinjam.jml_pinjam, tbl_pinjam.id_pinjam');
                $builder->join('tbl_buku', 'tbl_buku.id = tbl_pengembalian.buku_id');
                $builder->join('tbl_denda', 'tbl_denda.id = tbl_pengembalian.denda_id');
                $builder->join('users', 'users.id = tbl_pengembalian.user_id');
                $builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_pengembalian.pinjam_id');
                $builder->like('tbl_pengembalian.id_pengembalian', $search);
                $riwayatPengembalian = $builder->get()->getResult();
            } else if (preg_match('/^(MGSL)-\w+$/', $search)) {
                $builder = $this->db->table('tbl_pinjam');
                $builder->select('tbl_pinjam.id as pinjamid, tbl_pinjam.id_pinjam, tbl_pinjam.user_id, tbl_pinjam.buku_id, tbl_pinjam.status, tbl_pinjam.denda, tbl_pinjam.jml_pinjam, tbl_pinjam.tgl_pinjam, tbl_pinjam.lama_pinjam, tbl_pinjam.tgl_balik, tbl_pinjam.created_at, tbl_pinjam.updated_at, tbl_pinjam.deleted_at, tbl_buku.sampul, tbl_buku.title,tbl_buku.id_buku, tbl_denda.denda, users.nama, users.tempat_lahir, users.tgl_lahir, users.alamat, users.telepon, users.anggota,');
                $builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');
                $builder->join('tbl_denda', 'tbl_denda.pinjam_id = tbl_pinjam.id');
                $builder->join('users', 'users.id = tbl_pinjam.user_id');
                $builder->like('tbl_pinjam.id_pinjam', $search);
                $riwayatPinjam = $builder->get()->getResult();
            } else {
                // Jika format pencarian tidak sesuai, tampilkan pesan error
                $data['error'] = 'Format pencarian tidak valid';
            }
        } else {
            // Jika pencarian tidak valid, tampilkan pesan error
            $data['error'] = 'Pencarian tidak valid';
        }

        // Tambahkan data riwayat pinjam dan pengembalian ke dalam array $data
        $data['riwayatPinjam'] = $riwayatPinjam;
        $data['riwayatPengembalian'] = $riwayatPengembalian;

        return view('home/index', $data);
    }

    

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Detail Buku | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_buku');
        $this->builder->select('tbl_buku.id as bukuid, tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.jml - COUNT(tbl_pinjam.id) as jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
        $this->builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');
        $this->builder->join('tbl_rak', 'tbl_rak.id = tbl_buku.rak_id');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.buku_id = tbl_buku.id', 'left');
        $this->builder->where('tbl_buku.deleted_at', null); // Tambahkan kondisi untuk mengabaikan data yang telah dihapus
        $this->builder->where('tbl_buku.id', $id);
        $query = $this->builder->get();

        $data['buku'] = $query->getRow();

        if (empty($data['buku'])) {
            return redirect()->to('/home');
        }

        // Return the detail view with the data
        return view('home/detail', $data);
    }


    /* public function searchBuku()
    {
        $data = [
            'title' => 'Pencarian Buku | Sistem Informasi Perpustakaan',
        ];
        $search = $this->request->getGet('s'); // Mengambil nilai pencarian dari kolom input

        // Select data dari tabel tbl_buku dan tbl_kategori
        $builder = $this->db->table('tbl_buku');
        $builder->select('tbl_buku.id as bukuid ,tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');
        $builder->join('tbl_rak', 'tbl_rak.id = tbl_buku.rak_id');

        if ($search && is_string($search)) {
            $builder->groupStart()
                ->like('tbl_buku.id_buku', $search)
                ->orLike('tbl_buku.title', $search)
                ->groupEnd();
        }

        // Ambil semua data buku yang sesuai dengan pencarian
        $buku = $builder->get()->getResult();

        // Tambahkan data buku ke dalam array $data
        $data['buku'] = $buku;

        return view('home/index', $data);
    } */

    public function searchBuku()
    {
        $data = [
            'title' => 'Pencarian Buku | Sistem Informasi Perpustakaan',
        ];
        $search = $this->request->getGet('s'); // Mengambil nilai pencarian dari kolom input

        // Select data dari tabel tbl_buku dan tbl_kategori
        $builder = $this->db->table('tbl_buku');
        $builder->select('tbl_buku.id as bukuid ,tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
        $builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');
        $builder->join('tbl_rak', 'tbl_rak.id = tbl_buku.rak_id');

        if ($search && is_string($search)) {
            $builder->groupStart()
                ->like('tbl_buku.id_buku', $search)
                ->orLike('tbl_buku.title', $search)
                ->groupEnd();
        }

        // Filter data yang tidak terhapus (soft deleted)
        $builder->where('tbl_buku.deleted_at', null);

        // Ambil semua data buku yang sesuai dengan pencarian
        $buku = $builder->get()->getResult();

        // Tambahkan data buku ke dalam array $data
        $data['buku'] = $buku;

        return view('home/index', $data);
    }

}
