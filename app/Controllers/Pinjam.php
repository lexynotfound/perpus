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
use App\Models\LaporanModel;
use App\Models\LaporanDendaModel;
use App\Models\LaporanPengembalianModel;
use App\Models\BiayaDendaModel;
use Myth\Auth\Models\UserModel;

use CodeIgniter\Config\Services;

class Pinjam extends BaseController
{

    protected $db;
    protected $builder;
    protected $bukuModel;
    protected $kategoriModel;
    protected $rakModel;
    protected $pinjamModel;
    protected $pengembalianModel;
    protected $adminModel;
    protected $dendaModel;
    protected $userModel;
    protected $laporanModel;
    protected $laporanDendaModel;
    protected $laporanPengembalianModel;

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
        $this->dendaModel = new DendaModel();
        $this->laporanModel = new LaporanModel();
        $this->laporanDendaModel = new LaporanDendaModel();
        $this->laporanPengembalianModel = new LaporanPengembalianModel();
        /*  $this->userModel = new UserModel(); */

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Peminjaman Buku | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_pinjam');
        $this->builder->select('tbl_pinjam.id as pinjamid, tbl_pinjam.id_pinjam, tbl_pinjam.buku_id, tbl_pinjam.user_id, tbl_pinjam.tgl_balik, tbl_pinjam.lama_pinjam, tbl_pinjam.status, tbl_pinjam.tgl_pinjam, tbl_pinjam.harga_id, tbl_pinjam.tgl_balik, tbl_pinjam.created_at, tbl_pinjam.deleted_at, tbl_pinjam.updated_at, tbl_buku.title, tbl_buku.jml - COUNT(tbl_pinjam.id) as jml, tbl_buku.tgl_masuk, tbl_buku.updated_at, tbl_buku.deleted_at, tbl_denda.biaya_id, tbl_buku.id_buku, tbl_buku.sampul, users.nama, users.anggota, tbl_biaya_denda.harga_denda');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');
        $this->builder->join('tbl_denda', 'tbl_denda.pinjam_id = tbl_pinjam.id');
        $this->builder->join('users', 'users.id = tbl_pinjam.user_id');
        $this->builder->join('tbl_biaya_denda', 'tbl_biaya_denda.id = tbl_denda.biaya_id');
        $this->builder->where('tbl_pinjam.deleted_at', null);
        $this->builder->groupBy('tbl_pinjam.id, tbl_buku.id, users.id, tbl_denda.biaya_id, tbl_biaya_denda.harga_denda'); // Menambahkan semua kolom non-agregat ke GROUP BY

        $query = $this->builder->get();
        $data['pinjam'] = $query->getResult();

