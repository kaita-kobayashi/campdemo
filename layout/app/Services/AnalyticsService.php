<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Entry;
use Illuminate\Http\Request;

class AnalyticsService extends CommonService
{
    protected $campaign;
    protected $entry;

    public function __construct()
    {
        $this->campaign = new Campaign();
        $this->entry = new Entry();
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
     * @return array
     */
    public function getAnalyticsEntry(): array
    {
        $result = $this->entry->getAnalyticsEntryList();
        return [
            'entryNum' => $result->count(),
        ];
    }
}
