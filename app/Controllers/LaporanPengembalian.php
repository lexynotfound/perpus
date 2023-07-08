<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\LaporanPengembalianModel;
use App\Models\PengembalianModel;
use App\Models\BukuModel;
use Dompdf\Dompdf;
use CodeIgniter\Config\Services;

class LaporanPengembalian extends BaseController
{

    protected $db;
    protected $builder;
    protected $laporanPengembalianModel;
    protected $pengembalianModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->laporanPengembalianModel = new LaporanPengembalianModel();
        $this->pengembalianModel = new PengembalianModel();
        $this->bukuModel = new BukuModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laporan Pengembalian Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan_pengembalian');
        $this->builder->select('tbl_laporan_pengembalian.id as laporanpengembalianid, tbl_laporan_pengembalian.judul_laporan,tbl_laporan_pengembalian.id_laporan_pengembalian, tbl_laporan_pengembalian.deleted_at, tbl_laporan_pengembalian.pengembalian_id, tbl_laporan_pengembalian.jenis_laporan, tbl_laporan_pengembalian.tgl_laporan, tbl_laporan_pengembalian.updated_at, tbl_pengembalian.id_pengembalian, tbl_pengembalian.lama_pinjam, tbl_pengembalian.status, ');
        $this->builder->join('tbl_pengembalian', 'tbl_pengembalian.id = tbl_laporan_pengembalian.pengembalian_id');

        $query = $this->builder->get();
        $data['laporanpengembalian'] = $query->getResult();

        return view('laporanpengembalian/index', $data);
    }
    public function date()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan_pengembalian');
        $this->builder->select('tbl_laporan_pengembalian.id as laporanpengembalianid, tbl_laporan_pengembalian.judul_laporan,tbl_laporan_pengembalian.id_laporan_pengembalian, tbl_laporan_pengembalian.deleted_at, tbl_laporan_pengembalian.pengembalian_id, tbl_laporan_pengembalian.jenis_laporan, tbl_laporan_pengembalian.tgl_laporan, tbl_laporan_pengembalian.updated_at, tbl_pengembalian.id_pengembalian, tbl_pengembalian.lama_pinjam, tbl_pengembalian.status, ');
        $this->builder->join('tbl_pengembalian', 'tbl_pengembalian.id = tbl_laporan_pengembalian.pengembalian_id');
        $this->builder->where('tgl_laporan >=', $startDate);
        $this->builder->where('tgl_laporan <=', $endDate);

        $query = $this->builder->get();
        $data['laporanpengembalian'] = $query->getResult();

        return view('laporanpengembalian/index', $data);
    }

    public function generatePDF()
    {
        // Query data dari database
        $laporanpengembalian = $this->laporanPengembalianModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Pengembalian</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto; border-radius: 50px;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-radius: 50px 0 0 50px;">No</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Laporan</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Laporan Pengembalian</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Pengembalian</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Status Pengembalian</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Lama Pinjam</th>';
        /* $html .= '<th style="border: 1px solid #000; padding: 8px; border-radius: 0 50px 50px 0;">Jenis Laporan</th>'; */
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-radius: 0 50px 50px 0;">Judul Buku</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($laporanpengembalian as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px; border-radius: 50px 0 0 50px;">' . $no . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->tgl_laporan . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->id_laporan_pengembalian . '</td>';
            /* $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->judul_laporan . '</td>'; */

            // Ambil data buku berdasarkan pengembalian_id dan buku_id di dalam tbl_pengembalian
            $pengembalian = $this->pengembalianModel->withDeleted()->find($lp->pengembalian_id);
            if ($pengembalian) {
                $buku = $this->bukuModel->find($pengembalian['buku_id']); // Assuming 'buku_id' is the foreign key for the 'buku' relationship
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['id_pengembalian'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['status'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['lama_pinjam'] . ' Hari</td>';
                if ($buku) {
                    $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['title'] . '</td>';
                } else {
                    $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                }
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            }


            /* $pengembalian = $this->pengembalianModel->withDeleted()->find($lp->pengembalian_id);
            if ($pengembalian) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['id_pengembalian'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['id_pengembalian'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['status'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $pengembalian['lama_pinjam'] . ' Hari</td>';
            } else {
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;"></td>';
            } */

            /* $html .= '<td style="border: 1px solid #000; padding: 8px; border-radius: 0 50px 50px 0;">' . $lp->jenis_laporan . '</td>'; */
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
        file_put_contents('laporan_pengembalian.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_pengembalian.pdf"');
        readfile('laporan_pengembalian.pdf');
        exit();
    }


}
