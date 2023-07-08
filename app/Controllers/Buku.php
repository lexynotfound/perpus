<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\RakModel;
use App\Models\LaporanBukuModel;
use CodeIgniter\Config\Services;

use App\Models\AdminModel;

class Buku extends BaseController
{
    protected $db;
    protected $builder;
    protected $bukuModel;
    protected $kategoriModel;
    protected $rakModel;
    protected $laporanBukuModel;
    

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('tbl_buku');
        $this->bukuModel = new BukuModel();
        $this->kategoriModel = new KategoriModel();
        $this->rakModel = new RakModel();
        $this->laporanBukuModel = new LaporanBukuModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_buku');
        $this->builder->select('tbl_buku.id as bukuid, tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.jml - COUNT(tbl_pinjam.id) as jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
        $this->builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');
        $this->builder->join('tbl_rak', 'tbl_rak.id = tbl_buku.rak_id');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.buku_id = tbl_buku.id', 'left');
        $this->builder->where('tbl_buku.deleted_at', null); // Tambahkan kondisi untuk mengabaikan data yang telah dihapus
        $this->builder->groupBy('tbl_buku.id');

        $query = $this->builder->get();
        $data['buku'] = $query->getResult();

        return view('buku/index', $data);
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
            return redirect()->to('/buku');
        }

