<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';

    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    protected $allowedFields = [
        'employee_id',
        'activity',
        'ip_address'
    ];
}
