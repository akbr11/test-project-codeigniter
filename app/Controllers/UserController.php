<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in') != true && session()->get('role') != 'Admin') {
            session()->setFlashdata('msg_error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/');
        }
        $data['uri'] = \current_url(true);
        return view("User/user", $data);
    }

    function datatable_user()
    {
        $draw           = isset($_POST["draw"]) ? $_POST["draw"] : 1;
        $start          = isset($_POST["start"]) ? $_POST["start"] : 0;
        $length         = isset($_POST["length"]) ? $_POST["length"] : 10;
        $search_value   = isset($_POST["search"]["value"]) ? $_POST["search"]["value"] : NULL;
        $order_column   = isset($_POST["order"][0]["columns"]) ? $_POST["order"][0]["columns"] : 0;
        $order_dir      = isset($_POST["order"][0]["dir"]) ? $_POST["order"][0]["dir"] : "asc";
        $columns        = $_POST["columns"];

        $um = new UserModel();
        $data = $um->datatable($columns, $start, $length, $order_column, $order_dir, $search_value);
        $total = ($search_value != NULL) ? sizeof($data) : $um->datatable_total();
        $json_data = array(
            "draw"            => intval($draw),
            "recordsTotal"    => $total,
            "recordsFiltered" => $total,
            "data"            => $data
        );
        return $this->response->setStatusCode(200)->setJSON($json_data);
    }

    public function tambah_user()
    {
        if (session()->get('logged_in') != true) {
            session()->setFlashdata('msg_error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/');
        }
        $data['uri'] = \current_url(true);
        return view("User/tambah_user", $data);
    }

    public function proses_tambah_user()
    {
        $um = new UserModel();
        $nama_lengkap = $this->request->getVar('namaLengkap');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $role = $this->request->getVar('role');
        $status_akun = $this->request->getVar('statusAkun');
        $validation = \Config\Services::validation();
        $rules = [
            'namaLengkap' => [
                'label' => 'namaLengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi',
                ]
            ],
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
            ],
            'role' => [
                'label' => 'role',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus diisi'
                ]
            ],
            'statusAkun' => [
                'label' => 'statusAkun',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Akun harus diisi'
                ]
            ]
        ];
        $validation->setRules($rules);
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('User/tambah_user', $data);
        }
        try {
            $um->insert([
                'namaLengkap' => $nama_lengkap,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'statusAkun' => $status_akun
            ]);
            session()->setFlashdata('msg_success', 'Data berhasil ditambahkan');
            return redirect()->to('/dashboard-user');
        } catch (\Exception $e) {
            session()->setFlashdata('msg_error', 'Data gagal ditambahkan');
            return redirect()->to('/tambah-user');
        }
    }

    public function edit_user($idUser = NULL)
    {
        if (session()->get('logged_in') != true) {
            session()->setFlashdata('msg_error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/');
        }
        $um = new UserModel();
        $data['uri'] = \current_url(true);
        $data['user'] = $um->find($idUser);
        return view("User/edit_user", $data);
    }

    public function proses_edit_user($idUser = NULL)
    {
        $um = new UserModel();
        $nama_lengkap = $this->request->getVar('namaLengkap');
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $role = $this->request->getVar('role');
        $status_akun = $this->request->getVar('statusAkun');
        $validation = \Config\Services::validation();
        $rules = [
            'namaLengkap' => [
                'label' => 'namaLengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi',
                ]
            ],
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
            ],
            'role' => [
                'label' => 'role',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Role harus diisi'
                ]
            ],
            'statusAkun' => [
                'label' => 'statusAkun',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Status Akun harus diisi'
                ]
            ]
        ];
        $validation->setRules($rules);
        if (!$this->validate($rules)) {
            $data['validation'] = $this->validator;
            return view('User/tambah_user', $data);
        }
        try {
            $um->update($idUser, [
                'namaLengkap' => $nama_lengkap,
                'email' => $email,
                'password' => $password,
                'role' => $role,
                'statusAkun' => $status_akun
            ]);
            session()->setFlashdata('msg_success', 'Data berhasil diedit');
            return redirect()->to('/dashboard-user');
        } catch (\Exception $e) {
            session()->setFlashdata('msg_error', 'Data gagal diedit');
            return redirect()->to('/edit-user/' . $idUser);
        }
    }

    public function detail_user($idUser = NULL)
    {
        if (session()->get('logged_in') != true) {
            session()->setFlashdata('msg_error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/');
        }
        $um = new UserModel();
        $data['uri'] = \current_url(true);
        $data['user'] = $um->find($idUser);
        return view("User/detail_user", $data);
    }

    public function delete_user($idUser = NULL)
    {
        if (session()->get('logged_in') != true) {
            session()->setFlashdata('msg_error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/');
        }
        $um = new UserModel();
        try {
            $um->delete($idUser);
            return $this->response->setJSON(["status" => true, "message" => "Dokumen berhasil dihapus."]);
        } catch (\Exception $e) {
            return $this->response->setJSON(["status" => false, "message" => "Dokumen gagal dihapus."]);
        }
    }
}
