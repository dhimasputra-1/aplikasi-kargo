<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTarif extends Model
{
    protected $table            = 'tarif';
    protected $primaryKey       = 'idtarif';
    protected $protectFields    = true;
    protected $allowedFields    = ['idtarif', 'namatarif', 'idkotaasal', 'idkotatujuan', 'tarif', 'layanan', 'estimasi'];


    public function getTotalTarif()
    {
        return $this->countAllResults();
    }
}
