<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table         = 'otp_codes';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['email', 'purpose', 'code_hash', 'payload', 'attempts', 'expires_at', 'created_at'];
}
