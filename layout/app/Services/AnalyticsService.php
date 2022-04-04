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
        foreach ($resultEntry['genderCount'] as $item) {
            $countAll += $item['genderCount'];
        }

        return [
            'entryNum' => $countAll,
            'purchaseProducts' => $this->countPurchaseProducts($resultDailySummary),
            'genderCount' => $this->convertArray($resultEntry['genderCount'], 'gender', 'genderCount'),
            'ageCount' => $this->convertArray($resultEntry['ageCount'], 'userAge', 'ageCount'),
            'prefectureCount' => $this->convertArray($resultEntry['prefectureCount'], 'prefecture', 'prefectureCount')
        ];
    }

    /**
     * 配列化
     *
     * @param \Illuminate\Database\Eloquent\Collection $data
     * @param string $key
     * @param string $value
     * @return array
     */
    public function convertArray(Collection $data, string $key, string $value): array
    {
        $result = [];
        foreach ($data as $item) {
            $result[$item[$key]] = $item[$value];
        }
        return $result;
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

    /**
     * 日付別応募件数取得
     *
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsTransition(string $campaignId): array
    {
        //　データ取得
        $result = $this->entry->getTransitionCount($campaignId);
        return $this->convertArray($result, 'entry_date_format', 'transitionCount');
    }

    /**
     * 応募性別取得
     *
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsGender(string $campaignId): array
    {
        //　データ取得
        $result = $this->entry->getGenderCount($campaignId);
        return $this->convertArray($result, 'gender', 'genderCount');
    }

    /**
     * 応募年代取得
     *
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsAge(string $campaignId): array
    {
        //　データ取得
        $result = $this->entry->getAgeCount($campaignId);
        return $this->convertArray($result, 'userAge', 'ageCount');
    }

    /**
     * 応募エリア取得
     *
     * @param string $campaignId
     * @return array
     */
    public function getAnalyticsEria(string $campaignId): array
    {
        //　データ取得
        $result = $this->entry->getPrefectureCount($campaignId);
        return $this->convertArray($result, 'prefecture', 'prefectureCount');
    }
}
