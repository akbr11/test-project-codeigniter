<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class PegawaiController extends BaseController
{
    public function index()
    {
        if (session()->get('logged_in') != true && session()->get('role') != 'Pegawai') {
            session()->setFlashdata('msg_error', 'Silahkan login terlebih dahulu');
            return redirect()->to('/');
        }
        $um = new UserModel();
        $data['uri'] = \current_url(true);
        $data['pegawai'] = $um->search(['idUser' => session()->get('idUser')]);
        return view("Pegawai/pegawai", $data);
    }

    public function proses_edit_pegawai($idUser = NULL)
    {
        $um = new UserModel();
        $nama_lengkap = $this->request->getVar('namaLengkap');
        $password = $this->request->getVar('password');
        $foto_profil = $this->request->getFile('fotoProfil');
        $data_pegawai = [];
        $validation = \Config\Services::validation();
        $cari_pegawai = $um->search(['idUser' => $idUser]);
        $rules = [
            'fotoProfil' => [
                'label' => 'fotoProfil',
                'rules' => 'max_size[fotoProfil, 300]|is_image[fotoProfil]|mime_in[fotoProfil, image/jpg,image/jpeg]',
                'errors' => [
                    'is_image' => 'File yang diunggah bukan gambar.',
                    'mime_in' => 'File yang diunggah bukan gambar dengan format JPG/JPEG.',
                    'max_size' => 'Ukuran file melebihi 300 KB.'
                ]
            ],
        ];
        $validation->setRules($rules);
        if (!$this->validate($rules)) {
            session()->setFlashdata('msg_error', $validation->listErrors());
            return redirect()->to('/pegawai');
        }
        if ($foto_profil != NULL && $foto_profil->isValid() && !$foto_profil->hasMoved()) {
            if (file_exists('uploads/' . $cari_pegawai[0]->fotoProfil)) {
                unlink('uploads/' . $cari_pegawai[0]->fotoProfil);
            }
            $nama_foto = "pegawai_" . date('YmdHis') . ".jpg";
            $foto_profil->move('uploads/', $nama_foto);
            $data_pegawai = [
                'fotoProfil' => $nama_foto,
                'namaLengkap' => $nama_lengkap,
                'password' => $password,
            ];
        } else {
            $data_pegawai = [
                'namaLengkap' => $nama_lengkap,
                'password' => $password,
            ];
        }
        $result = $um->update($idUser, $data_pegawai);
        if (!$result) {
            session()->setFlashdata('msg_error', 'Data gagal diedit');
            return redirect()->to('/edit-user/' . $idUser);
        } else {
            session()->setFlashdata('msg_success', 'Data berhasil diedit');
            return redirect()->to('/pegawai');
        }
    }
}