        return view('pinjam/index', $data);
    }

    public function pinjamBuku()
    {
        $data = [
            'title' => 'Pinjam Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model denda untuk mendapatkan data denda
        $dendaModel = new DendaModel();
        $data['denda'] = $dendaModel->findAll();

        // Load model admin untuk mendapatkan data users
        $adminModel = new AdminModel();
        $data['users'] = $adminModel->findAll();

        // Load model admin untuk mendapatkan data users
        $laporanModel = new LaporanModel();
        $data['laporan'] = $laporanModel->findAll();

        // Load model admin untuk mendapatkan data users
        $laporanDendaModel = new LaporanDendaModel();
        $data['laporandenda'] = $laporanDendaModel->findAll();

        // Load model buku untuk mendapatkan data buku
        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->findAll();

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'user_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nomor Anggota harus diisi.'
                    ]
                ],
                'buku_id' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode Buku harus diisi.'
                    ]
                ],
                //aktifkan ini unutk buku bisa di pinjam lebih dari apapun
                /* 'jml_pinjam' => [
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => 'Jumlah Buku harus diisi.',
                        'numeric' => 'Jumlah Buku harus berupa angka.',
                    ]
                ], */
                'jml_pinjam' => [
                    'rules' => 'required|numeric|less_than_equal_to[1]',
                    'errors' => [
                        'required' => 'Jumlah Buku harus diisi.',
                        'numeric' => 'Jumlah Buku harus berupa angka.',
                        'less_than_equal_to' => 'Jumlah Buku tidak boleh lebih dari 1.'
                    ]
                ],
                'lama_pinjam' => [
                    'rules' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[30]',
                    'errors' => [
                        'required' => 'Lama Pinjam harus diisi.',
                        'numeric' => 'Lama Pinjam harus berupa angka.',
                        'greater_than_equal_to' => 'Lama Pinjam harus minimal 1 hari.',
                        'less_than_equal_to' => 'Lama Pinjam tidak boleh lebih dari 30 hari.'
                    ]
                ],
            ];

            //dan pakai validasi ini jika inign jml_pinjam bisa di pinjam lebih dari apapun
            /* if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan dalam penginputan. Silakan periksa kembali data yang diinput.');

                return view('pinjam/pinjam_views', $data); */
            // ini unutk menampilkan pesan error jika ingin menghapus validasi ini hapus aja
            //dan hapus kode di bawah ini agar bisa menjalankan buku bisa di pinjam lebih dari apapun
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Check for specific validation errors and set custom error messages
                if ($this->validator->hasError('jml_pinjam', 'less_than_equal_to')) {
                    session()->setFlashdata('error', 'Jumlah Buku tidak boleh lebih dari 1.');
                } elseif ($this->validator->hasError('jml_pinjam', 'less_than_equal_to')) {
                    session()->setFlashdata('error', 'Jumlah Buku harus berupa angka.');
                } else {
                    session()->setFlashdata('error', 'Terdapat kesalahan dalam penginputan. Silakan periksa kembali data yang diinput.');
                }

                return view('pinjam/pinjam_views', $data);
            } else {
                // Jika data valid, cek apakah anggota telah mencapai batas peminjaman
                $pinjamModel = new PinjamModel();
                $user_id = $this->request->getPost('user_id');
                $maxPeminjaman = 2; // Batas maksimum peminjaman

                // Cek apakah data anggota tersedia dalam tabel users
                $user = $adminModel->where('email', $user_id)->orWhere('anggota', $user_id)->first();

                if (!$user) {
                    // Jika data anggota tidak ditemukan, tampilkan pesan error
                    session()->setFlashdata('error', 'Data anggota tidak ditemukan.');

                    // Berikan opsi untuk membuat data anggota baru
                    session()->setFlashdata('admin/tambahUserView', true);

                    return redirect()->back();
                }

                // Hitung jumlah peminjaman anggota yang belum dikembalikan
                $countPeminjaman = $pinjamModel->where('user_id', $user->id)->where('status !=', 'Dikembalikan')->countAllResults();

                if ($countPeminjaman >= $maxPeminjaman) {
                    // Jika anggota telah mencapai batas peminjaman, tampilkan pesan error
                    session()->setFlashdata('error', 'Anda telah mencapai batas maksimum peminjaman buku.');

                    return redirect()->back();
                } else {
                    // Lanjutkan proses peminjaman buku
                    $id_pinjam = 'MGSL-' . strtoupper(bin2hex(random_bytes(5)));

                    // Periksa apakah buku tersedia dalam tabel buku
                    $buku_id = $this->request->getPost('buku_id');
                    $bukuData = $bukuModel->find($buku_id);

                    if (!$bukuData) {
                        // Jika buku tidak ditemukan, tampilkan pesan error
                        session()->setFlashdata('error', 'Buku tidak ditemukan.');

                        return redirect()->back();
                    }

                    // Periksa apakah buku telah dipinjam sebelumnya dan belum dikembalikan
                    $existingPeminjaman = $pinjamModel->where('user_id', $user->id)
                        ->where('buku_id', $buku_id)
                        ->where('status !=', 'Dikembalikan')
                        ->countAllResults();

                    if ($existingPeminjaman > 0) {
                        // Jika buku telah dipinjam sebelumnya dan belum dikembalikan, tampilkan pesan error
                        session()->setFlashdata('error', 'Anda telah meminjam buku ini sebelumnya dan belum mengembalikannya.');

                        return redirect()->back();
                    }

                    // Periksa apakah jumlah buku yang tersedia mencukupi
                    $jml_pinjam = $this->request->getPost('jml_pinjam');
                    $jml_tersedia = $bukuData['jml'] ?? 0;

                    if ($jml_pinjam > $jml_tersedia) {
                        // Jika jumlah buku tidak mencukupi, tampilkan pesan error
                        session()->setFlashdata('error', 'Jumlah buku yang tersedia tidak mencukupi.');

                        return redirect()->back();
                    }

                    // Data peminjaman buku
                    $pinjamData = [
                        'id_pinjam' => $id_pinjam,
                        'user_id' => $user->id,
                        'buku_id' => $buku_id,
                        'jml_pinjam' => $jml_pinjam,
                        'status' => 'Sedang Di Pinjam',
                        'lama_pinjam' => $this->request->getPost('lama_pinjam'),
                        'tgl_pinjam' => date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    // Kurangi jumlah buku yang dipinjam dari tabel buku
                    $bukuModel->update($buku_id, ['jml' => $jml_tersedia - $jml_pinjam]);

                    // Hitung lama pinjam
                    $tgl_pinjam = strtotime($pinjamData['tgl_pinjam']);
                    $lama_pinjam = $this->request->getPost('lama_pinjam');
                    $tgl_balik = date('Y-m-d', strtotime("+$lama_pinjam days", $tgl_pinjam));

                    // Hitung total denda berdasarkan harga denda dan lama pinjam
                    $harga_denda = 4000; // Harga denda default
                    $totalDenda = 0; // Total denda awal
                    $dendaData = [
                        'pinjam_id' => $pinjamData['id_pinjam'], // Ubah ke kolom yang benar di tabel 'tbl_denda'
                        'user_id' => $pinjamData['user_id'],
                        'biaya_id' => '1',
                        'denda' => 'Anda Dikenakan Denda Sebesar ' . $totalDenda,
                        'status_denda' => 'Tidak Ada Denda',
                        'status' => 'Belum Dikembalikan',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    if (strtotime($tgl_balik) < strtotime(date('Y-m-d'))) {
                        // Menghitung denda jika melewati lama_pinjam dan buku belum dikembalikan
                        $lama_lewat = (strtotime(date('Y-m-d')) - strtotime($tgl_balik)) / (60 * 60 * 24);
                        $totalDenda = $harga_denda * $lama_lewat;
                        $dendaData['denda'] = 'Anda Didenda Sebesar ' . $totalDenda;
                    } else {
                        // Tidak ada denda jika belum melebihi lama_pinjam
                        $dendaData['denda'] = 'Tidak Ada Denda';
                    }

                    // Tambahkan total denda ke dalam data peminjaman
                    $pinjamData['tgl_balik'] = $tgl_balik;
                    $pinjamData['total_denda'] = $totalDenda;

                    // Simpan data peminjaman ke dalam tabel tbl_pinjam
                    $pinjamModel->insert($pinjamData);

                    // Dapatkan ID peminjaman yang baru saja disimpan
                    $id_pinjam = $pinjamModel->insertID();

                    $id_denda = 'DND-' . strtoupper(bin2hex(random_bytes(5)));

                    // Simpan data denda ke dalam tabel tbl_denda
                    $dendaData = [
                        'id_denda' => $id_denda,
                        'pinjam_id' => $id_pinjam, // Gunakan ID peminjaman yang baru saja disimpan
                        'user_id' => $pinjamData['user_id'],
                        'biaya_id' => '1',
                        'denda' => 'Anda Dikenakan Denda Sebesar ' . $totalDenda,
                        'status_denda' => $totalDenda > 0 ? 'Denda Belum Dibayar' : 'Tidak Ada Denda',
                        'status' => 'Belum Dikembalikan',
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    ];

                    $dendaModel->insert($dendaData);

                    // Dapatkan nilai id_denda yang baru saja disimpan
                    $newDendaId = $dendaModel->getInsertID();

                    // Tampilkan pesan sukses
                    session()->setFlashdata('success', 'Buku berhasil dipinjam.');

                    // Simpan data laporan
                    $adminModel = new AdminModel();
                    $user = $adminModel->find($pinjamData['user_id']);
                    
                    // Generate ID pengembalian secara unik
                    $id_laporan_peminjaman = 'LPPJ-' . strtoupper(bin2hex(random_bytes(6)));
                    
                    /* laporanData ini berfungsi untuk melakuka  penyimpanan data yang di ambil ketika sedang melakukan peminjaman */
                    $laporanData = [
                        'id_laporan_peminjaman' => $id_laporan_peminjaman,
                        'judul_laporan' => 'Laporan Peminjaman',
                        'jenis_laporan' => $user->nama . ' (' . $user->anggota . ') Telah Meminjam Buku',
                        'pinjam_id' => $id_pinjam, // Gunakan ID peminjaman yang baru saja disimpan
                        'buku_id' => $pinjamData['buku_id'],
                        /* 'pengembalian_id' => null, */
                        'tgl_laporan' => date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'deleted_at' => null,
                    ];
                    $laporanModel->insert($laporanData);

                    $dendaModel = new DendaModel();
                    $denda = $dendaModel->find($newDendaId);


                    $id_laporan_denda = 'LPDN-' . strtoupper(bin2hex(random_bytes(6)));

                    $LaporanDendaData = [
                        'id_laporan_denda' => $id_laporan_denda,
                        'denda_id' => $newDendaId, // Gunakan ID peminjaman yang baru saja disimpan
                        'judul_laporan' => 'Laporan Denda Peminjaman',
                        'jenis_laporan' => $user->nama . ' (' . $user->anggota . ') Telah Dikenakan Denda Sebesar ' . $denda['denda'] . ' Data Denda Sudah Tercatat',
                        /* 'pengembalian_id' => null, */
                        'tgl_laporan' => date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                        'deleted_at' => null,
                    ];

                    $laporanDendaModel->insert($LaporanDendaData);

                    return redirect()->to('pinjam');
                }
            }
        }
    }

    /* public function kembaliBuku($pinjam_id)
    {
        $pinjamModel = new PinjamModel();
        $dendaModel = new DendaModel();
        $pengembalianModel = new PengembalianModel();
        $bukuModel = new BukuModel();
        $laporanPengembalianModel = new LaporanPengembalianModel();
        $laporanDendaModel = new LaporanDendaModel();

        // Periksa apakah ID peminjaman valid
        $peminjaman = $pinjamModel->find($pinjam_id);

        if (!$peminjaman) {
            // Jika peminjaman tidak ditemukan, tampilkan pesan error
            session()->setFlashdata('error', 'Data peminjaman tidak ditemukan.');
            return redirect()->back();
        }

        // Periksa apakah buku sudah dikembalikan sebelumnya
        if ($peminjaman->status == 'Dikembalikan') {
            // Jika buku telah dikembalikan sebelumnya, tampilkan pesan error
            session()->setFlashdata('error', 'Buku telah dikembalikan sebelumnya.');
            return redirect()->back();
        }

        // Update status peminjaman menjadi "Dikembalikan"
        $isUpdated = $pinjamModel->update($pinjam_id, ['status' => 'Dikembalikan']);

        if (!$isUpdated) {
            // Jika update gagal, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal mengupdate status peminjaman.');
            return redirect()->back();
        }

        // Tambahkan jumlah buku yang dikembalikan ke jumlah buku yang tersedia
        $buku_id = $peminjaman->buku_id;
        $jml_pinjam = $peminjaman->jml_pinjam;
        $bukuData = $bukuModel->find($buku_id);
        $jml_tersedia = $bukuData['jml'] ?? 0;
        $isBukuUpdated = $bukuModel->update($buku_id, ['jml' => ($jml_tersedia + $jml_pinjam)]);

        if (!$isBukuUpdated) {
            // Jika update gagal, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal mengupdate jumlah buku yang tersedia.');
            return redirect()->back();
        }

        // Periksa apakah pembaruan jumlah buku yang tersedia berhasil dilakukan
        $updatedBuku = $bukuModel->find($buku_id);
        if (!$updatedBuku || $updatedBuku['jml'] != ($jml_tersedia + $jml_pinjam)) {
            // Jika pembaruan gagal, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal mengupdate jumlah buku yang tersedia.');
            return redirect()->back();
        }

        // Generate ID pengembalian secara unik
        $id_pengembalian = 'PGL-' . strtoupper(bin2hex(random_bytes(6)));

        // Ambil data denda dari tabel tbl_denda berdasarkan pinjam_id
        $denda = $dendaModel->where('pinjam_id', $pinjam_id)->first();

        // Simpan data pengembalian ke dalam tabel tbl_pengembalian
        $pengembalianData = [
            'id_pengembalian' => $id_pengembalian,
            'pinjam_id' => $pinjam_id,
            'user_id' => $peminjaman->user_id,
            'buku_id' => $buku_id,
            'denda_id' => $denda ? $denda['id'] : null,
            'status' => 'Dikembalikan',
            'tgl_balik' => date('Y-m-d'),
            'lama_pinjam' => $peminjaman->lama_pinjam,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ];

        try {
            // Simpan data pengembalian ke dalam database
            $pengembalianModel->insert($pengembalianData);
        } catch (\Exception $e) {
            // Jika terjadi error saat menyimpan data, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal menyimpan data pengembalian. Error: ' . $e->getMessage());
            return redirect()->back();
        }

        // Mendapatkan ID pengembalian yang baru saja disimpan
        $id_pengembalian = $pengembalianModel->getInsertID();

        // Simpan data laporan
        $adminModel = new AdminModel();
        $user = $adminModel->find($peminjaman->user_id);
        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($buku_id);

        // Generate ID pengembalian secara unik
        $id_laporan_pengembalian = 'LPP-' . strtoupper(bin2hex(random_bytes(6)));

        $laporanData = [
            'id_laporan_pengembalian' => $id_laporan_pengembalian,
            'judul_laporan' => 'Laporan Pengembalian',
            'jenis_laporan' => $user->nama . ' (' . $user->anggota . ') Telah Mengembalikan ' . $jml_pinjam . ' Buku ' . $buku['title'],
            'pengembalian_id' => $id_pengembalian, // Menggunakan ID pengembalian yang baru saja disimpan
            'tgl_laporan' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ];

        try {
            $laporanPengembalianModel->insert($laporanData);
        } catch (\Exception $e) {
            // Jika terjadi error saat menyimpan data laporan, hapus data pengembalian yang baru saja disimpan
            $pengembalianModel->delete($id_pengembalian);
            session()->setFlashdata('error', 'Gagal menyimpan data laporan. Error: ' . $e->getMessage());
            return redirect()->back();
        }

        // Update status denda menjadi "Dikembalikan" jika ada denda
        if ($denda) {
            try {
                $dendaModel->update($denda['id'], ['status' => 'Sudah Dikembalikan', 'status_denda' => 'Tidak Ada Denda', 'tgl_kembali' => date('Y-m-d')]);
            } catch (\Exception $e) {
                // Jika terjadi error saat mengupdate status denda, tampilkan pesan error
                session()->setFlashdata('error', 'Gagal mengupdate status denda. Error: ' . $e->getMessage());
                return redirect()->back();
            }
        }

        // Tampilkan pesan sukses
        session()->setFlashdata('success', 'Buku berhasil dikembalikan.');
        return redirect()->to('pinjam');
    } */

    public function kembaliBuku($pinjam_id)
    {
        $pinjamModel = new PinjamModel();
        $dendaModel = new DendaModel();
        $pengembalianModel = new PengembalianModel();
        $bukuModel = new BukuModel();
        $laporanPengembalianModel = new LaporanPengembalianModel();
        $laporanDendaModel = new LaporanDendaModel();

        // Periksa apakah ID peminjaman valid
        $peminjaman = $pinjamModel->find($pinjam_id);

        if (!$peminjaman) {
            // Jika peminjaman tidak ditemukan, tampilkan pesan error
            session()->setFlashdata('error', 'Data peminjaman tidak ditemukan.');
            return redirect()->back();
        }

        // Periksa apakah buku sudah dikembalikan sebelumnya
        if ($peminjaman->status == 'Dikembalikan') {
            // Jika buku telah dikembalikan sebelumnya, tampilkan pesan error
            session()->setFlashdata('error', 'Buku telah dikembalikan sebelumnya.');
            return redirect()->back();
        }

        // Update status peminjaman menjadi "Dikembalikan"
        $isUpdated = $pinjamModel->update($pinjam_id, ['status' => 'Dikembalikan']);

        if (!$isUpdated) {
            // Jika update gagal, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal mengupdate status peminjaman.');
            return redirect()->back();
        }

        // Tambahkan jumlah buku yang dikembalikan ke jumlah buku yang tersedia
        $buku_id = $peminjaman->buku_id;
        $jml_pinjam = $peminjaman->jml_pinjam;
        $bukuData = $bukuModel->find($buku_id);
        $jml_tersedia = $bukuData['jml'] ?? 0;
        $isBukuUpdated = $bukuModel->update($buku_id, ['jml' => ($jml_tersedia + $jml_pinjam)]);

        if (!$isBukuUpdated) {
            // Jika update gagal, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal mengupdate jumlah buku yang tersedia.');
            return redirect()->back();
        }

        // Periksa apakah pembaruan jumlah buku yang tersedia berhasil dilakukan
        $updatedBuku = $bukuModel->find($buku_id);
        if (!$updatedBuku || $updatedBuku['jml'] != ($jml_tersedia + $jml_pinjam)) {
            // Jika pembaruan gagal, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal mengupdate jumlah buku yang tersedia.');
            return redirect()->back();
        }

        // Generate ID pengembalian secara unik
        $id_pengembalian = 'PGL-' . strtoupper(bin2hex(random_bytes(6)));

        // Ambil data denda dari tabel tbl_denda berdasarkan pinjam_id
        $denda = $dendaModel->where('pinjam_id', $pinjam_id)->first();

        // Simpan data pengembalian ke dalam tabel tbl_pengembalian
        $pengembalianData = [
            'id_pengembalian' => $id_pengembalian,
            'pinjam_id' => $pinjam_id,
            'user_id' => $peminjaman->user_id,
            'buku_id' => $buku_id,
            'denda_id' => $denda ? $denda['id'] : null,
            'status' => 'Dikembalikan',
            'tgl_balik' => date('Y-m-d'),
            'lama_pinjam' => $peminjaman->lama_pinjam,
            'tgl_pinjam' => $peminjaman->tgl_pinjam,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ];

        try {
            // Simpan data pengembalian ke dalam database
            $pengembalianModel->insert($pengembalianData);
        } catch (\Exception $e) {
            // Jika terjadi error saat menyimpan data, tampilkan pesan error
            session()->setFlashdata('error', 'Gagal menyimpan data pengembalian. Error: ' . $e->getMessage());
            return redirect()->back();
        }

        // Mendapatkan ID pengembalian yang baru saja disimpan
        $id_pengembalian = $pengembalianModel->getInsertID();

        // Simpan data laporan pengembalian
        $adminModel = new AdminModel();
        $user = $adminModel->find($peminjaman->user_id);
        $bukuModel = new BukuModel();
        $buku = $bukuModel->find($buku_id);

        // Generate ID laporan pengembalian secara unik
        $id_laporan_pengembalian = 'LPP-' . strtoupper(bin2hex(random_bytes(6)));

        $laporanData = [
            'id_laporan_pengembalian' => $id_laporan_pengembalian,
            'judul_laporan' => 'Laporan Pengembalian',
            'jenis_laporan' => $user->nama . ' (' . $user->anggota . ') Telah Mengembalikan ' . $jml_pinjam . ' Buku ' . $buku['title'],
            'pengembalian_id' => $id_pengembalian, // Menggunakan ID pengembalian yang baru saja disimpan
            'tgl_laporan' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'deleted_at' => null,
        ];

        try {
            $laporanPengembalianModel->insert($laporanData);
        } catch (\Exception $e) {
            // Jika terjadi error saat menyimpan data laporan, hapus data pengembalian yang baru saja disimpan
            $pengembalianModel->delete($id_pengembalian);
            session()->setFlashdata('error', 'Gagal menyimpan data laporan. Error: ' . $e->getMessage());
            return redirect()->back();
        }

        // Simpan data laporan denda jika ada denda
        if ($denda) {
            $laporanDendaData = [
                'id_laporan_denda' => 'LPDNU-' . strtoupper(bin2hex(random_bytes(6))),
                'denda_id' => $denda['id'],
                'judul_laporan' => 'Laporan Denda Peminjaman',
                'jenis_laporan' => $user->nama . ' (' . $user->anggota . ') Terdapat Denda Pada Peminjaman ' . $pinjam_id,
                'tgl_laporan' => date('Y-m-d'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => null,
            ];

            try {
                $laporanDendaModel->insert($laporanDendaData);
            } catch (\Exception $e) {
                // Jika terjadi error saat menyimpan data laporan denda, hapus data pengembalian dan laporan pengembalian yang baru saja disimpan
                $pengembalianModel->delete($id_pengembalian);
                $laporanPengembalianModel->delete($id_laporan_pengembalian);
                session()->setFlashdata('error', 'Gagal menyimpan data laporan denda. Error: ' . $e->getMessage());
                return redirect()->back();
            }
        }

        // Update status denda menjadi "Dikembalikan" jika ada denda
        if ($denda) {
            try {
                $dendaModel->update($denda['id'], ['status' => 'Sudah Dikembalikan', 'status_denda' => 'Tidak Ada Denda', 'tgl_kembali' => date('Y-m-d')]);
            } catch (\Exception $e) {
                // Jika terjadi error saat mengupdate status denda, tampilkan pesan error
                session()->setFlashdata('error', 'Gagal mengupdate status denda. Error: ' . $e->getMessage());
                return redirect()->back();
            }
        }

        // Tampilkan pesan sukses
        session()->setFlashdata('success', 'Buku berhasil dikembalikan.');
        return redirect()->to('pinjam');
    }


    public function pinjam_views()
    {
        $data = [
            'title' => 'Data Peminjaman Buku | Sistem Informasi Perpustakaan',
        ];

        // Load model biayadenda untuk mendapatkan data harga_denda
        $biayaDendaModel = new BiayaDendaModel();
        $data['biayaDenda'] = $biayaDendaModel->findAll();

        // Load model admin untuk mendapatkan data users
        $adminModel = new AdminModel();
        $data['users'] = $adminModel->findAll();

        // Load model buku untuk mendapatkan data buku
        $bukuModel = new BukuModel();
        $data['buku'] = $bukuModel->findAll();

        // Load model denda untuk mendapatkan data biaya_id
        $dendaModel = new DendaModel();
        $data['denda'] = $dendaModel->findAll();

        return view('pinjam/pinjam_views', $data);
    }
}
