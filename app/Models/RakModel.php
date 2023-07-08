<?php

namespace App\Models;

use CodeIgniter\Model;

class RakModel extends Model
{
    protected $table = 'tbl_rak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_rak', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
