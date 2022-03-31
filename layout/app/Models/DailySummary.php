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

    /**
     * 日時情報取得(一覧)
     *
     * @param string $campaignId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getDailySummayList(string $campaignId = null): \Illuminate\Database\Eloquent\Collection
    {
        return $this
            ->when(!is_null($campaignId), function ($query) use ($campaignId) {
                return $query->where('campaign_id', $campaignId);
            })
            ->get();
    }
}
