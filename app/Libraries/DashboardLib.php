<?php

namespace App\Libraries;

use App\Models\UserModel;

class DashboardLib
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function getUserData($userId)
    {
        return $this->userModel->find($userId);
    }

    public function getDashboardStats()
    {
        // Tambahkan logika perhitungan statistik dashboard
        return [
            'total_users' => $this->userModel->countAll(),
        ];
    }
}