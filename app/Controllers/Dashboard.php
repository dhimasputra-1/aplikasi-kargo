<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelCucianMasuk;
use App\Models\ModelCucianKeluar;
use App\Models\Konsumen;
use App\Models\ModelUser;
use App\Models\SatuanModel;
use App\Models\JenisCucianModel;

class Dashboard extends BaseController
{
    public function index()
    {


        return view('dashboard/index');
    }


    public function cekstatus()
    {
        return view('cekstatus');
    }
}
