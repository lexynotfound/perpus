<?php

namespace App\Controllers;

class Home extends BaseController
{
    protected $db;
    protected $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table(('users'));
        $this->builder = $this->db->table(('tbl_buku'));
      /*   $this->builder = $this->db->table(('tbl_denda'));
        $this->builder = $this->db->table(('tbl_pinjam')); */
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',
        ];


        
        // Select data dari tabel tbl_buku dan tbl_kategori
        $this->builder->select('tbl_buku.id as bukuid, tbl_buku.buku_id, tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.lampiran, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.isi, tbl_buku.jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori');
        $this->builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');
        
        // Ambil semua data buku
        $buku = $this->builder->get()->getResult();
        
        $this->builder->from('tbl_buku');
        // Tambahkan data total ke dalam array $data
        $data['buku'] = $buku;

        return view('home/index', $data);
    }

}

