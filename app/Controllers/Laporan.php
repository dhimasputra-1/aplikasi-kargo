<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Orderselffoto;
use App\Models\Konsumen;
use App\Models\MotorModel;
use CodeIgniter\HTTP\ResponseInterface;

class Laporan extends BaseController
{
    public function index()
    {
        return view('laporan/index');
    }

    public function LaporanPelanggan()
    {
        $data['title'] = 'Laporan Pelanggan';
        return view('laporan/pelanggan', $data);
    }
    public function viewallLaporanPelanggan()
    {
        $db = db_connect();
        $user = $db
            ->table('konsumen')
            ->select('idkonsumen,nama,jenkel,alamat,nohp')
            ->getCompiledSelect();
        $pelanggan = $db->query($user)->getResultArray();
        $data = [
            'pelanggan' => $pelanggan,
        ];
        $response = [
            'data' => view('laporan/viewallnpelanggan', $data),
        ];

        echo json_encode($response);
    }

    public function LaporanKota()
    {
        $data['title'] = 'Laporan Kota';
        return view('laporan/kota/kota', $data);
    }

    public function viewallLaporanKota()
    {
        $db = db_connect();
        $user = $db
            ->table('kota')
            ->select('idkota,namakota,alamat,notelp')
            ->getCompiledSelect();
        $kota = $db->query($user)->getResultArray();
        $data = [
            'kota' => $kota,
        ];
        $response = [
            'data' => view('laporan/kota/viewallkota', $data),
        ];

        echo json_encode($response);
    }

    public function LaporanTarif()
    {
        $data['title'] = 'Laporan Tarif SI CARGO';
        return view('laporan/tarif/tarif', $data);
    }

    public function viewallLaporanTarif()
    {
        $db = db_connect();
        $tarif = $db->table('tarif')
            ->select('tarif.idtarif, tarif.namatarif, kotaasal.namakota as kota_asal, 
                     kotatujuan.namakota as kota_tujuan, tarif.tarif, tarif.layanan, 
                     tarif.estimasi')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left')
            ->get()
            ->getResultArray();

        $data = [
            'tarif' => $tarif,
        ];

        $response = [
            'data' => view('laporan/tarif/viewalltarif', $data),
        ];

        echo json_encode($response);
    }
    public function LaporanPengiriman()
    {
        $data['title'] = 'Laporan Pengiriman';
        return view('laporan/pengiriman/pengiriman', $data);
    }

    public function viewallLaporanPengiriman()
    {
        $db = db_connect();
        $query = $db->table('pengiriman')
            ->select('pengiriman.noresi, konsumen.nama, pengiriman.tgl, pengiriman.namapenerima, 
                     pengiriman.alamatpenerima, pengiriman.nohppenerima, pengiriman.berat, 
                     pengiriman.totalbiaya, pengiriman.status, tarif.layanan,
                     kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen', 'left')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif', 'left')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left')
            ->get()
            ->getResultArray();

        $data = [
            'pengiriman' => $query
        ];

        $response = [
            'data' => view('laporan/pengiriman/viewallpengiriman', $data)
        ];

        echo json_encode($response);
    }



    public function viewallLaporanPengirimanProses()
    {
        $db = db_connect();
        $query = $db->table('pengiriman')
            ->select('pengiriman.noresi, konsumen.nama, pengiriman.tgl, pengiriman.namapenerima, 
                     pengiriman.alamatpenerima, pengiriman.nohppenerima, pengiriman.berat, 
                     pengiriman.totalbiaya, pengiriman.status, tarif.layanan,
                     kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen', 'left')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif', 'left')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left')
            ->whereIn('pengiriman.status', [1, 2])
            ->get()
            ->getResultArray();

        $data = [
            'pengiriman' => $query
        ];

        $response = [
            'data' => view('laporan/pengiriman/viewallpengiriman', $data)
        ];

        echo json_encode($response);
    }


    public function viewallLaporanPengirimanSelesai()
    {
        $db = db_connect();
        $query = $db->table('pengiriman')
            ->select('pengiriman.noresi, konsumen.nama, pengiriman.tgl, pengiriman.namapenerima, 
                     pengiriman.alamatpenerima, pengiriman.nohppenerima, pengiriman.berat, 
                     pengiriman.totalbiaya, pengiriman.status, tarif.layanan,
                     kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen', 'left')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif', 'left')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left')
            ->where('pengiriman.status', 3)
            ->get()
            ->getResultArray();

        $data = [
            'pengiriman' => $query
        ];

        $response = [
            'data' => view('laporan/pengiriman/viewallpengiriman', $data)
        ];

        echo json_encode($response);
    }


    public function viewallLaporanPengirimanTanggal()
    {
        $tglmulai = $this->request->getPost('tglmulai');
        $tglakhir = $this->request->getPost('tglakhir');

        $db = db_connect();
        $query = $db->table('pengiriman')
            ->select('pengiriman.noresi, konsumen.nama, pengiriman.tgl, pengiriman.namapenerima, 
                     pengiriman.alamatpenerima, pengiriman.nohppenerima, pengiriman.berat, 
                     pengiriman.totalbiaya, pengiriman.status, tarif.layanan,
                     kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen', 'left')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif', 'left')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left')
            ->where('pengiriman.tgl >=', $tglmulai)
            ->where('pengiriman.tgl <=', $tglakhir)
            ->get()
            ->getResultArray();

        $data = [
            'pengiriman' => $query,
            'tglmulai' => $tglmulai,
            'tglakhir' => $tglakhir
        ];

        $response = [
            'data' => view('laporan/pengiriman/viewallpengiriman', $data)
        ];

        echo json_encode($response);
    }

    public function viewallLaporanPengirimanPerBulan()
    {
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        $db = db_connect();
        $query = $db->table('pengiriman')
            ->select('pengiriman.noresi, konsumen.nama, pengiriman.tgl, pengiriman.namapenerima, 
                     pengiriman.alamatpenerima, pengiriman.nohppenerima, pengiriman.berat, 
                     pengiriman.totalbiaya, pengiriman.status, tarif.layanan,
                     kotaasal.namakota as kota_asal, kotatujuan.namakota as kota_tujuan')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen', 'left')
            ->join('tarif', 'tarif.idtarif = pengiriman.idtarif', 'left')
            ->join('kota as kotaasal', 'kotaasal.idkota = tarif.idkotaasal', 'left')
            ->join('kota as kotatujuan', 'kotatujuan.idkota = tarif.idkotatujuan', 'left')
            ->where('MONTH(pengiriman.tgl)', $bulan)
            ->where('YEAR(pengiriman.tgl)', $tahun)
            ->get()
            ->getResultArray();

        $data = [
            'pengiriman' => $query,
            'bulan' => $bulan,
            'tahun' => $tahun
        ];

        $response = [
            'data' => view('laporan/pengiriman/viewallpengiriman', $data)
        ];

        echo json_encode($response);
    }
}
