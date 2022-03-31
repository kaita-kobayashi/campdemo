<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySummary extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'daily_summary';
    protected $fillable = [
        'campaign_id',
        'date',
        'count',
        'products',
        'prizes',
    ];
}
