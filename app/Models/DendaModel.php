<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class DendaModel extends Model
{
    protected $table          = 'tbl_denda';
    protected $primaryKey     = 'id';
    /* protected $returnType     = User::class; */
    /* protected $useSoftDeletes = true; */
    protected $allowedFields  = [
        'id_denda', 'pinjam_id', 'user_id',	'denda', 'status_denda', 'biaya_id', 'status',	'lama_waktu',	'tgl_denda',	'created_at',	'updated_at',	'deleted_at',	
    ];

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
}
