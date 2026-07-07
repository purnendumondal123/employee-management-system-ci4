<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model
{
    protected $table = 'employee_otps';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'employee_id',
        'otp',
        'purpose',
        'expires_at',
        'is_used'
    ];
}
