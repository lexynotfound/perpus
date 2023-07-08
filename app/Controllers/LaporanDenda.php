<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\Security\Security;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;
use App\Models\LaporanDendaModel;
use App\Models\DendaModel;
use Dompdf\Dompdf;
use CodeIgniter\Config\Services;

class LaporanDenda extends BaseController
{

    protected $db;
    protected $builder;
    protected $laporanDendaModel;
    protected $dendaModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table('users');
        $this->laporanDendaModel = new LaporanDendaModel();
        $this->dendaModel = new DendaModel();

        helper(['form']);
    }

    public function index()
    {
        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan_denda');
        $this->builder->select('tbl_laporan_denda.id as laporandendaid, tbl_laporan_denda.judul_laporan,tbl_laporan_denda.id_laporan_denda, tbl_laporan_denda.deleted_at, tbl_laporan_denda.denda_id, tbl_laporan_denda.jenis_laporan, tbl_laporan_denda.tgl_laporan, tbl_laporan_denda.updated_at, tbl_denda.id_denda, tbl_denda.denda, tbl_denda.status');
        $this->builder->join('tbl_denda', 'tbl_denda.id = tbl_laporan_denda.denda_id');

        $query = $this->builder->get();
        $data['laporandenda'] = $query->getResult();

        return view('laporandenda/index', $data);
    }

    public function date()
    {
        $startDate = $this->request->getPost('startDate');
        $endDate = $this->request->getPost('endDate');

        $data = [
            'title' => 'Data Laporan Peminjaman Perpustakaan | Sistem Informasi Perpustakaan',
        ];

        $this->builder = $this->db->table('tbl_laporan_denda');
        $this->builder->select('tbl_laporan_denda.id as laporandendaid, tbl_laporan_denda.judul_laporan,tbl_laporan_denda.id_laporan_denda, tbl_laporan_denda.deleted_at, tbl_laporan_denda.denda_id, tbl_laporan_denda.jenis_laporan, tbl_laporan_denda.tgl_laporan, tbl_laporan_denda.updated_at, tbl_denda.id_denda, tbl_denda.denda, tbl_denda.status');
        $this->builder->join('tbl_denda', 'tbl_denda.id = tbl_laporan_denda.denda_id');
        $this->builder->where('tgl_laporan >=', $startDate);
        $this->builder->where('tgl_laporan <=', $endDate);

        $query = $this->builder->get();
        $data['laporandenda'] = $query->getResult();

        return view('laporandenda/index', $data);
    }


    public function generatePdf()
    {
        // Query data dari database
        $laporandenda = $this->laporanDendaModel->findAll();

        // Buat objek DOMPDF baru
        $dompdf = new Dompdf();

        // Buat template HTML untuk PDF
        $html = '<h1 style="text-align: center;">Data Laporan Denda</h1>';
        $html .= '<table style="width: 100%; border-collapse: collapse; margin: 0 auto;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-left-radius: 8px;">No</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Tanggal Laporan</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Laporan Denda</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">ID Denda</th>';
        $html .= '<th style="border: 1px solid #000; padding: 8px;">Denda</th>';
        /* $html .= '<th style="border: 1px solid #000; padding: 8px;">Judul Laporan</th>'; */
        $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Status</th>';
        /* $html .= '<th style="border: 1px solid #000; padding: 8px; border-top-right-radius: 8px;">Jenis Laporan</th>'; */
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';

        $no = 1;
        foreach ($laporandenda as $lp) {
            $html .= '<tr>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $no . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->tgl_laporan . '</td>';
            $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->id_laporan_denda . '</td>';
            /* $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $lp->judul_laporan . '</td>'; */

            // Ambil data buku berdasarkan buku_id
            $denda = $this->dendaModel->withDeleted()->find($lp->denda_id);
            if ($denda) {
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $denda['id_denda'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $denda['denda'] . '</td>';
                $html .= '<td style="border: 1px solid #000; padding: 8px;">' . $denda['status'] . '</td>';
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
        file_put_contents('laporan_denda.pdf', $output);

        // Unduh file PDF
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="laporan_denda.pdf"');
        readfile('laporan_denda.pdf');
        exit();
    }
}
