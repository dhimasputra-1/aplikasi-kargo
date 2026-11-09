<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengiriman;
use CodeIgniter\HTTP\ResponseInterface;
use Hermawan\DataTables\DataTable;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Label\Alignment\LabelAlignment;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use App\Libraries\QRCodeGenerator;
use Endroid\QrCode\QrCode;



class Pengiriman extends BaseController
{

    public function Detail($noresi = null)
    {
        $db = db_connect();
        $pengirimanQuery = $db
            ->table('pengiriman')
            ->select('
                pengiriman.noresi,
                konsumen.nama, 
                pengiriman.tgl, 
                pengiriman.namapenerima, 
                pengiriman.alamatpenerima, 
                pengiriman.nohppenerima, 
                pengiriman.berat, 
                pengiriman.totalbiaya,
                pengiriman.status,
                tarif.namatarif,
                kotaasal.namakota as kota_asal,
                kotatujuan.namakota as kota_tujuan,
                tarif.layanan,
                tarif.estimasi
            ')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan')
            ->where('noresi', $noresi);

        $pengiriman = $pengirimanQuery->get();
        $pengirimanData = $pengiriman->getRow();

        if (!$pengirimanData) {
            return redirect()->back();
        }

        // Generate QR Code hanya dengan noresi
        $qrCode = QrCode::create($noresi)
            ->setSize(300)
            ->setMargin(10);

        $writer = new PngWriter();
        $qrCodeImage = $writer->write($qrCode)->getDataUri();

        // Format status pengiriman
        $statusText = '';
        switch ($pengirimanData->status) {
            case 1:
                $statusText = 'Proses Pengiriman';
                break;
            case 2:
                $statusText = 'Paket Sampai Tujuan';
                break;
            case 3:
                $statusText = 'Sudah Diterima';
                break;
        }

        // Format data untuk view
        $data = [
            'title' => 'Detail Pengiriman',
            'pengiriman' => [
                'noresi' => $pengirimanData->noresi,
                'tanggal' => date('d-m-Y', strtotime($pengirimanData->tgl)),
                'pengirim' => [
                    'nama' => $pengirimanData->nama,
                ],
                'penerima' => [
                    'nama' => $pengirimanData->namapenerima,
                    'alamat' => $pengirimanData->alamatpenerima,
                    'nohp' => $pengirimanData->nohppenerima
                ],
                'pengiriman' => [
                    'layanan' => $pengirimanData->layanan,
                    'kota_asal' => $pengirimanData->kota_asal,
                    'kota_tujuan' => $pengirimanData->kota_tujuan,
                    'berat' => $pengirimanData->berat . ' Kg',
                    'estimasi' => $pengirimanData->estimasi . ' Hari',
                    'total' => 'Rp ' . number_format($pengirimanData->totalbiaya, 0, ',', '.'),
                    'status' => $statusText
                ]
            ],
            'qrCode' => $qrCodeImage
        ];

        return view('pengiriman/detail', $data);
    }



    public function index()
    {
        $title = [
            'title' => 'PENGIRIMAN'
        ];
        return view('pengiriman/datapengiriman', $title);
    }

    public function view()
    {
        if ($this->request->isAJAX()) {
            $db = db_connect();
            $produk = $db->table('pengiriman')
                ->select('pengiriman.noresi, konsumen.nama, pengiriman.tgl, pengiriman.namapenerima, pengiriman.alamatpenerima, pengiriman.nohppenerima, pengiriman.berat, pengiriman.totalbiaya,pengiriman.status')
                ->join('tarif', 'tarif.idtarif = pengiriman.idtarif')
                ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
                ->groupBy('noresi');
            return DataTable::of($produk)
                ->add('action', function ($row) {
                    $button1 = '<button type="button" class="btn btn-primary btn-sm btn-detail" data-noresi="' . $row->noresi . '" ><i class="fas fa-eye"></i></button>';
                    $buttonsGroup = '<div style="display: flex;">' . $button1;
                    if ($row->status != 3) {
                        $button2 = '<button type="button" class="btn btn-warning btn-sm btn-status" data-noresi="' . $row->noresi . '" style="margin-left: 5px;"><i class="fas fa-sync-alt"></i></button>';
                        $button3 = '<button type="button" class="btn btn-secondary btn-sm btn-edit" data-noresi="' . $row->noresi . '" style="margin-left: 5px;"><i class="fas fa-pencil-alt"></i></button>';
                        $button4 = '<button type="button" class="btn btn-danger btn-sm btn-delete" data-noresi="' . $row->noresi . '" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                        $buttonsGroup .= $button2 . $button3 . $button4;
                    }
                    $buttonsGroup .= '</div>';
                    return $buttonsGroup;
                }, 'last')
                ->addNumbering()

                ->edit('status', function ($row) {
                    if ($row->status == '1') {
                        return '<span class="badge bg-warning">Proses Pengiriman</span>';
                    } else if ($row->status == '2') {
                        return '<span class="badge bg-primary">Paket Sampai Tujuan</span>';
                    } else if ($row->status == '3') {
                        return '<span class="badge bg-success">Sudah Di Terima</span>';
                    }
                })
                ->edit('totalbiaya', function ($row) {
                    return 'Rp ' . number_format($row->totalbiaya, 0, ',', '.');
                })
                ->edit('berat', function ($row) {
                    return $row->berat . ' KG';
                })
                ->toJson();
        }
    }

