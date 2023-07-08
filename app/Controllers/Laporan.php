<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\LaporanModel;
use Dompdf\Dompdf;
use App\Models\PinjamModel;
use App\Models\BukuModel;
use CodeIgniter\Config\Services;

class Laporan extends BaseController
{

    protected $db;
    protected $builder;
    protected $laporanModel;
    protected $pinjamModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->laporanModel = new LaporanModel();
        $this->pinjamModel = new PinjamModel();
        $this->bukuModel = new BukuModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan');
        $this->builder->select('tbl_laporan.id as laporanid, tbl_laporan.judul_laporan,tbl_laporan.id_laporan_peminjaman, tbl_laporan.pinjam_id, tbl_laporan.buku_id, tbl_laporan.jenis_laporan, tbl_laporan.tgl_laporan, tbl_laporan.updated_at, tbl_buku.id_buku, tbl_buku.title, tbl_buku.jml, tbl_pinjam.id_pinjam, tbl_pinjam.jml_pinjam ');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_laporan.pinjam_id');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');

        $query = $this->builder->get();
        $data['laporan'] = $query->getResult();

        return view('laporan/index', $data);
    }

    public function store()
    {
        $data = [
            'title' => 'Bikin Laporan | Sistem Informasi Perpustakaan',
        ];

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'judul_laporan' => [
                    'rules' => 'required|is_unique[tbl_laporan.judul_laporan]',
                    'errors' => [
                        'required' => 'Judul harus diisi.',
                        'is_unique' => 'Judul sudah digunakan.'
                    ]
                ],
                'jenis_laporan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis laporan harus di isi.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan dalam penginputan. Silakan periksa kembali data yang diinput.');

                return view('laporan/create', $data);
            } else {
                // Jika data valid, simpan laporan ke dalam tabel
                $laporanData = [
                    'judul_laporan' => $this->request->getPost('judul_laporan'),
                    'jenis_laporan' => $this->request->getPost('jenis_laporan'),
                    'tgl_laporan' => date('Y-m-d H:i:s'), // Tambahkan nilai tgl_laporan
                    'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                ];

                $this->laporanModel->insert($laporanData);

                session()->setFlashdata('success', 'Data laporan berhasil ditambahkan.');

                return redirect()->to('buku');
            }
        }

        return view('laporan/create', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Membuat Laporan | Sistem Informasi Perpustakaan',
        ];

        return view('laporan/create', $data);
    }

    public function update($id)
    {
        $data = [
            'title' => 'Update Laporan | Sistem Informasi Perpustakaan',
        ];

        if ($this->request->getMethod() === 'post') {
            // Validasi data yang diinput
            $rules = [
                'judul_laporan' => [
                    'rules' => "required|is_unique[tbl_laporan.judul_laporan,id,$id]",
                    'errors' => [
                        'required' => 'Judul harus diisi.',
                        'is_unique' => 'Judul sudah digunakan.'
                    ]
                ],
                'jenis_laporan' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis laporan harus di isi.'
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;

                // Tambahkan pesan error jika terdapat kesalahan validasi
                session()->setFlashdata('error', 'Terdapat kesalahan dalam penginputan. Silakan periksa kembali data yang diinput.');

                return view('laporan/update', $data);
            } else {
                // Jika data valid, update laporan di dalam tabel
                $laporanData = [
                    'judul_laporan' => $this->request->getPost('judul_laporan'),
                    'jenis_laporan' => $this->request->getPost('jenis_laporan'),
                    'updated_at' => date('Y-m-d H:i:s'), // Tambahkan nilai updated_at
                ];

                $this->laporanModel->update($id, $laporanData);

                session()->setFlashdata('success', 'Data laporan berhasil diperbarui.');

                return redirect()->to('buku');
            }
        }

        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data laporan tidak ditemukan.');
        }

        $data['laporan'] = $laporan;

        return view('laporan/update', $data);
    }

    // mengahpus data laporan
    public function delete($id)
    {
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data laporan tidak ditemukan.');
        }

        $this->laporanModel->delete($id);

        session()->setFlashdata('success', 'Data laporan berhasil dihapus.');

        return redirect()->to('laporan');
    }

    public function date()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan');
        $this->builder->select('tbl_laporan.id as laporanid, tbl_laporan.judul_laporan,tbl_laporan.id_laporan_peminjaman,tbl_laporan.tgl_laporan, tbl_laporan.pinjam_id, tbl_laporan.buku_id, tbl_laporan.jenis_laporan, tbl_laporan.tgl_laporan, tbl_laporan.updated_at, tbl_buku.id_buku, tbl_buku.title, tbl_buku.jml, tbl_pinjam.id_pinjam, tbl_pinjam.jml_pinjam ');
        $this->builder->join('tbl_pinjam', 'tbl_pinjam.id = tbl_laporan.pinjam_id');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_pinjam.buku_id');
        $this->builder->where('tgl_laporan >=', $startDate);
        $this->builder->where('tgl_laporan <=', $endDate);

        $query = $this->builder->get();
        $data['laporan'] = $query->getResult();

        return view('laporan/index', $data);
    }

    public function generatePdf()
    {
        // Query data dari database
        $laporan = $this->laporanModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Peminjaman</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-left-radius: 8px;">No</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Laporan</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Laporan Peminjaman</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Peminjaman</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Judul Buku</th>';
        /* $html .= '<th style="border: 1px solid #000; padding: 8px;">Judul Laporan</th>'; */
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Jumlah</th>';
       /*  $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Jenis Laporan</th>'; */
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($laporan as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $no . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->tgl_laporan . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->id_laporan_peminjaman . '</td>';
            /* $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->judul_laporan . '</td>'; */
            
            // Ambil data buku berdasarkan buku_id
            $peminjaman = $this->pinjamModel->withDeleted()->find($lp->pinjam_id);
            if ($peminjaman) {
                $buku = $this->bukuModel->find($peminjaman->buku_id);
                if ($buku) {
                    $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $peminjaman->id_pinjam . '</td>';
                    $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['title'] . '</td>';
                    $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $peminjaman->jml_pinjam . ' Buku Dipinjam</td>';
                } else {
                    $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                    $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                    $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                }
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }
            
            
            /* $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->jenis_laporan . '</td>'; */
            $html .= '</tr>';

            $no++;
        }

        $html .= '</tbody></table>';

        // Load konten HTML ke DOMPDF
        $dompdf->loadHtml($html);

        // Set orientasi landscape
        $dompdf->setPaper('A4', 'landscape');

        // Aktifkan opsi isRemoteEnabled
        $dompdf->set_option('isRemoteEnabled', true);

        // Render konten HTML menjadi PDF
        $dompdf->render();

        // Simpan PDF ke file
        $output = $dompdf->output();
        file_put_contents('laporan_peminjaman.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_peminjaman.pdf"');
        readfile('laporan_peminjaman.pdf');
        exit();
    }
}
