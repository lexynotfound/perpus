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

class Rak extends BaseController
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
            'title' => 'Rak Buku | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_rak');
        $this->builder->select('tbl_rak.id as rakid, tbl_rak.nama_rak, tbl_rak.created_at, tbl_rak.updated_at, tbl_rak.deleted_at, MAX(tbl_buku.title) as title, tbl_buku.sampul, MAX(tbl_buku.pengarang) as pengarang, MAX(tbl_buku.penerbit) as penerbit, MAX(tbl_buku.jml) as jml, MAX(tbl_buku.isbn) as isbn, MAX(tbl_buku.thn_buku) as thn_buku');
        $this->builder->join('tbl_buku', 'tbl_buku.rak_id = tbl_rak.id', 'left');
        $this->builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id', 'left');
        $this->builder->groupBy('tbl_rak.id, tbl_rak.nama_rak, tbl_rak.created_at, tbl_rak.updated_at, tbl_rak.deleted_at, tbl_buku.sampul');

        $query = $this->builder->get();
        $data['rak'] = $query->getResult();

        return view('rak/index', $data);
    }

    public function addrk()
    {
        $data = [
            'title' => 'Tambah Rak Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'nama_rak' => [
                    'rules' => 'required|is_unique[tbl_rak.nama_rak]',
                    'errors' => [
                        'required' => 'Nama rak harus diisi.',
                        'is_unique' => 'Nama Rak sudah digunakan. Harap Gunakan nama rak yang lain untuk penambahan rak baru'
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('rak/create', $data);
            } else {
                // Jika data valid, simpan rak buku ke dalam tabel
                $rakData = [
                    'nama_rak' => $this->request->getPost('nama_rak'),
                    'created_at' => date('Y-m-d H:i:s'), // Tambahkan nilai created_at
                    'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                ];

                $rakModel->insert($rakData); // Gunakan variabel $rakModel yang sudah didefinisikan sebelumnya

                session()->setFlashdata('success', 'Data rak buku berhasil ditambahkan.');

                return redirect()->to('rak');
            }
        }

        return view('rak/create', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Data Rak | Sistem Informasi Perpustakaan',
        ];

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        return view('rak/create', $data);
    }

    public function delete($id)
    {
        $rak = $this->rakModel->find($id);

        if (!$rak) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rak dengan ID ' . $id . ' tidak ditemukan.');
        }

        $this->rakModel->delete($id);

        session()->setFlashdata('success', 'Data rak baru berhasil dihapus.');

        return redirect()->to('rak');
    }

   /*  public function update($id)
    {
        $data = [
            'title' => 'Edit Kategori Buku | Sistem Informasi Perpustakaan',
        ];

        $rak = $this->rakModel->find($id);

        if (!$rak) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori dengan ID ' . $id . ' tidak ditemukan.');
        }

        // Load model kategori untuk mendapatkan data kategori buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll($id);

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'nama_rak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Rak harus diisi.',
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('rak/edit', $data);
            } else {
                // Jika data valid, periksa apakah nama kategori telah diubah
                $namaRakBaru = $this->request->getPost('nama_rak');
                if ($rak['nama_kategori'] !== $namaRakBaru) {
                    // Jika nama kategori berubah, update kategori ke dalam tabel
                    $rakData = [
                        'nama_kategori' => $namaRakBaru,
                        'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                    ];

                    $this->rakModel->update($id, $rakData);
                    session()->setFlashdata('success', 'Data kategori berhasil diupdate.');
                } else {
                    // Jika nama kategori tidak berubah, tidak perlu melakukan pembaruan
                    session()->setFlashdata('info', 'Tidak ada perubahan pada data kategori.');
                }

                return redirect()->to('rak');
            }
        }

        $data['rak'] = $rak;

        return view('rak/edit', $data);
    } */

    public function update($id)
    {
        $data = [
            'title' => 'Edit Kategori Buku | Sistem Informasi Perpustakaan',
        ];

        $rak = $this->rakModel->find($id);

        if (!$rak) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rak dengan ID ' . $id . ' tidak ditemukan.');
        }

        // Load model kategori untuk mendapatkan data kategori buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll($id);

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'nama_rak' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama Kategori harus diisi.',
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            // Jika data yang diinput berbeda dengan data lama
            if ($this->request->getPost('nama_rak') !== $rak['nama_rak']) {
                $rules['nama_rak']['rules'] .= '|is_unique[tbl_rak.nama_rak]';
                $rules['nama_rak']['errors']['is_unique'] = 'Nama Rak sudah digunakan. Harap gunakan nama kategori lain untuk dapat mengubah data pada rak.';
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('rak/edit', $data);
            } else {
                // Jika data valid, periksa apakah nama kategori telah diubah
                $namaRakBaru = $this->request->getPost('nama_rak');
                if ($rak['nama_rak'] !== $namaRakBaru) {
                    // Jika nama kategori berubah, update kategori ke dalam tabel
                    $rakData = [
                        'nama_rak' => $namaRakBaru,
                        'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                    ];

                    $this->rakModel->update($id, $rakData);
                    session()->setFlashdata('success', 'Data kategori ' . $rak['nama_rak'] . ' berhasil diubah menjadi ' . $namaRakBaru . '.');
                } else {
                    // Jika nama kategori tidak berubah, tidak perlu melakukan pembaruan
                    session()->setFlashdata('info', 'Tidak ada perubahan pada data kategori ' . $rak['nama_rak'] . '.');
                    return redirect()->to('rak'); // Kembalikan ke halaman kategori
                }

                return redirect()->to('rak');
            }
        }

        $data['rak'] = $rak;

        return view('rak/edit', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Ubah Data Kategori | Sistem Informasi Perpustakaan',
        ];

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll($id);

        return view('rak/edit', $data);
    }
}
