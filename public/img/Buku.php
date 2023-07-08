<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use CodeIgniter\Config\Services;

use App\Models\AdminModel;

class Buku extends BaseController
{
    protected $db;
    protected $builder;
    protected $bukuModel;
    protected $kategoriModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tbl_buku');
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',
        ];

        // reset builder dan ubah ke tabel tbl_buku
        $this->builder = $this->db->table('tbl_buku');

        $this->builder->select('tbl_buku.id as bukuid, tbl_buku.buku_id, tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.lampiran, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.isi, tbl_buku.jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori');
        $this->builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');

        $query = $this->builder->get();

        $data['buku'] = $query->getResult();

        return view('buku/index', $data);

        // hitung jumlah baris yang terkait dengan buku dan simpan di variabel $total_buku
        $total_buku = $this->builder->countAllResults();

        // ambil semua data buku
        $buku = $this->builder->get()->getResult();

        // tambahkan data total ke dalam array $data
        $data['buku'] = $buku;

        return view('admin/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'judul' => [
                    'rules' => 'required|is_unique[tbl_buku.judul]',
                    'errors' => [
                        'required' => 'Judul harus diisi.',
                        'is_unique' => 'Judul sudah digunakan.'
                    ]
                ],
                'kategori_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kategori harus diisi.'
                    ]
                ],
                'sampul' => [
                    'rules' => 'max_size[sampul,20480]|is_image[sampul]|mime_in[sampul,image/png,image/jpeg,image/jpg,image/gif,image/svg+xml]',
                    'errors' => [
                        'max_size' => 'Ukuran sampul terlalu besar. Maksimal ukuran file adalah 20 MB.',
                        'is_image' => 'File yang diunggah bukan gambar.',
                        'mime_in' => 'Format gambar tidak valid. Hanya file dengan format PNG, JPEG, JPG, GIF, dan SVG yang diperbolehkan.'
                    ]
                ],
                'isbn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ISBN harus diisi.'
                    ]
                ],
                'lampiran' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Lampiran harus diisi.'
                    ]
                ],
                'penerbit' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Penerbit harus diisi.'
                    ]
                ],
                'pengarang' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Pengarang harus diisi.'
                    ]
                ],
                'thn_buku' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Tahun buku harus diisi.',
                        'numeric' => 'Tahun buku harus berupa angka.'
                    ]
                ],
                'isi' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Isi harus diisi.'
                    ]
                ],
                'jml' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah harus diisi.',
                        'numeric' => 'Jumlah harus berupa angka.'
                    ]
                ],
            ];


            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                // Mendapatkan file sampul yang diupload
                $sampulFile = $this->request->getFile('sampul');

                // Cek apakah ada file sampul yang diupload
                if ($sampulFile->isValid()) {
                    // Generate nama unik untuk file sampul
                    $sampulName = $sampulFile->getRandomName();

                    // Pindahkan file sampul ke folder penyimpanan
                    $sampulFile->move('./writable/uploads', $sampulName);
                } else {
                    // Jika sampul tidak terisi, gunakan nilai default
                    $sampulName = 'defaults.svg'; // Ganti dengan nama file default yang sesuai
                }

                // Jika data valid, simpan buku ke dalam tabel
                $this->bukuModel->save([
                    'buku_id' => null, // akan terisi otomatis
                    'id_buku' => $this->request->getPost('id_buku'),
                    'kategori_id' => $this->request->getPost('kategori_id'),
                    'rak_id' => $this->request->getPost('rak_id'),
                    'sampul' => $sampulName,
                    'isbn' => $this->request->getPost('isbn'),
                    'lampiran' => $this->request->getPost('lampiran'),
                    'title' => $this->request->getPost('judul'),
                    'penerbit' => $this->request->getPost('penerbit'),
                    'pengarang' => $this->request->getPost('pengarang'),
                    'thn_buku' => $this->request->getPost('thn_buku'),
                    'isi' => $this->request->getPost('isi'),
                    'jml' => $this->request->getPost('jml'),
                    // Isi dengan field dan nilai lainnya sesuai dengan struktur tabel
                    'created_at' => date('Y-m-d H:i:s'), // Tambahkan nilai created_at
                    'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                ]);

                session()->setFlashdata('success', 'Data buku berhasil ditambahkan.');

                return redirect()->to('buku');
            }
        }

        return view('buku/create', $data);
    }

}
