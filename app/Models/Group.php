<?php

namespace App\Models;

use CodeIgniter\Model;

class Group extends Model
{
    protected $table            = 'auth_groups_users';
    protected $primaryKey       = 'group_id';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'group_id',
        'user_id'
    ];


}
