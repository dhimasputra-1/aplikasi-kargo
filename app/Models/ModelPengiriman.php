<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengiriman extends Model
{
    protected $table            = 'pengiriman';
    protected $primaryKey       = 'noresi';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'noresi',
        'idtarif',
        'tgl',
        'idkonsumen',
        'namapenerima',
        'alamatpenerima',
        'nohppenerima',
        'berat',
        'totalbiaya',
        'status',
    ];

    public function getTotalCucianMasukBulanIni()
    {
        $bulanIni = date('Y-m'); // Format tahun-bulan
        return $this->where('status', 1)
            ->like('tglmasuk', $bulanIni, 'after') // Asumsi 'tglmasuk' adalah nama kolom di database
            ->countAllResults();
    }

    public function getTotalCucianMasukProsesBulanIni()
    {
        $bulanIni = date('Y-m'); // Format tahun-bulan
        return $this->where('status', 2)
            ->like('tglmasuk', $bulanIni, 'after')
            ->countAllResults();
    }

    public function getTotalCucianMasukSelesaiBulanIni()
    {
        $bulanIni = date('Y-m'); // Format tahun-bulan
        return $this->where('status', 3)
            ->like('tglmasuk', $bulanIni, 'after')
            ->countAllResults();
    }
}
