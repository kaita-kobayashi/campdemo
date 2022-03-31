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
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsEntryList(string $campaignId): array
    {
        // 性別別集計
        $genderCount = $this
            ->select(
                'user.gender',
                DB::raw('COUNT(*) AS genderCount')
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('user.gender')
            ->get();

        // 年齢別集計
        $ageCount = $this
            ->select(
                DB::raw("
                    CASE
                        WHEN user.age <= 19 THEN '10s'
                        WHEN user.age <= 29 THEN '20s'
                        WHEN user.age <= 39 THEN '30s'
                        WHEN user.age <= 49 THEN '40s'
                        WHEN user.age <= 59 THEN '50s'
                        WHEN user.age <= 69 THEN '60s'
                        WHEN user.age >= 70 THEN 'overAge'
                    END AS userAge
                "),
                DB::raw('COUNT(*) AS ageCount')
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('userAge')
            ->orderBy('userAge', 'asc')
            ->get();

        // エリア別集計(上位5件)
        $prefectureCount = $this
            ->select(
                'user.prefecture',
                DB::raw('COUNT(*) AS prefectureCount')
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('user.prefecture')
            ->orderBy('prefectureCount', 'desc')
            ->limit(5)
            ->get();

        return [
            'genderCount' => $genderCount,
            'ageCount' => $ageCount,
            'prefectureCount' => $prefectureCount,
        ];
    }
}
