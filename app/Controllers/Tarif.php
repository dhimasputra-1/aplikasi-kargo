<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTarif;
use App\Models\ModelKota;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;

class Tarif extends BaseController
{
    public function index()
    {
        $title = [
            'title' => 'Kelola Tarif'
        ];
        return view('tarif/datatarif', $title);
    }

    public function view()
    {
        $db = db_connect();
        $tarif = $db->table('tarif')
            ->select('idtarif, namatarif, kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan, tarif, layanan, estimasi')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left');

        return DataTable::of($tarif)
            ->edit('tarif', function ($row) {
                return "Rp " . number_format($row->tarif, 0, ',', '.');
            })
            ->edit('estimasi', function ($row) {
                return $row->estimasi . " hari";
            })
            ->add('action', function ($row) {
                $button2 = '<button type="button" class="btn btn-secondary btn-sm btn-edit" data-idtarif="' . $row->idtarif . '" style="margin-left: 5px;"><i class="fas fa-pencil-alt"></i></button>';
                $button3 = '<button type="button" class="btn btn-danger btn-sm btn-delete" data-idtarif="' . $row->idtarif . '" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                $button4 = '<button type="button" class="btn btn-info btn-sm btn-detail" data-idtarif="' . $row->idtarif . '" style="margin-left: 5px;"><i class="fas fa-eye"></i></button>';
                $buttonsGroup = '<div style="display: flex;">' . $button2 . $button3 . $button4 . '</div>';
                return $buttonsGroup;
            }, 'last')
            ->addNumbering()
            ->hide('idtarif')
            ->toJson();
    }

    public function formtambah()
    {
        $title = [
            'title' => 'Tambah Data Tarif'
        ];
        $db = db_connect();
        $kota = $db->table('kota')->get()->getResult();
        $data = [
            'title' => 'Tambah Data Tarif',
            'kota' => $kota,
        ];
        return view('tarif/formtambah', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $namatarif = $this->request->getPost('namatarif');
            $idkotaasal = $this->request->getPost('idkotaasal');
            $idkotatujuan = $this->request->getPost('idkotatujuan');
            $tarif = $this->request->getPost('tarif');
            $layanan = $this->request->getPost('layanan');
            $estimasi = $this->request->getPost('estimasi');

            $rules = [
                'namatarif' => [
                    'label' => 'Nama Tarif',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'idkotaasal' => [
                    'label' => 'Kota Asal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'idkotatujuan' => [
                    'label' => 'Kota Tujuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tarif' => [
                    'label' => 'Tarif',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka'
                    ]
                ],
                'layanan' => [
                    'label' => 'Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'estimasi' => [
                    'label' => 'Estimasi',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka'
                    ]
                ]
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
                $model = new ModelTarif();
                $model->insert([
                    'namatarif' => $namatarif,
                    'idkotaasal' => $idkotaasal,
                    'idkotatujuan' => $idkotatujuan,
                    'tarif' => $tarif,
                    'layanan' => $layanan,
                    'estimasi' => $estimasi
                ]);

                $json = [
                    'sukses' => 'Data Tarif Berhasil Disimpan'
                ];
            }
            echo json_encode($json);
        }
    }

    public function delete()
    {
        if ($this->request->isAJAX()) {
            $idtarif = $this->request->getPost('idtarif');

            $model = new ModelTarif();
            $model->where('idtarif', $idtarif)->delete();

            $json = [
                'sukses' => 'Data Tarif Berhasil Dihapus'
            ];

            return $this->response->setJSON($json);
        }
    }

    public function formedit($idtarif)
    {
        $model = new ModelTarif();
        $tarif = $model->where('idtarif', $idtarif)->first();
        $db = db_connect();
        $kota = $db->table('kota')->get()->getResult();

        if (!$tarif) {
            return redirect()->back()->with('error', 'Data Tarif tidak ditemukan');
        }

        $data = [
            'tarif' => $tarif,
            'kota' => $kota,
        ];

        return view('tarif/formedit', $data);
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idtarif = $this->request->getPost('idtarif');
            $namatarif = $this->request->getPost('namatarif');
            $idkotaasal = $this->request->getPost('idkotaasal');
            $idkotatujuan = $this->request->getPost('idkotatujuan');
            $tarif = $this->request->getPost('tarif');
            $layanan = $this->request->getPost('layanan');
            $estimasi = $this->request->getPost('estimasi');

            $rules = [
                'namatarif' => [
                    'label' => 'Nama Tarif',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'idkotaasal' => [
                    'label' => 'Kota Asal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'idkotatujuan' => [
                    'label' => 'Kota Tujuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'tarif' => [
                    'label' => 'Tarif',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka'
                    ]
                ],
                'layanan' => [
                    'label' => 'Layanan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'estimasi' => [
                    'label' => 'Estimasi',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka'
                    ]
                ]
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
                $model = new ModelTarif();

                $model->set([
                    'namatarif' => $namatarif,
                    'idkotaasal' => $idkotaasal,
                    'idkotatujuan' => $idkotatujuan,
                    'tarif' => $tarif,
                    'layanan' => $layanan,
                    'estimasi' => $estimasi,
                ])->where('idtarif', $idtarif)->update();

                $json = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            return $this->response->setJSON($json);
        }
    }
    public function detail($idtarif)
    {
        $model = new ModelTarif();
        $tarif = $model->where('idtarif', $idtarif)->first();

        if (!$tarif) {
            return 'Data tarif tidak ditemukan';
        }

        return view('tarif/detail', ['tarif' => $tarif]);
    }
}
