<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PendapatanModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function index()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.*, opd.nama as nama_opd');
        $builder->join('opd', 'opd.id = users.id_opd', 'left');
        $query = $builder->get();
        $users = $query->getResult();

        return view('user/index', ['users' => $users]);
    }
    public function register()
    {
        helper(['form']);

        // Jika sudah login, redirect ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|min_length[3]|is_unique[users.username]',
                'password' => 'required|min_length[6]'
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', 'Username harus unik dan password minimal 6 karakter.');
            }

            $userModel = new UserModel();
            $userData = [
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => 'bendahara', // Default role
                'status_akun' => 'Aktif'
            ];

            if ($userModel->insert($userData)) {
                // Tambahkan data pendapatan default untuk pengguna baru
                $pendapatanModel = new PendapatanModel();
                $pendapatanModel->insert([
                    'user_id' => $userModel->insertID(),
                    'jumlah' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                return redirect()->to('/login')->with('success', 'Registrasi berhasil! Silakan login.');
            } else {
                return redirect()->back()->with('error', 'Gagal mendaftar.');
            }
        }

        return view('auth/register');
    }

    public function login()
    {
        helper(['form']);

        // Jika user sudah login, arahkan ke dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/login');
    }

    public function process()
    {
        $rules = [
            'username' => 'required',
            'password' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                if (strtolower($user['status_akun']) !== 'aktif') {
                    return redirect()->back()->with('error', 'Akun Anda tidak aktif.');
                }

                session()->set([
                    'user_id'    => $user['id'],
                    'username'   => $user['username'],
                    'role'       => $user['role'],
                    'role_opd' => $user['role_opd'],
                    'id_opd' => $user['id_opd'],
                    'last_login' => date('Y-m-d H:i:s'),
                    'isLoggedIn' => true
                ]);

                $userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);

                // Jika user adalah admin, arahkan ke pendapatan
                if (strtolower($user['role']) === 'admin') {
                    return redirect()->to('/pendapatan/index')->with('success', 'Selamat datang di halaman pendapatan.');
                }

                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->withInput()->with('error', 'Password salah.');
            }
        } else {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan.');
        }
    }

    public function logout()
    {
        session()->destroy(); // Hapus semua session
        return redirect()->to('/login'); // Arahkan ke halaman login
    }
}