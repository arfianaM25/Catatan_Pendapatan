<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username', 'password', 'role', 'status_akun', 'last_login', 'id_opd', 'role_opd'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
}