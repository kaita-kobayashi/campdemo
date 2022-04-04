<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
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
        $this->service->deleteSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'));
        $result = $this->service->getAnalyticsCampaign();
        $viewAssign = [
            'result' => $result,
        ];
        return view('analytics.index', $viewAssign);
    }

    /**
     * キャンペーン選択
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAnalytics(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->service->setSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'), $request->campaign);
        return redirect('analytics/summary');
    }

    /**
     * サマリー画面表示
     *
     * @return \Illuminate\View\View
     * @throws \App\Exceptions\CustomException
     */
    public function getAnalyticsSummary(): \Illuminate\View\View
    {
        // セッション取得
        $campaignId = $this->service->getSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'));
        if (!$campaignId) {
            throw new CustomException(config('errors.ILLEGAL_TRANSITION'));
        }
        $result = $this->service->getAnalyticsEntry($campaignId);
        $viewAssign = [
            'result' => $result,
            'campaignId' => $campaignId,
        ];
        return view('analytics.summary', $viewAssign);
    }

    /**
     * 応募推移画面表示
     *
     * @return \Illuminate\View\View
     */
    public function getAnalyticsTransition(): \Illuminate\View\View
    {
        // セッション取得
        $campaignId = $this->service->getSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'));
        if (!$campaignId) {
            throw new CustomException(config('errors.ILLEGAL_TRANSITION'));
        }
        $viewAssign = [
            'result' => $this->service->getAnalyticsTransition($campaignId),
        ];
        return view('analytics.transition', $viewAssign);
    }

    /**
     * 応募性別画面表示
     *
     * @return \Illuminate\View\View
     */
    public function getAnalyticsGender(): \Illuminate\View\View
    {
        // セッション取得
        $campaignId = $this->service->getSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'));
        if (!$campaignId) {
            throw new CustomException(config('errors.ILLEGAL_TRANSITION'));
        }
        $viewAssign = [
            'result' => $this->service->getAnalyticsGender($campaignId),
        ];
        return view('analytics.gender', $viewAssign);
    }

    /**
     * 応募年代画面表示
     *
     * @return \Illuminate\View\View
     */
    public function getAnalyticsAge(): \Illuminate\View\View
    {
        // セッション取得
        $campaignId = $this->service->getSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'));
        if (!$campaignId) {
            throw new CustomException(config('errors.ILLEGAL_TRANSITION'));
        }
        $viewAssign = [
            'result' => $this->service->getAnalyticsAge($campaignId),
        ];
        return view('analytics.age', $viewAssign);
    }

    /**
     * 応募エリア画面表示
     *
     * @return \Illuminate\View\View
     */
    public function getAnalyticsEria(): \Illuminate\View\View
    {
        // セッション取得
        $campaignId = $this->service->getSession(config('const.CONST.SESSION_ANALYTICS-CAMPAIGN-ID'));
        if (!$campaignId) {
            throw new CustomException(config('errors.ILLEGAL_TRANSITION'));
        }
        $viewAssign = [
            'result' => $this->service->getAnalyticsEria($campaignId),
        ];
        return view('analytics.eria', $viewAssign);
    }
}