        // Return the detail view with the data
        return view('buku/detail', $data);
    }

    /* public function index()
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
    } */

    /* public function create()
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
                'title' => [
                    'rules' => 'required|is_unique[tbl_buku.title]',
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
    } */

    /* public function store()
    {
        $data = [
            'title' => 'Tambah Data Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'title' => [
                    'rules' => 'required|is_unique[tbl_buku.title]',
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
                'rak_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rak harus diisi.'
                    ]
                ],
                'isbn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ISBN harus diisi.'
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
                'jml' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah harus diisi.',
                        'numeric' => 'Jumlah harus berupa angka.'
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('buku/create', $data);
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
                    'kategori_id' => $this->request->getPost('kategori_id'),
                    'rak_id' => $this->request->getPost('rak_id'),
                    'sampul' => $sampulName,
                    'id_buku' => $this->request->getPost('id_buku'),
                    'isbn' => $this->request->getPost('isbn'),
                    'title' => $this->request->getPost('title'),
                    'penerbit' => $this->request->getPost('penerbit'),
                    'pengarang' => $this->request->getPost('pengarang'),
                    'thn_buku' => $this->request->getPost('thn_buku'),
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
    } */

    public function store()
    {
        $data = [
            'title' => 'Tambah Data Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'id_buku' => [
                    'rules' => 'required|is_unique[tbl_buku.id_buku]',
                    'errors' => [
                        'required' => 'Kode Buku harus diisi.',
                        'is_unique' => 'Kode Buku sudah digunakan.'
                    ]
                ],
                'title' => [
                    'rules' => 'required|is_unique[tbl_buku.title]',
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
                'rak_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rak harus diisi.'
                    ]
                ],
                'isbn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ISBN harus diisi.'
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
                'jml' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah harus diisi.',
                        'numeric' => 'Jumlah harus berupa angka.'
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('buku/create', $data);
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
                $bukuData = new \stdClass();
                $bukuData->id_buku = $this->request->getPost('id_buku');
                $bukuData->kategori_id = $this->request->getPost('kategori_id');
                $bukuData->rak_id = $this->request->getPost('rak_id');
                $bukuData->sampul = $sampulName;
                $bukuData->isbn = $this->request->getPost('isbn');
                $bukuData->title = $this->request->getPost('title');
                $bukuData->penerbit = $this->request->getPost('penerbit');
                $bukuData->pengarang = $this->request->getPost('pengarang');
                $bukuData->thn_buku = $this->request->getPost('thn_buku');
                $bukuData->jml = $this->request->getPost('jml');
                $bukuData->tgl_masuk = date('Y-m-d H:i:s'); // Tambahkan nilai created_at
                $bukuData->updated_at = date('Y-m-d H:i:s'); // Tambahkan nilai updated_at

                // Jika ada field 'isi' yang diinput, tambahkan ke data buku
                if ($this->request->getPost('isi')) {
                    $bukuData->isi = $this->request->getPost('isi');
                }

                // Simpan buku ke dalam tabel
                $this->bukuModel->insert($bukuData);

                // Mendapatkan ID buku yang baru ditambahkan
                $bukuId = $this->bukuModel->insertID();

                // Mengambil data buku berdasarkan ID
                $bukuModel = new BukuModel();
                $buku = $bukuModel->find($bukuId);

                // Generate ID pengembalian secara unik
                $id_laporan_buku = 'LPB-' . strtoupper(bin2hex(random_bytes(5)));

                // Menambahkan data perubahan ke dalam tbl_laporan_buku
                $laporanData = [
                    'id_laporan_buku' => $id_laporan_buku,
                    'buku_id' => $bukuId,
                    'judul_laporan' => 'Penambahan Buku',
                    'jenis_laporan' => 'Penambahan Buku ' . $buku['title'],
                    'tgl_laporan' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ];

                $this->laporanBukuModel->insert($laporanData);

                session()->setFlashdata('success', 'Data buku berhasil ditambahkan.');
                return redirect()->to('buku');
            }
        }

        return view('buku/create', $data);
    }

    /* public function update($id)
    {

        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($id);

        if (!$buku) {
            // Tampilkan pesan error jika buku tidak ditemukan
            session()->setFlashdata('error', 'Buku tidak ditemukan.');
            return redirect()->to('/buku');
        }

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        // Handle non-post request
        if ($this->request->getMethod() !== 'post') {
            $data['buku'] = $buku;
            return view('buku/edit', $data);
        }

        // Validasi data yang diinput
        $rules = [
            'title' => [
                'rules' => 'required|is_unique[tbl_buku.title,id_buku,' . $id . ']',
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
            'rak_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rak harus diisi.'
                ]
            ],
            'isbn' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ISBN harus diisi dengan format 123-456-789-010'
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
            'jml' => [
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => 'Jumlah harus diisi.',
                    'numeric' => 'Jumlah harus berupa angka.'
                ]
            ],
            // ... kode validasi lainnya ...
        ];

        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;

            // Tambahkan pesan error jika terdapat kesalahan validasi
            session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

            return view('buku/edit', $data);
        }

        // Mendapatkan file sampul yang diupload
        $sampulFile = $this->request->getFile('sampul');

        // Cek apakah ada file sampul yang diupload
        if ($sampulFile->isValid()) {
            // Generate nama unik untuk file sampul
            $sampulName = $sampulFile->getRandomName();

            // Pindahkan file sampul ke folder penyimpanan
            $sampulFile->move('./writable/uploads', $sampulName);

            // Hapus file sampul lama jika buku sebelumnya memiliki sampul
            if ($buku['sampul'] !== 'defaults.svg') {
                unlink('./writable/uploads/' . $buku['sampul']);
            }
        } else {
            // Jika sampul tidak terisi, gunakan sampul lama
            $sampulName = $buku['sampul'];
        }

        // Update buku di dalam tabel
        $bukuData = [
            'kategori_id' => $this->request->getPost('kategori_id'),
            'rak_id' => $this->request->getPost('rak_id'),
            'sampul' => $sampulName,
            'isbn' => $this->request->getPost('isbn'),
            'title' => $this->request->getPost('title'),
            'penerbit' => $this->request->getPost('penerbit'),
            'pengarang' => $this->request->getPost('pengarang'),
            'thn_buku' => $this->request->getPost('thn_buku'),
            'jml' => $this->request->getPost('jml'),
            'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
        ];

        // Jika ada field 'isi' yang diinput, tambahkan ke data buku
        if ($this->request->getPost('isi')) {
            $bukuData['isi'] = $this->request->getPost('isi');
        }

        // Update buku di dalam tabel
        $this->bukuModel->update($id, $bukuData);

        // Generate ID pengembalian secara unik
        $id_laporan_buku = 'LPBU-' . strtoupper(bin2hex(random_bytes(5)));

        // Menentukan jenis perubahan
        $jenis_laporan = 'Perubahan Data Buku: ';

        if ($buku['sampul'] !== $bukuData['sampul']) {
            $jenis_laporan .= 'Ada perubahan pada sampul. ';
        }

        if ($buku['title'] !== $bukuData['title']) {
            $jenis_laporan .= 'Ada perubahan pada judul. ';
        }

        if ($buku['jml'] !== $bukuData['jml']) {
            $jenis_laporan .= 'Ada perubahan pada stok buku. ';
        }

        if ($buku['kategori_id'] !== $bukuData['kategori_id']) {
            $jenis_laporan .= 'Ada perubahan pada kategori. ';
        }

        if ($buku['rak_id'] !== $bukuData['rak_id']) {
            $jenis_laporan .= 'Ada perubahan pada rak. ';
        }

        if ($buku['id_buku'] !== $bukuData['id_buku']) {
            $jenis_laporan .= 'Ada perubahan pada kode buku. ';
        }

        if ($buku['penerbit'] !== $bukuData['penerbit']) {
            $jenis_laporan .= 'Ada perubahan pada nama penerbit. ';
        }

        if ($buku['isbn'] !== $bukuData['isbn']) {
            $jenis_laporan .= 'Ada perubahan pada ISBN. ';
        }

        if ($buku['thn_buku'] !== $bukuData['thn_buku']) {
            $jenis_laporan .= 'Ada perubahan pada tahun buku. ';
        }

        if ($buku['pengarang'] !== $bukuData['pengarang']) {
            $jenis_laporan .= 'Ada perubahan pada nama penulis. ';
        }

        // Menambahkan data perubahan ke dalam tbl_laporan_buku
        $laporanData = [
            'id_laporan_buku' => $id_laporan_buku,
            'buku_id' => $id,
            'judul_laporan' => 'Perubahan Data Buku',
            'jenis_laporan' => $jenis_laporan,
            'tgl_laporan' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan data perubahan dalam tabel laporan buku
        $this->laporanBukuModel->insert($laporanData);

        // Tampilkan pesan sukses
        session()->setFlashdata('success', 'Data buku berhasil diupdate.');

        // Redirect ke halaman daftar buku
        return redirect()->to('/buku');
    } */

    public function update($id)
    {
        $data = [
            'title' => 'Edit Data Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'id_buku' => [
                    'rules' => 'required|is_unique[tbl_buku.id_buku]',
                    'errors' => [
                        'required' => 'Kode Buku harus diisi.',
                        'is_unique' => 'Kode Buku sudah digunakan.'
                    ]
                ],
                'title' => [
                    'rules' => 'required|is_unique[tbl_buku.title]',
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
                'rak_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Rak harus diisi.'
                    ]
                ],
                'isbn' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'ISBN harus diisi.'
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
                'jml' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah harus diisi.',
                        'numeric' => 'Jumlah harus berupa angka.'
                    ]
                ],
                // ... kode validasi lainnya ...
            ];

            // Hapus aturan validasi 'is_unique' pada bidang 'title' jika tidak ada perubahan pada bidang tersebut
            $oldTitle = $this->bukuModel->find($id)['title'];
            if ($this->request->getPost('title') === $oldTitle) {
                unset($rules['title']['rules']);
            }

            // Hapus aturan validasi 'is_unique' pada bidang 'id_buku' jika tidak ada perubahan pada bidang tersebut
            $oldIdBuku = $this->bukuModel->find($id)['id_buku'];
            if ($this->request->getPost('id_buku') === $oldIdBuku) {
                unset($rules['id_buku']['rules']);
            }

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan validasi. Silakan periksa kembali data yang diinput.');

                return view('buku/edit', $data);
            } else {
                // Mendapatkan file sampul yang diupload
                $sampul = $this->request->getFile('sampul');

                // Proses upload foto (jika ada)
                if ($sampul->isValid() && !$sampul->hasMoved()) {
                    $newName = $sampul->getRandomName();
                    $sampul->move('./writable/uploads/', $newName);
                    // Hapus foto lama jika ada
                    $buku = $this->bukuModel->find($id);
                    if ($buku['sampul'] !== null && file_exists('./writable/uploads/' . $buku['sampul'])) {
                        unlink('./writable/uploads/' . $buku['sampul']);
                    }
                } else {
                    $buku = $this->bukuModel->find($id);
                    $newName = $buku['sampul'];
                }

                // Jika data valid, update buku di dalam tabel
                $bukuModel = new BukuModel();
                $buku = $bukuModel->find($id);

                $bukuData = [
                    'id_buku' => $this->request->getPost('id_buku'),
                    'rak_id' => $this->request->getPost('rak_id'),
                    'kategori_id' => $this->request->getPost('kategori_id'),
                    'rak_id' => $this->request->getPost('rak_id'),
                    'sampul' => $newName,
                    'isbn' => $this->request->getPost('isbn'),
                    'title' => $this->request->getPost('title'),
                    'penerbit' => $this->request->getPost('penerbit'),
                    'pengarang' => $this->request->getPost('pengarang'),
                    'thn_buku' => $this->request->getPost('thn_buku'),
                    'jml' => $this->request->getPost('jml'),
                    'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                ];

                // Jika ada field 'isi' yang diinput, tambahkan ke data buku
                if ($this->request->getPost('isi')) {
                    $bukuData['isi'] = $this->request->getPost('isi');
                }

                // Update buku di dalam tabel
                $bukuModel->update($id, $bukuData);

                // Mengambil data buku yang baru diupdate
                $buku = $bukuModel->find($id);

                // Generate ID pengembalian secara unik
                $id_laporan_buku = 'LPBU-' . strtoupper(bin2hex(random_bytes(5)));

                // Menambahkan data perubahan ke dalam tbl_laporan_buku
                $laporanData = [
                    'id_laporan_buku' => $id_laporan_buku,
                    'buku_id' => $id,
                    'judul_laporan' => 'Pembaruan Data Buku',
                    'jenis_laporan' => 'Data buku dengan judul "' . $buku['title'] . '" telah diperbarui.',
                    'tgl_laporan' => date('Y-m-d'),
                    'updated_at' => date('Y-m-d H-i-s')
                ];

                $laporanModel = new LaporanBukuModel();
                $laporanModel->insert($laporanData);

                // Tampilkan pesan sukses
                session()->setFlashdata('success', 'Data buku berhasil diperbarui.');

                return redirect()->to('/buku');
            }
        } else {
            // Jika bukan metode POST, tampilkan halaman edit dengan data buku yang akan diupdate
            $bukuModel = new BukuModel();
            $data['buku'] = $bukuModel->find($id);

            return view('buku/edit', $data);
        }
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Data Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model kategori untuk mendapatkan data kategori buku
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Load model rak untuk mendapatkan data rak buku
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        return view('buku/create', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Tambah Data Buku | Sistem Informasi Perpustakaan',
        ];
        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->find($id);
        // Load model kategori to get category data
        $kategoriModel = new KategoriModel();
        $data['kategori'] = $kategoriModel->findAll();

        // Load model rak to get shelf data
        $rakModel = new RakModel();
        $data['rak'] = $rakModel->findAll();

        $this->builder = $this->db->table('tbl_buku');
        $this->builder->select('tbl_buku.id as bukuid, tbl_buku.id_buku, tbl_buku.kategori_id, tbl_buku.rak_id, tbl_buku.sampul, tbl_buku.isbn, tbl_buku.title, tbl_buku.penerbit, tbl_buku.pengarang, tbl_buku.thn_buku, tbl_buku.jml - COUNT(tbl_pinjam.id) as jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_kategori.nama_kategori, tbl_rak.nama_rak');
        $this->builder->join('tbl_kategori', 'tbl_kategori.id = tbl_buku.kategori_id');
        $this->builder->join('tbl_rak', 'tbl_rak.id = tbl_buku.rak_id');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.buku_id = tbl_buku.id', 'left');
        $this->builder->where('tbl_buku.deleted_at', null); // Add condition to ignore deleted data
        $this->builder->groupBy('tbl_buku.id');
        $this->builder->where('tbl_buku.id', $id);
        $query = $this->builder->get();

        $data['buku'] = $query->getRow();

        if (empty($data['buku'])) {
            return redirect()->to('/buku');
        }


        return view('buku/edit', $data);
    }


    /*  public function delete($id)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan ID ' . $id . ' tidak ditemukan.');
        }

        $this->bukuModel->delete($id);

        session()->setFlashdata('success', 'Data buku berhasil dihapus.');

        return redirect()->to('buku');
    } */

    public function delete($id)
    {
        $buku = $this->bukuModel->find($id);

        if (!$buku) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Buku dengan ID ' . $id . ' tidak ditemukan.');
        }

        $this->db->transStart();

        try {
            // Mengambil data buku sebelum dihapus
            $bukuData = $this->bukuModel->find($id);

            // Generate ID laporan buku secara unik
            $id_laporan_buku = 'LPBD-' . strtoupper(bin2hex(random_bytes(5)));

            // Menambahkan data perubahan ke dalam tbl_laporan_buku
            $laporanData = [
                'id_laporan_buku' => $id_laporan_buku,
                'buku_id' => $bukuData['id'],
                'judul_laporan' => 'Penghapusan Buku',
                'jenis_laporan' => 'Penghapusan Buku: ' . $bukuData['title'],
                'tgl_laporan' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            // Menghapus buku dan menambahkan data laporan dalam satu transaksi
            $this->db->transStart();
            $this->bukuModel->delete($id);
            $this->laporanBukuModel->insert($laporanData);
            $this->db->transCommit();

            session()->setFlashdata('success', 'Data buku berhasil dihapus.');
        } catch (\Exception $e) {
            $this->db->transRollback();
            session()->setFlashdata('error', 'Gagal menghapus data buku.');
        }

        $this->db->transComplete();

        return redirect()->to('buku');
    }
}
