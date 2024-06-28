<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        return view("login");
    }

    public function proses_masuk()
    {
        $um = new UserModel();
        $validation = \Config\Services::validation();
        $rules = [
            'email' => [
                'label' => 'email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email harus diisi',
                ]
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kata Sandi harus diisi'
                ]
            ]
        ];
        $validation->setRules($rules);
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('/login', $data);
        }
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $search_email = $um->search(['email' => $email]);
        try {
            if (sizeof($search_email) !== 1) {
                session()->setFlashdata('msg_error', 'Email tidak terdaftar');
                return redirect()->to('/');
            }
            if ($password !== $search_email[0]->password) {
                session()->setFlashdata('msg_error', 'Password Salah');
                return redirect()->to('/');
            }
            session()->set([
                'idUser' => $search_email[0]->idUser,
                'namaLengkap' => $search_email[0]->namaLengkap,
                'email' => $search_email[0]->email,
                'password' => $search_email[0]->password,
                'role' => $search_email[0]->role,
                'fotoProfil' => $search_email[0]->fotoProfil,
                'statusAkun' => $search_email[0]->statusAkun,
                'logged_in' => true
            ]);
            if (session()->get('role') == 'Admin') {
                return redirect()->to('/dashboard-user');
            } else if (session()->get('role') == 'Pegawai') {
                return redirect()->to('/pegawai');
            }
        } catch (\Throwable $th) {
            session()->setFlashdata('msg_error', 'Terjadi kendala saat parsing data.');
            return redirect()->to('/');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
