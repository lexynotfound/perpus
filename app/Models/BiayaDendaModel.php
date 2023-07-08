<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class BiayaDendaModel extends Model
{
    protected $table          = 'tbl_biaya_denda';
    protected $primaryKey     = 'id';
    /* protected $returnType     = User::class; */
    /* protected $useSoftDeletes = true; */
    protected $allowedFields  = [
        
        'harga_denda',
        'tgl_tetap',
        'status',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
}
