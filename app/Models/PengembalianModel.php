<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class PengembalianModel extends Model
{
    protected $table          = 'tbl_pengembalian';
    protected $primaryKey     = 'id';
   /*  protected $returnType     = 'array'; */ // Set the return type to 'array' or remove this line if not needed
    protected $useSoftDeletes = true;
    protected $allowedFields  = [
        'id_pengembalian','pinjam_id', 'user_id', 'buku_id', 'denda_id', 'status', 'tgl_balik', 'lama_pinjam', 'tgl_pinjam',
        'created_at', 'updated_at', 'deleted_at',
    ];

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
    protected $dateFormat     = 'datetime'; // Set the desired date format

    // Add any custom functions or overrides here if needed
}
