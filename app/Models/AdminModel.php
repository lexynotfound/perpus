<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class AdminModel extends Model
{
    protected $table          = 'users';
    protected $primaryKey     = 'id';
    protected $returnType     = User::class;
    /* protected $useSoftDeletes = true; */
    protected $allowedFields  = [
        'email', 'username', 'nama', 'anggota', 'tempat_lahir', 'foto', 'telepon', 'alamat', 'tgl_lahir', 'jenkel', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
        'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
    ];

    protected $useTimestamps  = true;
    protected $createdField   = 'created_at';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
}
