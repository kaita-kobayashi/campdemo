<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffLog extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'staff_log';

    protected $fillable = [
        'staff_id',
        'ip_address',
        'function_name',
        'operation',
        'control',
    ];
}
