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
        'entry_date',
    ];

    /**
     * 応募情報取得(アナリティクスサマリー)
     *
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsEntryList(string $campaignId): array
    {
        return [
            'genderCount' => $this->getGenderCount($campaignId),
            'ageCount' => $this->getAgeCount($campaignId),
            'prefectureCount' => $this->getPrefectureCount($campaignId, 5),
        ];
    }

    /**
     * 性別別集計取得
     *
     * @param string $campaignId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getGenderCount(string $campaignId): \Illuminate\Database\Eloquent\Collection
    {
        return $this
            ->select(
                'user.gender',
                DB::raw('COUNT(*) AS genderCount')
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('user.gender')
            ->get();
    }

    /**
     * 年代別集計取得
     *
     * @param string $campaignId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAgeCount(string $campaignId): \Illuminate\Database\Eloquent\Collection
    {
        return $this
            ->select(
                DB::raw("
                    CASE
                        WHEN user.age <= 19 THEN '" . __('analytics.tableHeader.col.age.10') . "'
                        WHEN user.age <= 29 THEN '" . __('analytics.tableHeader.col.age.20') . "'
                        WHEN user.age <= 39 THEN '" . __('analytics.tableHeader.col.age.30') . "'
                        WHEN user.age <= 49 THEN '" . __('analytics.tableHeader.col.age.40') . "'
                        WHEN user.age <= 59 THEN '" . __('analytics.tableHeader.col.age.50') . "'
                        WHEN user.age <= 69 THEN '" . __('analytics.tableHeader.col.age.60') . "'
                        WHEN user.age >= 70 THEN '" . __('analytics.tableHeader.col.age.overAge') . "'
                    END AS userAge
                "),
                DB::raw('COUNT(*) AS ageCount')
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('userAge')
            ->orderBy('userAge', 'asc')
            ->get();
    }

    /**
     * エリア別集計取得
     *
     * @param string $campaignId
     * @param int $limit
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getPrefectureCount(string $campaignId, int $limit = null): \Illuminate\Database\Eloquent\Collection
    {
        return $this
            ->select(
                'user.prefecture',
                DB::raw('COUNT(*) AS prefectureCount')
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('user.prefecture')
            ->orderBy('prefectureCount', 'desc')
            ->when(!is_null($limit), function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get();
    }

    /**
     * 日付別応募件数取得
     *
     * @param string $campaignId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTransitionCount(string $campaignId): \Illuminate\Database\Eloquent\Collection
    {
        return $this
            ->select(
                DB::raw("DATE_FORMAT(entry.entry_date, '%Y/%m/%d') as entry_date_format"),
                DB::raw('COUNT(*) AS transitionCount'),
            )
            ->join('user', 'entry.user_id', '=', 'user.id')
            ->where('entry.campaign_id', $campaignId)
            ->groupBy('entry_date_format')
            ->orderBy('entry_date_format', 'asc')
            ->get();
    }
}
