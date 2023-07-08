<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\UserModel;
use CodeIgniter\Config\Services;



use App\Models\AdminModel;


class Admin extends BaseController
{

    protected $db;
    protected $builder;
    protected $adminModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table(('users'));
        $this->adminModel = new AdminModel();
        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',
        ];

        // join dengan tabel auth_groups dan auth_groups_users
        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        // hitung jumlah baris yang terkait dengan pengguna dan simpan di variabel $total_users
        $total_users = $this->builder->countAllResults();

        // reset builder dan ubah ke tabel tbl_buku
        $this->builder = $this->db->table('tbl_buku');

        // select id tabel buku dan id buku
        $this->builder->select('tbl_buku.id as tbl_bukuid, buku_id');

        // hitung jumlah baris yang terkait dengan buku dan simpan di variabel $total_buku
        $total_buku = $this->builder->countAllResults();

        // reset builder dan ubah ke tabel tbl_pinjam
        $this->builder = $this->db->table('tbl_pinjam');

        // join dengan tabel users dan tbl_buku
        $this->builder->select('tbl_pinjam.id as pinjamid, users.nama as nama_peminjam, tbl_buku.judul as judul_buku, tanggal_pinjam, tanggal_kembali');
        $this->builder->join('users', 'users.id = tbl_pinjam.user_id');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');

        // hitung jumlah baris yang terkait dengan peminjaman dan simpan di variabel $total_pinjam
        $total_pinjam = $this->builder->countAllResults();

        // reset builder dan ubah ke tabel tbl_denda
        $this->builder = $this->db->table('tbl_denda');

        // join dengan tabel tbl_pinjam
        $this->builder->select('tbl_pinjam.id as pinjamid, denda');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_denda.pinjam_id');

        // hitung jumlah baris yang terkait dengan denda dan simpan di variabel $total_denda
        $total_denda = $this->builder->countAllResults();

        // tambahkan data total ke dalam array $data
        $data['total_users'] = $total_users;
        $data['total_buku'] = $total_buku;
        $data['total_pinjam'] = $total_pinjam;
        $data['total_denda'] = $total_denda;

        return view('admin/index', $data);
    }
    
    public function data()
    {
        $data = [
            'title' => 'Data User | Sistem Informasi Perpustakaan',
        ];

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, active, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        return view('admin/data', $data);
    }

    public function profile()
    {
        $data = [
            'title' => 'Profile | Sistem Informasi Perpustakaan',
        ];

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, active, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $query = $this->builder->get();

        $data['users'] = $query->getRow();

        return view('admin/profile', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Cetak Kartu | Sistem Informasi Perpustakaan',
        ];

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, active, tgl_bergabung, status, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        // Return the detail view with the data
        return view('admin/detail', $data);

    }

    // Menambahkan data anggota
    public function tambahUser()
    {
        if ($this->request->getMethod() === 'post') {
            // Ambil data dari form
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $jenkel = $this->request->getPost('jenkel');
            $alamat = $this->request->getPost('alamat');
            $foto = $this->request->getFile('foto');
            $nama = $this->request->getPost('nama');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $telepon = $this->request->getPost('telepon');

            // Validasi data
            $validation = \Config\Services::validation();
            $validation->setRules([
                'username' => [
                    'rules' => 'required|is_unique[users.email]',
                    'errors' => [
                        'required' => 'Username harus diisi.',
                        'is_unique' => 'Username sudah digunakan',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]', // Menambahkan aturan is_unique
                    'errors' => [
                        'required' => 'Email harus diisi.',
                        'valid_email' => 'Format email tidak valid.',
                        'is_unique' => 'Email sudah digunakan.'
                    ]
                ],
                'jenkel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin harus diisi.'
                    ]
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi.'
                    ]
                ],
                'foto' => [
                    'rules' => 'max_size[foto,20480]|is_image[foto]|mime_in[foto,image/png,image/jpeg,image/jpg,image/gif,image/svg+xml]',
                    'errors' => [
                        'max_size' => 'Ukuran foto terlalu besar. Maksimal ukuran file adalah 20 MB.',
                        'is_image' => 'File yang diunggah bukan gambar.',
                        'mime_in' => 'Format gambar tidak valid. Hanya file dengan format PNG, JPEG, JPG, GIF, dan SVG yang diperbolehkan.'
                    ]
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.'
                    ]
                ],
                'tgl_lahir' => [
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'Tanggal lahir harus diisi.',
                        'valid_date' => 'Format tanggal lahir tidak valid. Gunakan format YYYY-MM-DD.'
                    ]
                ],
                'telepon' => [
                    'rules' => 'required|max_length[13]',
                    'errors' => [
                        'required' => 'No telepon harus diisi.',
                        'max_length' => 'No telepon harus terdiri dari 13 digit.'
                    ]
                ]
            ]);

            if (!$validation->run([
                'username' => $username,
                'email' => $email,
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'foto' => $foto,
                'nama' => $nama,
                'tgl_lahir' => $tgl_lahir,
                'telepon' => $telepon,
            ])) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Jika foto diisi, simpan file foto dengan nama unik
            if ($foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move('/img', $newName);
            } else {
                // Jika foto tidak diisi atau tidak valid, gunakan nilai default.svg
                $newName = 'default.svg';
            }

            // Siapkan data untuk disimpan
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'foto' => $newName,
                'nama' => $nama,
                'tgl_lahir' => $tgl_lahir,
                'telepon' => $telepon,
                'anggota' => $this->generateNoAnggota(),
            ];

            // Simpan data ke dalam database
            $userModel = new UserModel();
            $userModel->insert($data);

            return redirect()->to('/admin/data')->with('success', 'User berhasil ditambahkan.');
        }

        // Tampilkan form tambah user
        return view('admin/tambahUser');
    }


    public function tambahUserView()
    {
        $data = [
            'title' => 'Tambah User | Sistem Informasi Perpustakaan',
        ];

        return view('admin/tambahUserView', $data);
    }

    private function generateNoAnggota()
    {
        $model = new UserModel();

        $lastUser = $model->orderBy('id', 'DESC')->first();
        $lastAnggota = $lastUser ? (int) substr($lastUser->anggota, 2) : 0;
        $newAnggota = $lastAnggota + 1;

        return 'AG' . str_pad($newAnggota, 4, '0', STR_PAD_LEFT);
    }

    public function edit($id = 0)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if (!$user) {
            return redirect()->to('/admin/data')->with('error', 'User tidak ditemukan.');
        }

        if ($this->request->getMethod() === 'post') {
            // Ambil data dari form
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $jenkel = $this->request->getPost('jenkel');
            $alamat = $this->request->getPost('alamat');
            $foto = $this->request->getPost('foto');
            $nama = $this->request->getPost('nama');
            $tgl_lahir = $this->request->getPost('tgl_lahir');
            $telepon = $this->request->getPost('telepon');

            // Validasi data
            $validation = \Config\Services::validation();
            $validation->setRules([
                'username' => 'required',
                'email' => 'required|valid_email',
                'jenkel' => 'required',
                'alamat' => 'required',
                'foto' => 'required',
                'nama' => 'required',
                'tgl_lahir' => 'required',
                'telepon' => 'required',
            ]);

            if (!$validation->run([
                'username' => $username,
                'email' => $email,
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'foto' => $foto,
                'nama' => $nama,
                'tgl_lahir' => $tgl_lahir,
                'telepon' => $telepon,
            ])) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }

            // Siapkan data untuk diupdate
            $data = [
                'username' => $username,
                'email' => $email,
                'jenkel' => $jenkel,
                'alamat' => $alamat,
                'foto' => $foto,
                'nama' => $nama,
                'tgl_lahir' => $tgl_lahir,
                'telepon' => $telepon,
            ];

            // Update data di dalam database
            $userModel->update($id, $data);

            return redirect()->to('/admin/data')->with('success', 'User berhasil diupdate.');
        }

        // Tampilkan form edit user
        $data = [
            'title' => 'Edit User | Sistem Informasi Perpustakaan',
            'user' => $user
        ];

        return view('admin/editUser', $data);
    }

    public function delete($id)
    {
        $session = session();
        $loggedInUserId = $session->get('user_id');

        // Periksa apakah pengguna sedang login
        if ($loggedInUserId == $id) {
            return redirect()->to('/admin/data')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Lanjutkan dengan penghapusan data jika pengguna yang dihapus bukan pengguna yang sedang login
        $adminModel = new AdminModel();
        $admin = $adminModel->find($id);

        if (!$admin) {
            return redirect()->to('/admin/data')->with('error', 'Admin tidak ditemukan.');
        }

        // Hapus data admin
        $deleted = $adminModel->delete($id);

        if ($deleted) {
            return redirect()->to('/admin/data')->with('success', 'Data berhasil dihapus.');
        } else {
            return redirect()->to('/admin/data')->with('error', 'Terjadi kesalahan saat menghapus admin.');
        }
    }

}
