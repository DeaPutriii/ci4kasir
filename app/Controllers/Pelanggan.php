<?php

namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PelangganModel;

class Pelanggan extends BaseController
{
    protected $pelangganmodel; 

    public function __construct()  
    {
        $this->pelangganmodel = new PelangganModel();
    }

    public function index()
    {
        return view('data_pelanggan/v_pelanggan');
    }

    public function tampil_pelanggan()
    {
        $pelanggan = $this->pelangganmodel->findAll();

        return $this->response->setJSON([
            'status'    => 'success',
            'pelanggan' => $pelanggan
        ]);
    }

    public function simpan_pelanggan()
    {
        // $validation = \Config\Services::validation();

        // $validation->setRules([
        //     'nama_pelanggan'    => 'required',
        //     'alamat'            => 'required',
        //     'nomor_telepon'     => 'required'
        // ]);

        // if(!$validation->withRequest($this->request)->run()){
        //     return $this->response->setJSON([
        //         'status'        => 'error',
        //         'errors'        => $validation->getErrors(),
        //     ]);
        // } 

        $data = [
            'nama_pelanggan' => $this->request->getVar('nama_pelanggan'),
            'alamat' => $this->request->getVar('alamat'),
            'nomor_telepon' => $this->request->getVar('nomor_telepon'),
        ];

        $this->pelangganmodel->save($data);

        return $this->response->setJSON([ 
            'status'    => 'success',
            'message'   => 'Data produk berhasil disimpan',
        ]);
    }

    public function hapus_pelanggan($id)
    {
        $pelanggan = $this->pelangganmodel->find($id);
        if (!$pelanggan) {
            return $this->response->setJSON([
                'status'    => 'success',
                'message'   => 'Pelanggan berhasil dihapus',
            ]);
        }

        // Hapus pelanggan
        if ($this->pelangganmodel->delete($id)) {
            return $this->response->setJSON([
                'status'    => 'success',
                'message'   => 'Data pelanggan berhasil dihapus',
            ]);
        } else {
            return $this->response->setJSON([
                'status'    => 'serror',
                'message'   => 'Gagal menghapus data pelanggan',
            ]);
        }
    }

    public function detail($id) {
        $pelanggan = $this->pelangganmodel->find($id);

        if ($pelanggan) {
            return $this->response->setJSON(['status' => 'success', 'pelanggan' => $pelanggan]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data pelanggan tidak ditemukan']);
        }
    }

    public function updatePelanggan()
    {
        $id = $this->request->getVar('id_pelanggan');
        $data = [
            'nama_pelanggan'    => $this->request->getVar('nama_pelanggan'),
            'alamat'            => $this->request->getVar('alamat'),
            'nomor_telepon'     => $this->request->getVar('nomor_telepon'),
        ];

        if ($this->pelangganmodel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Data pelanggan berhasil diperbarui']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal memperbarui data pelanggan']);
        }
    }
}
