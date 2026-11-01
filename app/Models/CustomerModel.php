<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table            = 'customers';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'name', 'email', 'phone', 'password', 'address', 'type', 'status',
        'google_id', 'avatar', 'signup_method', 'email_verified_at', 'last_login_at',
        'country', 'city', 'state', 'zip_code', 'birth_date', 'loyalty_points',
    ];
    protected $useTimestamps    = true;
}
