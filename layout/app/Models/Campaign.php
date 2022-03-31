<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'campaign';
    protected $fillable = [
        'account_id',
        'name',
        'description',
        'type',
        'subdomain',
        'settings',
        'open_date',
        'close_date',
        'start_date',
        'end_date',
        'status',
    ];

    /**
     * キャンペーン取得(一覧)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCampaignList(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->get();
    }
}
