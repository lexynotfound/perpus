<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\RakModel;
use CodeIgniter\Config\Services;

class Kategori extends BaseController
{
    protected $db;
    protected $builder;
    protected $bukuModel;
    protected $kategoriModel;
    protected $rakModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tbl_buku');
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
        $this->rakModel = new RakModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Kategori Buku | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_kategori');
        $this->builder->select('tbl_kategori.id as kategoriid, tbl_kategori.nama_kategori, tbl_kategori.created_at, tbl_kategori.updated_at, tbl_kategori.deleted_at, MAX(tbl_buku.title) as title, tbl_buku.sampul, MAX(tbl_buku.pengarang) as pengarang, MAX(tbl_buku.penerbit) as penerbit, MAX(tbl_buku.jml) as jml, MAX(tbl_buku.isbn) as isbn, MAX(tbl_buku.thn_buku) as thn_buku');
        $this->builder->join('tbl_buku', 'tbl_buku.kategori_id = tbl_kategori.id', 'left');
        $this->builder->join('tbl_rak', 'tbl_rak.id = tbl_buku.rak_id', 'left');
        $this->builder->groupBy('tbl_kategori.id, tbl_kategori.nama_kategori, tbl_kategori.created_at, tbl_kategori.updated_at, tbl_kategori.deleted_at, tbl_buku.sampul');

        $query = $this->builder->get();
        $data['kategori'] = $query->getResult();

        return view('kategori/index', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Kategori Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'nama_kategori' => [
                    'rules' => 'required|is_unique[tbl_kategori.nama_kategori]',
                    'errors' => [
                        'required' => 'Nama Kategori harus diisi.',
                        'is_unique' => 'Nama Kategori sudah digunakan. Harap Guanakan nama kategori lain untuk dapat menambahkan data kategori baru'
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('kategori/createkt', $data);
            } else {
                // Jika data valid, simpan kategori ke dalam tabel
                $kategoriData = [
                    'nama_kategori' => $this->request->getPost('nama_kategori'),
                    'created_at' => date('Y-m-d H:i:s'), // Tambahkan nilai created_at
                    'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                ];

                $this->kategoriModel->insert($kategoriData);

                session()->setFlashdata('success', 'Data kategori baru berhasil ditambahkan.');

                return redirect()->to('kategori');
            }
        }

        return view('kategori/createkt', $data);
    }


    public function createkt()
    {
        $data = [
            'title' => 'Tambah Data Kategori | Sistem Informasi Perpustakaan',
        ];
        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        return view('kategori/createkt', $data);
    }

    public function delete($id)
    {
        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }

        $this->kategoriModel->delete($id);

        session()->setFlashdata('success', 'Data kategori berhasil dihapus.');

        return redirect()->to('kategori');
    }

    public function update($id)
    {
        $data = [
            'title' => 'Edit Kategori Buku | Sistem Informasi Perpustakaan',
        ];

        $kategori = $this->kategoriModel->find($id);

        if (!$kategori) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll($id);

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'nama_kategori' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Kategori harus diisi.',
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            // Jika data yang diinput berbeda dengan data lama
            if ($this->request->getPost('nama_kategori') !== $kategori['nama_kategori']) {
                $rules['nama_kategori']['rules'] .= '|is_unique[tbl_kategori.nama_kategori]';
                $rules['nama_kategori']['errors']['is_unique'] = 'Nama Kategori sudah digunakan. Harap gunakan nama kategori lain untuk dapat mengubah data kategori.';
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('kategori/edit', $data);
            } else {
                // Jika data valid, periksa apakah nama kategori telah diubah
                $namaKategoriBaru = $this->request->getPost('nama_kategori');
                if ($kategori['nama_kategori'] !== $namaKategoriBaru) {
                    // Jika nama kategori berubah, update kategori ke dalam tabel
                    $kategoriData = [
                        'nama_kategori' => $namaKategoriBaru,
                        'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                    ];

                    $this->kategoriModel->update($id, $kategoriData);
                    session()->setFlashdata('success', 'Data kategori ' . $kategori['nama_kategori'] . ' berhasil diubah menjadi ' . $namaKategoriBaru . '.');
                } else {
                    // Jika nama kategori tidak berubah, tidak perlu melakukan pembaruan
                    session()->setFlashdata('info', 'Tidak ada perubahan pada data kategori ' . $kategori['nama_kategori'] . '.');
                    return redirect()->to('kategori'); // Kembalikan ke halaman kategori
                }

                return redirect()->to('kategori');
            }
        }

        $data['kategori'] = $kategori;

        return view('kategori/edit', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Kategori | Sistem Informasi Perpustakaan',
        ];

        // Load model rak untuk mendapatkan data rak buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll($id);

        return view('kategori/edit', $data);
    }

}
