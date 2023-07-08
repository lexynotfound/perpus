<?php

namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Entities\User;

class BukuModel extends Model
{
    //protected itu berfungsi untuk menjaga atau melindungi agar tidak terexpos
    // protected $table untuk melindungi sebuah table di dalam database 
    protected $table          = 'tbl_buku';
    protected $primaryKey     = 'id';
   /*  protected $returnType     = User::class; */
    /*  usesSoftDeletes berfungsi untuk menghapus 
    secara lunak ketika melakukan penghapusan data 
    dan itu masih tersimpan di dalam database dan 
    ini berfungsi untuk melakukan pencatatan atau laporan di dalam tbl_laporan */
    protected $useSoftDeletes = true;
    // AllowedFields berfungsi untuk melakukan perijinan agar bisa melakukan sebuah perubahan di dalam data tersebut
    protected $allowedFields  = [
        'id_buku',
        'kategori_id',
        'rak_id',
        'sampul',
        'isbn',
        'title',
        'penerbit',
        'pengarang',
        'thn_buku',
        'jml',
        'tgl_masuk',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    //protected $useTimestamps ini berfungsi untuk melindungi format tanggal-bulan-tahun
    protected $useTimestamps  = true;
    protected $createdField   = 'tgl_masuk';
    protected $updatedField   = 'updated_at';
    protected $deletedField   = 'deleted_at';
}
