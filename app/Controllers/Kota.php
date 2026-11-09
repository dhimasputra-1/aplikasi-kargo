<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKota;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class Kota extends BaseController
{
    public function index()
    {
        $title = [
            'title' => 'Kelola Data Kota'
        ];
        return view('kota/datakota', $title);
    }

    public function view()
    {
        $db = db_connect();
        $kota = $db->table('kota')->select('idkota,namakota,alamat,notelp');
        return DataTable::of($kota)
            ->add('action', function ($row) {
                $button2 = '<button type="button" class="btn btn-secondary btn-sm btn-edit" data-idkota="' . $row->idkota . '" style="margin-left: 5px;"><i class="fas fa-pencil-alt"></i></button>';
                $button3 = '<button type="button" class="btn btn-danger btn-sm btn-delete" data-idkota="' . $row->idkota . '" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                $button4 = '<button type="button" class="btn btn-info btn-sm btn-detail" data-idkota="' . $row->idkota . '" style="margin-left: 5px;"><i class="fas fa-eye"></i></button>';
                $buttonsGroup = '<div style="display: flex;">' . $button2 . $button3 . $button4 . '</div>';
                return $buttonsGroup;
            }, 'last')
            ->addNumbering()
            ->hide('idkota')
            ->toJson();
    }

    public function formtambah()
    {
        $title = [
            'title' => 'Tambah Data Kota'
        ];
        return view('kota/formtambah', $title);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $idkota = $this->request->getPost('idkota');
            $namakota = $this->request->getPost('namakota');
            $alamat = $this->request->getPost('alamat');
            $notelp = $this->request->getPost('notelp');

            $rules = [
                'namakota' => [
                    'label' => 'Nama Kota',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $errors = [];
                foreach ($rules as $field => $rule) {
                    $errors["error_$field"] = $this->validator->getError($field);
                }

                $json = [
                    'error' => $errors
                ];
            } else {

                $model = new ModelKota();
                $model->insert([
                    'namakota' => $namakota,
                    'alamat' => $alamat,
                    'notelp' => $notelp,
                ]);

                $json = [
                    'sukses' => 'Berhasil Simpan Data'
                ];
            }
            echo json_encode($json);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $idkota = $this->request->getPost('idkota');

            $model = new ModelKota();
            $model->where('idkota', $idkota)->delete();

            $json = [
                'sukses' => 'Data Kota Berhasil Dihapus'
            ];

            return $this->response->setJSON($json);
        }
    }

    public function formedit($idkota)
    {
        $model = new ModelKota();
        $kota = $model->where('idkota', $idkota)->first();

        if (!$kota) {
            return redirect()->back()->with('error', 'Data kota tidak ditemukan');
        }

        $data = [
            'kota' => $kota
        ];
        return view('kota/formedit', $data);
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idkota = $this->request->getPost('idkota');
            $namakota = $this->request->getPost('namakota');
            $alamat = $this->request->getPost('alamat');
            $notelp = $this->request->getPost('notelp');

            $rules = [
                'namakota' => [
                    'label' => 'Nama Kota',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
            ];

            if (!$this->validate($rules)) {
                $errors = [];
                foreach ($rules as $field => $rule) {
                    $errors["error_$field"] = $this->validator->getError($field);
                }

                $json = [
                    'error' => $errors
                ];
            } else {

                $model = new ModelKota();
                $model->update($idkota, [
                    'namakota' => $namakota,
                    'alamat' => $alamat,
                    'notelp' => $notelp,
                ]);

                $json = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            return $this->response->setJSON($json);
        }
    }
    public function detail($idkota)
    {
        $model = new ModelKota();
        $kota = $model->where('idkota', $idkota)->first();

        if (!$kota) {
            return 'Data kota tidak ditemukan';
        }

        return view('kota/detail', ['kota' => $kota]);
    }
}
