<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\LaporanBukuModel;
use App\Models\BukuModel;
use Dompdf\Dompdf;
use CodeIgniter\Config\Services;

class LaporanBuku extends BaseController
{

    protected $db;
    protected $builder;
    protected $laporanBukuModel;
    protected $bukuModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->laporanBukuModel = new LaporanBukuModel();
        $this->bukuModel = new BukuModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan_buku');
        $this->builder->select('tbl_laporan_buku.id as laporanbukuid, tbl_laporan_buku.judul_laporan,tbl_laporan_buku.id_laporan_buku, tbl_laporan_buku.deleted_at, tbl_laporan_buku.buku_id, tbl_laporan_buku.jenis_laporan, tbl_laporan_buku.tgl_laporan, tbl_laporan_buku.updated_at, tbl_buku.id_buku, tbl_buku.title, tbl_buku.jml');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_laporan_buku.buku_id');

        $query = $this->builder->get();
        $data['laporanbuku'] = $query->getResult();

        return view('laporanbuku/index', $data);
    }

    public function date()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan_buku');
        $this->builder->select('tbl_laporan_buku.id as laporanbukuid, tbl_laporan_buku.judul_laporan,tbl_laporan_buku.id_laporan_buku, tbl_laporan_buku.deleted_at, tbl_laporan_buku.buku_id, tbl_laporan_buku.jenis_laporan, tbl_laporan_buku.tgl_laporan, tbl_laporan_buku.updated_at, tbl_buku.id_buku, tbl_buku.title, tbl_buku.jml');
        $this->builder->join('tbl_buku', 'tbl_buku.id = tbl_laporan_buku.buku_id');
        $this->builder->where('tgl_laporan >=', $startDate);
        $this->builder->where('tgl_laporan <=', $endDate);

        $query = $this->builder->get();
        $data['laporanbuku'] = $query->getResult();

        return view('laporanbuku/index', $data);
    }


    public function generatePdf()
    {
        // Query data dari database
        $laporanbuku = $this->laporanBukuModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Buku</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-left-radius: 8px;">No</th>';
   /*      $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Laporan</th>'; */
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Laporan Buku</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Buku</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Judul Buku</th>';
        /* $html .= '<th style="border: 1px solid #000; padding: 8px;">Judul Laporan</th>'; */
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Jumlah</th>';
        /* $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Jenis Laporan</th>'; */
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($laporanbuku as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $no . '</td>';
            /* $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->tgl_laporan . '</td>'; */
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->id_laporan_buku . '</td>';
            /* $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->judul_laporan . '</td>'; */

            // Ambil data buku berdasarkan buku_id
            $buku = $this->bukuModel->withDeleted()->find($lp->buku_id);
            if ($buku) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['id_buku'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['title'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $buku['jml'] . '</td>';
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
        file_put_contents('laporan_buku.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_buku.pdf"');
        readfile('laporan_buku.pdf');
        exit();
    }



}
