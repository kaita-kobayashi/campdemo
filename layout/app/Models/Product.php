<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'product';
    protected $fillable = [
        'campaign_id',
        'code',
        'name',
        'name_kana',
        'campany_name',
        'description',
        'image_file',
        'url',
        'price',
        'jan_code',
        'sort_order',
        'status',
    ];
}
