<?php

namespace App\Http\Controllers;

use App\Services\AnalyticsService;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    protected $service;

    public function __construct(AnalyticsService $service)
    {
        $this->service = $service;
    }

    /**
     * キャンペーン選択画面表示
     *
     * @return \Illuminate\View\View
     */
    public function getAnalytics(): \Illuminate\View\View
    {
        $result = $this->service->getAnalyticsCampaign();
        $viewAssign = [
            'result' => $result,
        ];
        return view('analytics.index', $viewAssign);
    }

    /**
     * サマリー画面表示
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\View\View
     */
    public function postAnalytics(Request $request): \Illuminate\View\View
    {
        $result = $this->service->getAnalyticsEntry();
        $viewAssign = [
            'result' => $result,
        ];
        return view('analytics.summary', $viewAssign);
    }
}
