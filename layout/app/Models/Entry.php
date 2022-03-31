<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Entry extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'entry';
    protected $fillable = [
        'campaign_id',
        'user_id',
        'receipt_id',
        'prize_id',
        'answer',
        'valid_flag',
        'winner_flag',
        'w_chance_flag',
    ];

    /**
     * 応募情報取得(アナリティクスサマリー)
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAnalyticsEntryList(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->get();
    }
}
