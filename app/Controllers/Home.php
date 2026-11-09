<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelPengiriman;

class Home extends BaseController
{
    public function index()
    {
        // Jika belum login, tampilkan landing page
        return view('landing');
    }

    public function dashboard()
    {
        $db = db_connect();

        // Data untuk 7 hari terakhir
        $last7Days = [];
        $chartData = [];
        $pendapatanData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $last7Days[] = date('d/m', strtotime($date));

            // Hitung jumlah pengiriman per hari
            $count = $db->table('pengiriman')
                ->where('DATE(tgl)', $date)
                ->countAllResults();
            $chartData[] = $count;

            // Hitung pendapatan per hari
            $pendapatan = $db->table('pengiriman')
                ->where('DATE(tgl)', $date)
                ->selectSum('totalbiaya')
                ->get()
                ->getRow()
                ->totalbiaya ?? 0;
            $pendapatanData[] = $pendapatan;
        }

        // Pengiriman terbaru dengan detail
        $recentOrders = $db->table('pengiriman')
            ->select('
                pengiriman.*,
                konsumen.nama as pengirim,
                konsumen.nohp as telp_pengirim,
                k.namakota as kota_asal,
                kt.namakota as kota_tujuan
            ')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
            ->join('tarif t', 't.idtarif = pengiriman.idtarif')
            ->join('kota k', 'k.idkota = t.idkotaasal')
            ->join('kota kt', 'kt.idkota = t.idkotatujuan')
            ->orderBy('tgl', 'DESC')
            ->limit(10)
            ->get()
            ->getResult();

        // Tambahkan status text dan class
        foreach ($recentOrders as $order) {
            switch ($order->status) {
                case '1':
                    $order->status_text = 'Menunggu Pickup';
                    $order->status_class = 'warning';
                    break;
                case '2':
                    $order->status_text = 'Dalam Perjalanan';
                    $order->status_class = 'info';
                    break;
                case '3':
                    $order->status_text = 'Terkirim';
                    $order->status_class = 'success';
                    break;
            }
        }

        $data = [
            // Statistik utama
            'total_pengiriman' => $db->table('pengiriman')->countAllResults(),
            'dalam_pengiriman' => $db->table('pengiriman')->whereIn('status', ['1', '2'])->countAllResults(),
            'terkirim' => $db->table('pengiriman')->where('status', '3')->countAllResults(),
            'total_pelanggan' => $db->table('konsumen')->countAllResults(),

            // Data grafik
            'chart_labels' => $last7Days,
            'chart_data' => $chartData,
            'pendapatan_data' => $pendapatanData,

            // Pengiriman terbaru
            'recent_orders' => $recentOrders,

            // Status pengiriman terkini
            'recent_shipments' => $db->table('pengiriman')
                ->select('pengiriman.noresi, pengiriman.status, konsumen.nama as pengirim')
                ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
                ->orderBy('tgl', 'DESC')
                ->limit(10)
                ->get()
                ->getResult(),

            // Total pendapatan
            'total_pendapatan' => $db->table('pengiriman')
                ->selectSum('totalbiaya')
                ->get()
                ->getRow()
                ->totalbiaya ?? 0,

            // Status pengiriman breakdown
            'status_breakdown' => [
                'menunggu' => $db->table('pengiriman')->where('status', '1')->countAllResults(),
                'dalam_perjalanan' => $db->table('pengiriman')->where('status', '2')->countAllResults(),
                'terkirim' => $db->table('pengiriman')->where('status', '3')->countAllResults()
            ],

            // Top pelanggan
            'top_pelanggan' => $db->table('pengiriman')
                ->select('konsumen.nama, COUNT(*) as jumlah_pengiriman, SUM(pengiriman.totalbiaya) as total_biaya')
                ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
                ->groupBy('pengiriman.idkonsumen')
                ->orderBy('jumlah_pengiriman', 'DESC')
                ->limit(5)
                ->get()
                ->getResult()
        ];

        return view('dashboard/index', $data);
    }