    public function formtambah()
    {
        $db = db_connect();
        $tanggal = date('Ymd'); // Format tanggal menjadi YYYYMMDD
        $randomNumber = mt_rand(100, 999); // Generate 3 angka acak
        $kode_otomatis = 'KRG-' . $tanggal . '-' . $randomNumber; // Format kode menjadi KAR-YYYYMMDD-RRR   
        $tarif = $db->table('tarif')->get()->getResultArray();
        $data = [
            'title' => 'Tambah Pengiriman',
            'noresi' => $kode_otomatis,
            'tarif' => $tarif,
        ];
        return view('pengiriman/formtambah', $data);
    }

    public function getKonsumen()
    {

        return view('pengiriman/getkonsumen');
    }

    public function viewGetKonsumen()
    {
        if ($this->request->isAJAX()) {
            $db = db_connect();
            $konsumen = $db->table('konsumen')
                ->select('idkonsumen, nama, alamat, nohp');
            return DataTable::of($konsumen)
                ->add('action', function ($row) {
                    $button1 = '<button type="button" class="btn btn-primary btn-pilihkonsumen"  data-idkonsumen="' . $row->idkonsumen . '" data-nama="' . esc($row->nama) . '" data-nohp="' . $row->nohp . '">
                                Pilih
                            </button>';
                    return $button1;
                }, 'last')
                ->addNumbering()
                ->hide('idkonsumen')
                ->toJson();
        }
    }


    public function getTarif()
    {

        return view('pengiriman/gettarif');
    }

