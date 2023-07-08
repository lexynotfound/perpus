<?php

namespace App\Controllers;

class User extends BaseController
{

    protected $db, $builder;
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->builder = $this->db->table(('users'));
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard | Sistem Informasi Perpustakaan',

        ];


        $this->builder->select('users.id as userid, username,anggota, email, nama, nama, foto, anggota, jenkel, telepon, alamat,');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        /* $this->builder->join('tbl_buku', 'tbl_buku.id = users.id'); */
        $query = $this->builder->get();

        $data['users'] = $query->getResult();



        return view('admin/index', $data);
    }

    public function data()
    {
        $data = [
            'title' => 'Data User | Sistem Informasi Perpustakaan',

        ];


        $this->builder->select('users.id as userid, username,anggota, email, nama, foto, jenkel, telepon, active, alamat');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        //select tabel buku

        $query = $this->builder->get();

        $data['users'] = $query->getResult();



        return view('admin/data', $data);
    }

    public function profile($id)
    {
        $data = [
            'title' => 'Profile | Sistem Informasi Perpustakaan',

        ];


        $this->builder->select('users.id as userid, username, anggota, email, nama, foto, jenkel, telepon, alamat, name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id',$id);


        $query = $this->builder->get();

        $data['user'] = $query->getResult();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }

        return view('admin/profile', $data);
    }

    public function detail($id = 0)
    {
        $data = [
            'title' => 'Halaman Admin',

        ];


        $this->builder->select('users.id as userid, username, email, name, nama, foto, jenkel, telepon, alamat');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id', $id);
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }


        return view('admin/detail', $data);
    }

    public function tambah()
    {
        $data = [
            'title' => 'Halaman Admin',

        ];


        $this->builder->select('users.id as userid, username, email, nama, foto, jenkel, telepon, alamat');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $this->builder->where('users.id');
        $query = $this->builder->get();

        $data['users'] = $query->getResult();

        if (empty($data['user'])) {
            return redirect()->to('/admin');
        }


        return view('admin/tambah', $data);
    }
}
