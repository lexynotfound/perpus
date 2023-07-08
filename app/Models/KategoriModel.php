<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'tbl_kategori';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_kategori', 'created_at', 'updated_at', 'deleted_at'];

    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
}
