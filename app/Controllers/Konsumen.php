<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Konsumen as ModelKonsumen;
use App\Models\Supplier as ModelSupplier;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;


class Konsumen extends BaseController
{
    public function index()
    {
        $title = [
            'title' => 'Kelola Data Pelanggan'
        ];
        return view('konsumen/datakonsumen', $title);
    }

    public function view()
    {
        $db = db_connect();
        $konsumen = $db->table('konsumen')->select('idkonsumen,nama,jenkel,alamat,nohp');
        return DataTable::of($konsumen)
            ->edit('jenkel', function ($row) {
                return ($row->jenkel == 'L') ? 'Laki-laki' : 'Perempuan';
            })
            ->add('action', function ($row) {
                $button1 = '<button type="button" class="btn btn-primary btn-sm btn-detail" data-idkonsumen="' . $row->idkonsumen . '" data-toggle="modal" data-target="#detailModal"><i class="fas fa-eye"></i></button>';
                $button2 = '<button type="button" class="btn btn-secondary btn-sm btn-edit" data-idkonsumen="' . $row->idkonsumen . '" style="margin-left: 5px;"><i class="fas fa-pencil-alt"></i></button>';
                $button3 = '<button type="button" class="btn btn-danger btn-sm btn-delete" data-idkonsumen="' . $row->idkonsumen . '" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                $buttonsGroup = '<div style="display: flex;">' . $button1 . $button2 . $button3 . '</div>';
                return $buttonsGroup;
            }, 'last')
            ->addNumbering()
            ->toJson();
    }

    public function formtambah()
    {
        $db = db_connect();
        $query = $db->query("SELECT CONCAT('P-', LPAD(IFNULL(MAX(SUBSTRING(idkonsumen, 5)) + 1, 1), 4, '0')) AS next_number FROM konsumen");
        $row = $query->getRow();
        $next_number = $row->next_number;

        $data = [
            'next_number' => $next_number
        ];
        return view('konsumen/formtambah', $data);
    }

    public function save()
    {
        if ($this->request->isAJAX()) {
            $idkonsumen = $this->request->getPost('idkonsumen');
            $nama = $this->request->getPost('nama');
            $jenkel = $this->request->getPost('jenkel');
            $alamat = $this->request->getPost('alamat');
            $nohp = $this->request->getPost('nohp');

            $rules = [
                'nama' => [
                    'label' => 'Nama Konsumen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'idkonsumen' => [
                    'label' => 'ID Konsumen',
                    'rules' => 'required|is_unique[konsumen.idkonsumen]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'is_unique' => '{field} sudah ada',
                    ]
                ],

                'jenkel' => [
                    'label' => 'Jenis Kelamin',
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
                'nohp' => [
                    'label' => 'No Handphone',
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


                $model = new ModelKonsumen();
                $model->insert([
                    'idkonsumen' => $idkonsumen,
                    'nama' => $nama,
                    'jenkel' => $jenkel,
                    'alamat' => $alamat,
                    'nohp' => $nohp,
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
            $idkonsumen = $this->request->getPost('idkonsumen');

            $modelsupplier = new ModelKonsumen();
            $modelsupplier->where('idkonsumen', $idkonsumen)->delete();

            $json = [
                'sukses' => 'Data konsumen Berhasil Dihapus'
            ];

            return $this->response->setJSON($json);
        }
    }

    public function formedit($idkonsumen)
    {
        $model = new ModelKonsumen();
        $konsumen = $model->where('idkonsumen', $idkonsumen)->first();

        if (!$konsumen) {
            return redirect()->back()->with('error', 'Data Konsumen tidak ditemukan');
        }

        $data = [
            'konsumen' => $konsumen
        ];

        return view('konsumen/formedit', $data);
    }

    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $idkonsumen = $this->request->getPost('idkonsumen');
            $nama = $this->request->getPost('nama');
            $jenkel = $this->request->getPost('jenkel');
            $alamat = $this->request->getPost('alamat');
            $nohp = $this->request->getPost('nohp');
            $rules = [
                'nama' => [
                    'label' => 'Nama Konsumen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],

                'jenkel' => [
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'alamat' => [
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ]
                ],
                'nohp' => [
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

                $model = new ModelKonsumen(); // Ganti dengan model yang sesuai

                $model->update($idkonsumen, [
                    'nama' => $nama,
                    'jenkel' => $jenkel,
                    'alamat' => $alamat,
                    'nohp' => $nohp,
                ]);

                $json = [
                    'sukses' => 'Data berhasil diupdate'
                ];
            }
            return $this->response->setJSON($json);
        }
    }

    public function detail($idkonsumen)
    {
        $model = new ModelKonsumen();
        $konsumen = $model->where('idkonsumen', $idkonsumen)->first();

        if (!$konsumen) {
            return 'Data karyawan tidak ditemukan';
        }

        return view('konsumen/detail', ['konsumen' => $konsumen]);
    }
}
