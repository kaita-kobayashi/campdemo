<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\DailySummary;
use App\Models\Entry;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AnalyticsService extends CommonService
{
    protected $campaign;
    protected $entry;
    protected $dailySummary;

    public function __construct()
    {
        $this->campaign = new Campaign();
        $this->entry = new Entry();
        $this->dailySummary = new DailySummary();
    }

    /**
     * キャンペーン取得
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAnalyticsCampaign(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->campaign->getCampaignList();
    }

    /**
     * 応募情報取得
     *
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsEntry(string $campaignId): array
    {
        //　データ取得
        $resultEntry = $this->entry->getAnalyticsEntryList($campaignId);
        $resultDailySummary = $this->dailySummary->getDailySummayList($campaignId);
        // 応募件数、性別ごとの件数取得
        $countAll = 0;
        $genderCount = [];
        foreach ($resultEntry['genderCount'] as $item) {
            $countAll += $item['genderCount'];
            $genderCount[$item['gender']] = $item['genderCount'];
        }

        return [
            'entryNum' => $countAll,
            'purchaseProducts' => $this->countPurchaseProducts($resultDailySummary),
            'genderCount' => $genderCount,
            'ageCount' => $resultEntry['ageCount'],
            'prefectureCount' => $resultEntry['prefectureCount']
        ];
    }

    /**
     * 購入商品配列作成
     *
     * @param \Illuminate\Database\Eloquent\Collection $resultDailySummary
     * @return array
     */
    public function countPurchaseProducts(Collection $resultDailySummary): array
    {
        $result = [];
        foreach ($resultDailySummary as $data) {
            $products = json_decode($data['products'], true);
            foreach ($products as $product) {
                if (!array_key_exists($product['name'], $result)) {
                    $result[$product['name']] = 0;
                }
                $result[$product['name']] += $product['quentity'];
            }
        }
        ksort($result);
        return $result;
    }
}
