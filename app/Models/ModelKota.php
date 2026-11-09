<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKota extends Model
{
    protected $table            = 'kota';
    protected $primaryKey       = 'idkota';
    protected $protectFields    = true;
    protected $allowedFields    = ['namakota', 'alamat', 'notelp'];

    public function getTotalKota()
    {
        return $this->countAllResults();
    }
    // Dates
}
