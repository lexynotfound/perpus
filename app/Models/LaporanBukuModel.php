<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class LaporanBukuModel extends Model
{
    protected $table          = 'tbl_laporan_buku';
    protected $primaryKey     = 'id';
    protected $returnType     = User::class;
    /* protected $useSoftDeletes = true; */
    protected $allowedFields  = [
        'id_laporan_buku','judul_laporan', 'jenis_laporan', 'buku_id',   'tgl_laporan', 'created_at',    'updated_at',    'deleted_at',

    ];

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
}
