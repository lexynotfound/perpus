<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class PinjamModel extends Model
{
    protected $table          = 'tbl_pinjam';
    protected $primaryKey     = 'id';
    protected $returnType     = User::class;
    protected $allowedFields  = [
        'jml_pinjam','id_pinjam', 'user_id', 'buku_id', 'harga_id', 'status', 'denda', 'tgl_pinjam', 'lama_pinjam', 'tgl_balik', 'created_at', 'updated_at', 'deleted_at',
    ];
    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
}
