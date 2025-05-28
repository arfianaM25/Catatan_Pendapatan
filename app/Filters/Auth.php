<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Http\RequestInterface;
use CodeIgniter\Http\ResponseInterface;
use CodeIgniter\Services;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Cek apakah user sudah login
        $session = session();
        if (!$session->get('isLoggedIn')) {  // Pastikan sesi memiliki 'isLoggedIn'
            return redirect()->to('/login');  // Jika belum login, arahkan ke halaman login
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak ada tindakan setelah permintaan, tetap biarkan
    }
}