    public function viewGetTarif()
    {
        if ($this->request->isAJAX()) {
            $db = db_connect();
            $tarif = $db->table('tarif')
                ->select('idtarif, namatarif, kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan, tarif, layanan, estimasi')
                ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
                ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left');
            return DataTable::of($tarif)
                ->add('action', function ($row) {
                    $button1 = '<button type="button" class="btn btn-primary btn-pilihtarif"  data-idtarif="' . $row->idtarif . '" data-namatarif="' . esc($row->namatarif) . '" data-kotaasal="' . $row->kota_asal . '" data-kotatujuan="' . $row->kota_tujuan . '" data-tarif="' . $row->tarif . '" data-layanan="' . $row->layanan . '" data-estimasi="' . $row->estimasi . '">
                                Pilih
                            </button>';
                    return $button1;
                }, 'last')
                ->addNumbering()
                ->hide('idtarif')
                ->toJson();
        }
    }
    public function save()
    {
        if ($this->request->isAJAX()) {
            $noresi = $this->request->getPost('noresi');
            $tgl = $this->request->getPost('tgl');
            $idkonsumen = $this->request->getPost('idkonsumen');
            $namapenerima = $this->request->getPost('namapenerima');
            $nohppenerima = $this->request->getPost('nohppenerima');
            $alamatpenerima = $this->request->getPost('alamatpenerima');
            $idtarif = $this->request->getPost('idtarif');
            $berat = $this->request->getPost('berat');
            $totalbiaya = $this->request->getPost('totalbiaya');

            $rules = [
                'idkonsumen' => [
                    'label' => 'Nama Pengirim',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'namapenerima' => [
                    'label' => 'Nama Penerima',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'nohppenerima' => [
                    'label' => 'No HP Penerima',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'alamatpenerima' => [
                    'label' => 'Alamat Penerima',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'idtarif' => [
                    'label' => 'Tarif',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'berat' => [
                    'label' => 'Berat',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka',
                        'greater_than' => '{field} harus lebih besar dari 0'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $errors = [];
                foreach ($rules as $field => $rule) {
                    $errors["error_$field"] = $this->validator->getError($field);
                }
                return $this->response->setJSON(['error' => $errors]);
            }

            $model = new ModelPengiriman();
            $model->insert([
                'noresi' => $noresi,
                'tgl' => $tgl,
                'idkonsumen' => $idkonsumen,
                'namapenerima' => $namapenerima,
                'nohppenerima' => $nohppenerima,
                'alamatpenerima' => $alamatpenerima,
                'idtarif' => $idtarif,
                'berat' => $berat,
                'totalbiaya' => $totalbiaya,
                'status' => 1 // Status awal pengiriman
            ]);

            return $this->response->setJSON([
                'sukses' => 'Data pengiriman berhasil disimpan'
            ]);
        }
    }
    public function delete()
    {
        if ($this->request->isAJAX()) {
            $noresi = $this->request->getPost('noresi');
            $model = new ModelPengiriman();
            $model->where('noresi', $noresi)->delete();
            $json = [
                'sukses' => 'Data Pengiriman Berhasil Dihapus'
            ];

            return $this->response->setJSON($json);
        }
    }



    public function formedit($noresi)
    {
        $db = db_connect();
        $model = new ModelPengiriman();

        // Ambil data pengiriman beserta relasinya
        $pengiriman = $db->table('pengiriman')
            ->select('
                pengiriman.*,
                konsumen.nama as nama_pengirim,
                konsumen.nohp as nohp_pengirim,
                tarif.namatarif,
                kotaasal.namakota as kota_asal,
                kotatujuan.namakota as kota_tujuan,
                tarif.layanan,
                tarif.estimasi,
                tarif.tarif as biaya_tarif
            ')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan')
            ->where('noresi', $noresi)
            ->get()
            ->getRowArray();

        if (!$pengiriman) {
            return redirect()->back()->with('error', 'Data Pengiriman tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Pengiriman',
            'noresi' => $noresi,
            'pengiriman' => $pengiriman
        ];

        return view('pengiriman/formedit', $data);
    }


    public function updatedata()
    {
        if ($this->request->isAJAX()) {
            $noresi = $this->request->getPost('noresi');
            $tgl = $this->request->getPost('tgl');
            $idkonsumen = $this->request->getPost('idkonsumen');
            $namapenerima = $this->request->getPost('namapenerima');
            $nohppenerima = $this->request->getPost('nohppenerima');
            $alamatpenerima = $this->request->getPost('alamatpenerima');
            $idtarif = $this->request->getPost('idtarif');
            $berat = $this->request->getPost('berat');
            $totalbiaya = $this->request->getPost('totalbiaya');

            $rules = [
                'idkonsumen' => [
                    'label' => 'Nama Pengirim',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'namapenerima' => [
                    'label' => 'Nama Penerima',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'nohppenerima' => [
                    'label' => 'No HP Penerima',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'alamatpenerima' => [
                    'label' => 'Alamat Penerima',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'idtarif' => [
                    'label' => 'Tarif',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'berat' => [
                    'label' => 'Berat',
                    'rules' => 'required|numeric|greater_than[0]',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                        'numeric' => '{field} harus berupa angka',
                        'greater_than' => '{field} harus lebih besar dari 0'
                    ]
                ]
            ];

            if (!$this->validate($rules)) {
                $errors = [];
                foreach ($rules as $field => $rule) {
                    $errors["error_$field"] = $this->validator->getError($field);
                }
                return $this->response->setJSON(['error' => $errors]);
            }

            $model = new ModelPengiriman();

            // Ubah dari insert menjadi update
            $model->where('noresi', $noresi)->set([
                'tgl' => $tgl,
                'idkonsumen' => $idkonsumen,
                'namapenerima' => $namapenerima,
                'nohppenerima' => $nohppenerima,
                'alamatpenerima' => $alamatpenerima,
                'idtarif' => $idtarif,
                'berat' => $berat,
                'totalbiaya' => $totalbiaya
            ])->update();

            return $this->response->setJSON([
                'sukses' => 'Data pengiriman berhasil diupdate'
            ]);
        }
    }

    public function ubahstatus()
    {
        if ($this->request->isAJAX()) {
            $noresi = $this->request->getPost('noresi');

            $model = new ModelPengiriman();
            $pengiriman = $model->where('noresi', $noresi)->first();

            if ($pengiriman) {
                $statusBaru = ($pengiriman['status'] == 1) ? 2 : (($pengiriman['status'] == 2) ? 3 : (($pengiriman['status'] == 3) ? 1 : $pengiriman['status']));

                $model->update($noresi, ['status' => $statusBaru]);

                $json = [
                    'sukses' => 'Status Pengiriman berhasil diubah'
                ];
            } else {
                $json = [
                    'error' => 'Data Pengiriman tidak ditemukan'
                ];
            }

            return $this->response->setJSON($json);
        }
    }
}
