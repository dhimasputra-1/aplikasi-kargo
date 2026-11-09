<?php

namespace App\Models;

use CodeIgniter\Model;

class Konsumen extends Model
{
    protected $table            = 'konsumen';
    protected $primaryKey       = 'idkonsumen';
    protected $protectFields    = true;
    protected $allowedFields    = ['idkonsumen', 'nama', 'jenkel', 'alamat', 'nohp'];

    public function getTotalKonsumen()
    {
        return $this->countAllResults();
    }
}