    public function cekstatus($noresi = null)
    {
        // Debug untuk melihat method request
        // dd($this->request->getMethod());

        // Jika method POST (dari form manual)
        if ($this->request->getMethod() === 'post') {
            $noresi = $this->request->getPost('noresi');

            // Debug untuk melihat nilai noresi dari POST
            // dd($noresi);

            // Validasi input
            if (empty($noresi)) {
                session()->setFlashdata('error', 'Nomor resi harus diisi');
                return redirect()->to('/cekstatus');
            }

            // Langsung query dan tampilkan hasil tanpa redirect
            $db = db_connect();
            $pengirimanQuery = $db
                ->table('pengiriman')
                ->select('
                    pengiriman.noresi,
                    konsumen.nama, 
                    pengiriman.tgl as tglmasuk,
                    pengiriman.alamatpenerima as alamat,
                    pengiriman.status
                ')
                ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
                ->where('pengiriman.noresi', $noresi);

            $pengiriman = $pengirimanQuery->get();
            $pengirimanData = $pengiriman->getRow();

            // Debug untuk melihat hasil query
            // dd($pengirimanData);

            // Jika data tidak ditemukan
            if (!$pengirimanData) {
                session()->setFlashdata('error', 'Nomor resi tidak ditemukan');
                return redirect()->to('/cekstatus');
            }

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
                'data' => $pengirimanData // Ubah format data yang dikirim ke view
            ];

            return view('cekstatus', $data);
        }

        // Jika tidak ada noresi, tampilkan form pencarian
        if ($noresi === null) {
            return view('cekstatus');
        }

        // Proses untuk GET request dengan noresi
        $db = db_connect();
        $pengirimanQuery = $db
            ->table('pengiriman')
            ->select('
                pengiriman.noresi,
                konsumen.nama, 
                pengiriman.tgl as tglmasuk,
                pengiriman.alamatpenerima as alamat,
                pengiriman.status
            ')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
            ->where('pengiriman.noresi', $noresi);

        $pengiriman = $pengirimanQuery->get();
        $pengirimanData = $pengiriman->getRow();

        if (!$pengirimanData) {
            session()->setFlashdata('error', 'Nomor resi tidak ditemukan');
            return redirect()->to('/cekstatus');
        }

        return view('cekstatus', ['data' => $pengirimanData]);
    }

    private function dashboardPimpinan()
    {
        $db = db_connect();

        // Data untuk 7 hari terakhir
        $last7Days = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $last7Days[] = date('d/m', strtotime($date));

            // Hitung jumlah pengiriman per hari
            $count = $db->table('pengiriman')
                ->where('DATE(tgl)', $date)
                ->countAllResults();
            $chartData[] = $count;
        }

        // Statistik utama
        $totalPengiriman = $db->table('pengiriman')->countAllResults();
        $dalamPengiriman = $db->table('pengiriman')->where('status', '1')->countAllResults();
        $terkirim = $db->table('pengiriman')->where('status', '3')->countAllResults();
        $totalPelanggan = $db->table('konsumen')->countAllResults();

        // Status pengiriman terkini
        $recentShipments = $db->table('pengiriman')
            ->select('pengiriman.noresi, pengiriman.status, konsumen.nama as pengirim')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
            ->orderBy('tgl', 'DESC')
            ->limit(10)
            ->get()
            ->getResult();

        $data = [
            // Statistik utama
            'total_pengiriman' => $totalPengiriman,
            'dalam_pengiriman' => $dalamPengiriman,
            'terkirim' => $terkirim,
            'total_pelanggan' => $totalPelanggan,

            // Data grafik
            'chart_labels' => $last7Days,
            'chart_data' => $chartData,

            // Status pengiriman terkini
            'recent_shipments' => $recentShipments,

            // Total pendapatan
            'total_pendapatan' => $db->table('pengiriman')
                ->selectSum('totalbiaya')
                ->get()
                ->getRow()
                ->totalbiaya ?? 0,

            // Status pengiriman breakdown
            'status_breakdown' => [
                'menunggu' => $dalamPengiriman,
                'dalam_perjalanan' => $db->table('pengiriman')->where('status', '2')->countAllResults(),
                'terkirim' => $terkirim
            ]
        ];

        return view('dashboard/index', $data);
    }

    private function dashboardAdmin()
    {
        $db = db_connect();

        // Tanggal hari ini
        $today = date('Y-m-d');

        // Data pengiriman hari ini
        $pengirimanHariIni = $db->table('pengiriman')
            ->where('DATE(tgl)', $today)
            ->countAllResults();

        // Data pendapatan hari ini
        $pendapatanHariIni = $db->table('pengiriman')
            ->where('DATE(tgl)', $today)
            ->selectSum('totalbiaya')
            ->get()
            ->getRow()
            ->totalbiaya ?? 0;

        // Pengiriman yang menunggu pickup
        $menungguPickup = $db->table('pengiriman')
            ->where('status', '1')
            ->countAllResults();

        // Pengiriman terbaru dengan detail
        $recentOrders = $db->table('pengiriman')
            ->select('
                pengiriman.*,
                konsumen.nama as pengirim,
                konsumen.nohp as telp_pengirim
            ')
            ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
            ->orderBy('tgl', 'DESC')
            ->limit(10)
            ->get()
            ->getResult();

        // Tambahkan status text dan class
        foreach ($recentOrders as $order) {
            switch ($order->status) {
                case '1':
                    $order->status_text = 'Menunggu';
                    $order->status_class = 'warning';
                    break;
                case '2':
                    $order->status_text = 'Dalam Perjalanan';
                    $order->status_class = 'info';
                    break;
                case '3':
                    $order->status_text = 'Terkirim';
                    $order->status_class = 'success';
                    break;
            }
        }

        $data = [
            // Statistik hari ini
            'pengiriman_hari_ini' => $pengirimanHariIni,
            'pendapatan_hari_ini' => $pendapatanHariIni,
            'menunggu_pickup' => $menungguPickup,
            'dalam_proses' => $db->table('pengiriman')->where('status', '2')->countAllResults(),

            // Pengiriman terbaru
            'recent_orders' => $recentOrders,

            // Konsumen terbaru
            'recent_customers' => $db->table('konsumen')
                ->orderBy('idkonsumen', 'DESC')
                ->limit(5)
                ->get()
                ->getResult(),

            // Total konsumen
            'total_konsumen' => $db->table('konsumen')->countAllResults(),

            // Total tarif
            'total_tarif' => $db->table('tarif')->countAllResults(),

            // Tambahkan top_pelanggan untuk admin
            'top_pelanggan' => $db->table('pengiriman')
                ->select('konsumen.nama, COUNT(*) as jumlah_pengiriman, SUM(pengiriman.totalbiaya) as total_biaya')
                ->join('konsumen', 'konsumen.idkonsumen = pengiriman.idkonsumen')
                ->groupBy('pengiriman.idkonsumen')
                ->orderBy('jumlah_pengiriman', 'DESC')
                ->limit(5)
                ->get()
                ->getResult()
        ];

        return view('dashboard/admin', $data);
    }
}
