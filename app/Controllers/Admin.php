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
use Fpdf\Fpdf;
use Spipu\Html2Pdf\Html2Pdf;
use tecnickcom\TCPDF\TCPDF;
use Mpdf\Mpdf;

use Dompdf\Dompdf;
use Dompdf\Options;

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

    /* public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',
        ];

        // Join dengan tabel auth_groups dan auth_groups_users
        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        // Hitung jumlah baris yang terkait dengan pengguna dan simpan di variabel $total_users
        $total_users = $this->builder->countAllResults();

        // Reset builder dan ubah ke tabel tbl_buku
        $this->builder = $this->db->table('tbl_buku');

        // Select id tabel buku dan id buku
        $this->builder->select('tbl_buku.id as tbl_bukuid, buku_id');

        // Hitung jumlah baris yang terkait dengan buku dan simpan di variabel $total_buku
        $total_buku = $this->builder->countAllResults();

        // Reset builder dan ubah ke tabel tbl_pinjam
        $this->builder = $this->db->table('tbl_pinjam');

        // Join dengan tabel users dan tbl_buku
        $this->builder->select('tbl_pinjam.id as pinjamid, users.nama as nama_peminjam, tbl_buku.judul as judul_buku, tanggal_pinjam, tanggal_kembali');
        $this->builder->join('users', 'users.id = tbl_pinjam.user_id');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');

        // Hitung jumlah baris yang terkait dengan peminjaman dan simpan di variabel $total_pinjam
        $total_pinjam = $this->builder->countAllResults();

        // Reset builder dan ubah ke tabel tbl_denda
        $this->builder = $this->db->table('tbl_denda');

        // Join dengan tabel tbl_pinjam
        $this->builder->select('tbl_pinjam.id as pinjamid, denda');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_denda.pinjam_id');

        // Hitung jumlah baris yang terkait dengan denda dan simpan di variabel $total_denda
        $total_denda = $this->builder->countAllResults();

        // Reset builder dan ubah ke tabel tbl_pengembalian
        $this->builder = $this->db->table('tbl_pengembalian');

        // Hitung jumlah baris yang terkait dengan pengembalian dan simpan di variabel $total_pengembalian
        $total_pengembalian = $this->builder->countAllResults();

        // Tambahkan data total ke dalam array $data
        $data['total_users'] = $total_users;
        $data['total_buku'] = $total_buku;
        $data['total_pinjam'] = $total_pinjam;
        $data['total_denda'] = $total_denda;
        $data['total_pengembalian'] = $total_pengembalian;

        return view('admin/index', $data);
    } */

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',
        ];

        // Join dengan tabel auth_groups dan auth_groups_users
        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        // Hitung jumlah baris yang terkait dengan pengguna dan simpan di variabel $total_users
        $total_users = $this->builder->countAllResults();

        // Reset builder dan ubah ke tabel tbl_buku
        $this->builder = $this->db->table('tbl_buku');

        // Select id tabel buku dan id buku
        $this->builder->select('tbl_buku.id as tbl_bukuid, buku_id');

        // Hitung jumlah baris yang terkait dengan buku dan simpan di variabel $total_buku
        $total_buku = $this->builder->countAllResults();

        // Reset builder dan ubah ke tabel tbl_pinjam
        $this->builder = $this->db->table('tbl_pinjam');

        // Join dengan tabel users dan tbl_buku
        $this->builder->select('tbl_buku.title as judul_buku, SUM(tbl_pinjam.jml_pinjam) as jumlah_pinjam');
        $this->builder->join('users', 'users.id = tbl_pinjam.user_id');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');
        $this->builder->groupBy('tbl_buku.title');

        // Ambil data buku yang sering dipinjam atau populer
        $this->builder->orderBy('jumlah_pinjam', 'DESC');
        $this->builder->limit(10);
        $most_popular_books = $this->builder->get()->getResult();

        // Hitung jumlah baris yang terkait dengan peminjaman dan simpan di variabel $total_pinjam
        $total_pinjam = count($most_popular_books);

        // Reset builder dan ubah ke tabel tbl_denda
        $this->builder = $this->db->table('tbl_denda');

        // Join dengan tabel tbl_pinjam
        $this->builder->select('tbl_pinjam.id as pinjamid, tbl_denda.denda, tbl_pinjam.user_id');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_denda.pinjam_id');

        // Urutkan berdasarkan denda secara descending
        $this->builder->orderBy('tbl_denda.denda', 'DESC');

        // Dapatkan denda terbesar dan batasi hasil hanya 10 data
        $this->builder->limit(10);
        $largest_fines = $this->builder->get()->getResult();

        // Simpan data denda terbesar ke dalam array $data
        $data['largest_fines'] = $largest_fines;

        // Hitung jumlah baris yang terkait dengan denda dan simpan di variabel $total_denda
        $total_denda = count($largest_fines);

        // Reset builder dan ubah ke tabel tbl_pengembalian
        $this->builder = $this->db->table('tbl_pengembalian');

        // Hitung jumlah baris yang terkait dengan pengembalian dan simpan di variabel $total_pengembalian
        $total_pengembalian = $this->builder->countAllResults();

        // Tambahkan data total ke dalam array $data
        $data['total_users'] = $total_users;
        $data['total_buku'] = $total_buku;
        $data['total_pinjam'] = $total_pinjam;
        $data['total_denda'] = $total_denda;
        $data['total_pengembalian'] = $total_pengembalian;

        // Tambahkan data buku yang sering dipinjam ke dalam array $data
        $data['most_popular_books'] = $most_popular_books;

        // Reset builder dan ubah ke tabel tbl_denda
        $this->builder = $this->db->table('tbl_denda');

        // Join dengan tabel tbl_pinjam
        $this->builder->select('tbl_pinjam.id as pinjamid, tbl_denda.denda, tbl_pinjam.user_id');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_denda.pinjam_id');

        // Urutkan berdasarkan denda secara descending
        $this->builder->orderBy('tbl_denda.denda',
            'DESC'
        );

        // Dapatkan denda terbesar dan batasi hasil hanya 2 data
        $this->builder->limit(2);
        $largest_fines = $this->builder->get()->getResult();

        // Simpan data denda terbesar ke dalam array $data
        $data['largest_fines'] = $largest_fines;


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

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, tgl_lahir, active, tgl_bergabung, status, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/detail', $data);
    }

    public function detail_card($id = 0)
    {
        $data = [
            'title' => 'Cetak Kartu | Sistem Informasi Perpustakaan',
        ];

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, tgl_lahir, active, tgl_bergabung, status, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

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
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => 'Username harus diisi.',
                        'is_unique' => 'Username sudah digunakan',
                    ]
                ],
                'email' => [
                    'rules' => 'required|valid_email|is_unique[users.email]',
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
                        'valid_date' => 'Format tanggal lahir tidak valid. Gunakan format 1998-06-12 (YYYY-MM-DD).'
                    ]
                ],
                'telepon' => [
                    'rules' => 'required|max_length[13]',
                    'errors' => [
                        'required' => '{field} No telepon harus diisi.',
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
                $foto->move('./img', $newName);
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
            $adminModel = new AdminModel();
            $userId = $adminModel->insert($data);

            // Set user default group to 'anggota' (id = 2)
            $groupModel = new \Myth\Auth\Models\GroupModel();
            $groupModel->addUserToGroup($userId, 2); // Assign user to group 'anggota'
            return redirect()->to('/admin/data')->with('success', 'User berhasil ditambahkan.');
        }

        // Tampilkan form tambah user dengan pesan kesalahan
        $data['errors'] = session('errors'); // Mengambil pesan kesalahan dari session
        return view('admin/tambahUser', $data);
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

    public function updateUser($id)
    {
        $adminModel = new AdminModel();
        $user = $adminModel->find($id);

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
                    'rules' => "required|is_unique[users.username,id,$id]",
                    'errors' => [
                        'required' => 'Username harus diisi.',
                        'is_unique' => 'Username sudah digunakan.',
                    ],
                ],
                'email' => [
                    'rules' => "required|valid_email|is_unique[users.email,id,$id]",
                    'errors' => [
                        'required' => 'Email harus diisi.',
                        'valid_email' => 'Format email tidak valid.',
                        'is_unique' => 'Email sudah digunakan.',
                    ],
                ],
                'jenkel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin harus diisi.',
                    ],
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi.',
                    ],
                ],
                'foto' => [
                    'rules' => 'max_size[foto,20480]|is_image[foto]|mime_in[foto,image/png,image/jpeg,image/jpg,image/gif,image/svg+xml]',
                    'errors' => [
                        'max_size' => 'Ukuran foto terlalu besar. Maksimal ukuran file adalah 20 MB.',
                        'is_image' => 'File yang diunggah bukan gambar.',
                        'mime_in' => 'Format gambar tidak valid. Hanya file dengan format PNG, JPEG, JPG, GIF, dan SVG yang diperbolehkan.',
                    ],
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.',
                    ],
                ],
                'tgl_lahir' => [
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'Tanggal lahir harus diisi.',
                        'valid_date' => 'Format tanggal lahir tidak valid. Gunakan format 1998-06-12 (YYYY-MM-DD).',
                    ],
                ],
                'telepon' => [
                    'rules' => 'required|max_length[13]',
                    'errors' => [
                        'required' => 'No telepon harus diisi.',
                        'max_length' => 'No telepon harus terdiri dari 13 digit.',
                    ],
                ],
            ]);

            // Jika old data masih sama dengan data yang diinputkan
            if ($username === $user->username) {
                $validation->setRules(['username' => 'permit_empty']);
            }
            if ($email === $user->email) {
                $validation->setRules(['email' => 'permit_empty']);
            }
            if ($jenkel === $user->jenkel) {
                $validation->setRules(['jenkel' => 'permit_empty']);
            }
            if ($alamat === $user->alamat) {
                $validation->setRules(['alamat' => 'permit_empty']);
            }
            if ($nama === $user->nama) {
                $validation->setRules(['nama' => 'permit_empty']);
            }
            if ($tgl_lahir === $user->tgl_lahir) {
                $validation->setRules(['tgl_lahir' => 'permit_empty']);
            }
            if ($telepon === $user->telepon) {
                $validation->setRules(['telepon' => 'permit_empty']);
            }

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

            // Proses upload foto (jika ada)
            if ($foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move('./img', $newName);
                // Hapus foto lama jika ada
                if ($user['foto'] !== null && file_exists('./path/to/upload/folder/' . $user['foto'])) {
                    unlink('./img' . $user->foto);
                }
            } else {
                $newName = $user->foto;
            }

            // Siapkan data untuk disimpan
            $data = [
                'username' => ($username !== '') ? $username : $user['username'],
                'email' => ($email !== '') ? $email : $user['email'],
                'password' => $password,
                'jenkel' => ($jenkel !== '') ? $jenkel : $user['jenkel'],
                'alamat' => ($alamat !== '') ? $alamat : $user['alamat'],
                'foto' => $newName,
                'nama' => ($nama !== '') ? $nama : $user['nama'],
                'tgl_lahir' => ($tgl_lahir !== '') ? $tgl_lahir : $user['tgl_lahir'],
                'telepon' => ($telepon !== '') ? $telepon : $user['telepon'],
            ];

            // Simpan data ke dalam database
            $adminModel->update($id, $data);

            return redirect()->to('/admin/data')->with('success', 'Data berhasil diperbarui.');
        }

        // Tampilkan form edit user
        return view('admin/tambahUserView', ['user' => $user]);
    }

    public function EditProfile()
    {
        $adminModel = new AdminModel();
        $user = $adminModel->find();

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
                    'rules' => "required|is_unique[users.username]",
                    'errors' => [
                        'required' => 'Username harus diisi.',
                        'is_unique' => 'Username sudah digunakan.',
                    ],
                ],
                'email' => [
                    'rules' => "required|valid_email|is_unique[users.email]",
                    'errors' => [
                        'required' => 'Email harus diisi.',
                        'valid_email' => 'Format email tidak valid.',
                        'is_unique' => 'Email sudah digunakan.',
                    ],
                ],
                'jenkel' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis kelamin harus diisi.',
                    ],
                ],
                'alamat' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Alamat harus diisi.',
                    ],
                ],
                'foto' => [
                    'rules' => 'max_size[foto,20480]|is_image[foto]|mime_in[foto,image/png,image/jpeg,image/jpg,image/gif,image/svg+xml]',
                    'errors' => [
                        'max_size' => 'Ukuran foto terlalu besar. Maksimal ukuran file adalah 20 MB.',
                        'is_image' => 'File yang diunggah bukan gambar.',
                        'mime_in' => 'Format gambar tidak valid. Hanya file dengan format PNG, JPEG, JPG, GIF, dan SVG yang diperbolehkan.',
                    ],
                ],
                'nama' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama harus diisi.',
                    ],
                ],
                'tgl_lahir' => [
                    'rules' => 'required|valid_date[Y-m-d]',
                    'errors' => [
                        'required' => 'Tanggal lahir harus diisi.',
                        'valid_date' => 'Format tanggal lahir tidak valid. Gunakan format 1998-06-12 (YYYY-MM-DD).',
                    ],
                ],
                'telepon' => [
                    'rules' => 'required|max_length[13]',
                    'errors' => [
                        'required' => 'No telepon harus diisi.',
                        'max_length' => 'No telepon harus terdiri dari 13 digit.',
                    ],
                ],
            ]);

            // Jika old data masih sama dengan data yang diinputkan
            if ($username === $user->username) {
                $validation->setRules(['username' => 'permit_empty']);
            }
            if ($email === $user->email) {
                $validation->setRules(['email' => 'permit_empty']);
            }
            if ($jenkel === $user->jenkel) {
                $validation->setRules(['jenkel' => 'permit_empty']);
            }
            if ($alamat === $user->alamat) {
                $validation->setRules(['alamat' => 'permit_empty']);
            }
            if ($nama === $user->nama) {
                $validation->setRules(['nama' => 'permit_empty']);
            }
            if ($tgl_lahir === $user->tgl_lahir) {
                $validation->setRules(['tgl_lahir' => 'permit_empty']);
            }
            if ($telepon === $user->telepon) {
                $validation->setRules(['telepon' => 'permit_empty']);
            }

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

            // Proses upload foto (jika ada)
            if ($foto->isValid() && !$foto->hasMoved()) {
                $newName = $foto->getRandomName();
                $foto->move('./img', $newName);
                // Hapus foto lama jika ada
                if ($user['foto'] !== null && file_exists('./path/to/upload/folder/' . $user['foto'])) {
                    unlink('./img' . $user->foto);
                }
            } else {
                $newName = $user->foto;
            }

            // Siapkan data untuk disimpan
            $data = [
                'username' => ($username !== '') ? $username : $user['username'],
                'email' => ($email !== '') ? $email : $user['email'],
                'password' => $password,
                'jenkel' => ($jenkel !== '') ? $jenkel : $user['jenkel'],
                'alamat' => ($alamat !== '') ? $alamat : $user['alamat'],
                'foto' => $newName,
                'nama' => ($nama !== '') ? $nama : $user['nama'],
                'tgl_lahir' => ($tgl_lahir !== '') ? $tgl_lahir : $user['tgl_lahir'],
                'telepon' => ($telepon !== '') ? $telepon : $user['telepon'],
            ];

            // Simpan data ke dalam database
            $adminModel->update($data);

            return redirect()->to('/admin/data')->with('success', 'Data berhasil diperbarui.');
        }

        // Tampilkan form edit user
        return view('admin/editUserView', ['user' => $user]);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Anggota | Sistem Informasi Perpustakaan',
        ];

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, active, tgl_lahir, tgl_bergabung, status, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/edit', $data);
    }

    public function editProfileViews()
    {
        $data = [
            'title' => 'Edit Anggota | Sistem Informasi Perpustakaan',
        ];

        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, active, tgl_lahir, tgl_bergabung, status, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();

        $data['user'] = $query->getRow();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/editProfileViews', $data);
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



    /* public function generatePDF($userId)
    {
        // Load the UserModel or any other model to retrieve user data from the database
        $adminModel = new AdminModel();
        $user = $adminModel->find($userId);

        if ($user) {
            // Create a new PDF instance
            $pdf = new Fpdf(); // Gunakan constructor yang sesuai dengan kebutuhan Anda

            // Add a new page
            $pdf->AddPage();

            // Set the font and size for the content
            $pdf->SetFont('Arial', '', 12);

            // Set the background color
            $pdf->SetFillColor(244, 245, 247);

            // Set the text color
            $pdf->SetTextColor(0, 0, 0);

            // Set the left margin
            $pdf->SetLeftMargin(10);

            // Set the top margin
            $pdf->SetTopMargin(10);

            // Load the HTML content
            $html = '
            <div class="card mb-3" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="col-md-4 bg-info-rgb text-center text-white" style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <img src="' . base_url('/img/' . $user->foto) . '" alt="Avatar" class="img-fluid my-5" style="width: 90px;" />
                        <h5>' . $user->nama . '</h5>
                        <h6>' . $user->jenkel . '</h6>
                        <span class="badge bg-' . ($user->name == 'petugas' ? 'warning' : 'dark') . ' ">' . $user->name . '</span>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <h6>Information</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>Email</h6>
                                    <p class="text-muted">' . $user->email . '</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Address</h6>
                                    <p class="text-muted">' . $user->alamat . '</p>
                                </div>
                            </div>
                            <h6>Card Member</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1">
                                <div class="col-6 mb-3">
                                    <h6>ID Card</h6>
                                    <p class="text-muted">' . $user->anggota . '</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6>Date</h6>
                                    <p class="text-muted">' . $user->tgl_bergabung . '</p>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start">
                                <a href="#!"><i class="fab fa-facebook-f fa-lg me-3"></i></a>
                                <a href="#!"><i class="fab fa-twitter fa-lg me-3"></i></a>
                                <a href="#!"><i class="fab fa-instagram fa-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';

            // Output the HTML content
            $pdf->WriteHTML($html);

            // Output the PDF
            $pdf->Output('card.pdf', 'D');
        }
    } */

    /* public function generatePDf($userid)
    {
        // Create an instance of AdminModel
        $adminModel = new AdminModel();

        // Get user data from the database based on the provided user ID
        $user = $adminModel->find($userid);

        // Check if user found
        if (!$user) {
            // Handle the case when user is not found
            // For example, you can show an error message or redirect to another page
            echo '<div style="text-align: center; margin-top: 100px;">
            <h1 style="font-size: 30px; color: #ff0000;">User not found</h1>
            <p style="font-size: 18px; color: #555;">Sorry, the user you are looking for does not exist.</p>
            <a href="admin/index" style="font-size: 16px; color: #007bff; text-decoration: none;">Back to Home</a>
        </div>';
            return;
        }

        // Load the image template
        $imageTemplate = imagecreatefrompng('public/img/card.png');

        // Set font color
        $fontColor = imagecolorallocate($imageTemplate, 255, 255, 255);

        // Set font size
        $fontSize = 18;

        // Set text alignment
        $textAlign = 'left';

        // Set text position
        $textX = 50;
        $textY = 50;

        // Load user image
        $userImage = imagecreatefromjpeg('./img/card.png' . $user->foto);

        // Resize user image if needed
        $userImage = imagescale($userImage, 200, 200);

        // Set user image position
        $userImageX = 50;
        $userImageY = 150;

        // Copy user image to the image template
        imagecopy($imageTemplate, $userImage, $userImageX, $userImageY, 0, 0, imagesx($userImage), imagesy($userImage));

        // Write user details on the image
        imagettftext($imageTemplate, $fontSize, 0, $textX, $textY, $fontColor, 'path/to/font.ttf', 'Nama: ' . $user->nama);
        imagettftext($imageTemplate, $fontSize, 0, $textX, $textY + 30, $fontColor, 'path/to/font.ttf', 'Role: ' . $user->name);
        imagettftext($imageTemplate, $fontSize, 0, $textX, $textY + 60, $fontColor, 'path/to/font.ttf', 'Email: ' . $user->email);
        imagettftext($imageTemplate, $fontSize, 0, $textX, $textY + 90, $fontColor, 'path/to/font.ttf', 'Alamat: ' . $user->alamat);
        imagettftext($imageTemplate, $fontSize, 0, $textX, $textY + 120, $fontColor, 'path/to/font.ttf', 'ID Card: ' . $user->anggota);
        imagettftext($imageTemplate, $fontSize, 0, $textX, $textY + 150, $fontColor, 'path/to/font.ttf', 'Date: ' . $user->tgl_bergabung);

        // Output the image
        header('Content-Type: image/png');
        imagejpeg($imageTemplate);

        // Clean up memory
        imagedestroy($imageTemplate);
        imagedestroy($userImage);
    } */

    public function generatePDF($userid)
    {
        // Create an instance of AdminModel
        $adminModel = new \App\Models\AdminModel();

        // Get user data from the database based on the provided user ID
        $user = $adminModel->find($userid);

        // Check if user found
        if (!$user) {
            // Handle the case when user is not found
            // For example, you can show an error message or redirect to another page
            echo '<div style="text-align: center; margin-top: 100px;">
            <h1 style="font-size: 30px; color: #ff0000;">User not found</h1>
            <p style="font-size: 18px; color: #555;">Sorry, the user you are looking for does not exist.</p>
            <a href="/admin/index" style="font-size: 16px; color: #007bff; text-decoration: none;">Back to Home</a>
        </div>';
            return;
        }

        // Load the HTML template
        $htmlTemplate = view('admin/detail_card', ['user' => $user]);

        // Create Dompdf options
        $options = new Options();
        $options->set('isRemoteEnabled', true); // Enable fetching remote URLs (e.g., base_url)

        // Create a new Dompdf instance
        $dompdf = new Dompdf($options);

        // Load the HTML content
        $dompdf->loadHtml($htmlTemplate);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML content to PDF
        $dompdf->render();

        // Output the generated PDF
        $dompdf->stream('user_card.pdf', ['Attachment' => false]);
    }



    /* public function generatePDF($userId)
    {
        // Load the UserModel or any other model to retrieve user data from the database
        $adminModel = new AdminModel();
        $user = $adminModel->find($userId);

        if ($user) {
            // Create a new PDF instance
            $pdf = new FPDF(); // Gunakan kelas FPDF

            // Add a new page
            $pdf->AddPage();

            // Set the font and size for the content
            $pdf->SetFont('Arial', '', 12);

            // Set the background color
            $pdf->SetFillColor(244, 245, 247);

            // Set the text color
            $pdf->SetTextColor(0, 0, 0);

            // Set the left margin
            $pdf->SetLeftMargin(10);

            // Set the top margin
            $pdf->SetTopMargin(10);

            // Render the user information
            $pdf->Cell(0, 10, 'User Information', 0, 1, 'L', true);
            $pdf->Ln(4);

            $pdf->Cell(0, 6, 'Name: ' . $user->nama, 0, 1, 'L');
            $pdf->Cell(0, 6, 'Gender: ' . $user->jenkel, 0, 1, 'L');
            $pdf->Cell(0, 6, 'Role: ' . $user->name, 0, 1, 'L');
            $pdf->Cell(0, 6, 'Email: ' . $user->email, 0, 1, 'L');
            $pdf->Cell(0, 6, 'Address: ' . $user->alamat, 0, 1, 'L');
            $pdf->Cell(0, 6, 'Card Member Information', 0, 1, 'L', true);
            $pdf->Ln(4);

            $pdf->Cell(0, 6, 'ID Card: ' . $user->anggota, 0, 1, 'L');
            $pdf->Cell(0, 6, 'Date: ' . $user->tgl_bergabung, 0, 1, 'L');

            // Output the PDF
            $pdf->Output('card.pdf', 'D');
        }
    } */
}
