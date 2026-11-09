<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginSession extends Model
{
    protected $table            = 'auth_logins';
    protected $protectFields    = true;
    protected $allowedFields    = ['ip_address', 'email', 'user_id', 'date','success'];
}
