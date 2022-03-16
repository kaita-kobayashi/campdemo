<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Services\StaffService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Redirector\Illuminate\Http\RedirectResponse;

class StaffController extends Controller
{
    protected $service;

    public function __construct(StaffService $service)
    {
        $this->service = $service;
    }

    /**
     * スタッフ一覧表示
     *
     * @return \Illuminate\View\View
     */
    public function getStaff(): \Illuminate\View\View
    {
        // セッション取得
        $search = $this->service->getSession(Config('const.CONST.SESSION_STAFF_SEARCH')) ?: [];
        $showNum = $this->service->getSession(Config('const.CONST.SESSION_STAFF_SHOW_NUM')) ?: '30';

        // スタッフ取得
        $result = $this->service->getStaffList($search, $showNum);
        $viewAssign = [
            'result' => $result,
            'search' => [
                'id' => isset($search['id']) ? $search['id'] : '',
                'email_address' => isset($search['email_address']) ? $search['email_address'] : '',
                'last_name' => isset($search['last_name']) ? $search['last_name'] : '',
                'first_name' => isset($search['first_name']) ? $search['first_name'] : '',
                'status' => isset($search['status']) ? $search['status'] : '',
            ],
            'show_num' => $showNum,
        ];

        return view('staff.index', $viewAssign);
    }

    /**
     * スタッフ一覧表示(表示件数)
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStaff(Request $request): \Illuminate\Http\RedirectResponse
    {
        // セッション格納
        $this->service->setSession(Config('const.CONST.SESSION_STAFF_SHOW_NUM'), $request->show_num);

        // 一覧表示
        return redirect('staff');
    }

    /**
     * スタッフ一覧表示(検索)
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStaffSearch(Request $request): \Illuminate\Http\RedirectResponse
    {
        // セッション格納
        $this->service->setSession(Config('const.CONST.SESSION_STAFF_SEARCH'), $request->all());

        // 一覧表示
        return redirect('staff');
    }

    /**
     * スタッフ登録表示
     *
     * @return \Illuminate\View\View
     */
    public function getStaffCreate(): \Illuminate\View\View
    {
        return view('staff.create');
    }

    /**
     * スタッフ登録処理
     *
     * @param \App\Http\Requests\StaffRequest
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStaffCreate(StaffRequest $request): \Illuminate\Http\RedirectResponse
    {
        // スタッフ登録
        $this->service->createStaff($request->all());
        // 一覧画面に遷移
        return redirect('staff');
    }

    /**
     * スタッフ詳細表示
     *
     * @return \Illuminate\View\View
     */
    public function getStaffDetail(Request $request): \Illuminate\View\View
    {
        // スタッフ情報取得
        $result = $this->service->getStaff($request);
        // 詳細画面表示
        $viewAssign = [
            'result' => $result,
        ];
        return view('staff.detail', $viewAssign);
    }

    /**
     * スタッフ編集表示
     *
     * @return \Illuminate\View\View
     */
    public function getStaffEdit(Request $request): \Illuminate\View\View
    {
        // スタッフ情報取得
        $result = $this->service->getStaff($request);
        // 詳細画面表示
        $viewAssign = [
            'result' => $result,
        ];
        return view('staff.edit', $viewAssign);
    }

    /**
     * スタッフ編集処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postStaffEdit(StaffRequest $request): \Illuminate\Http\RedirectResponse
    {
        // スタッフ情報取得
        $this->service->updateStaff($request->all());
        // 一覧表示
        return redirect('staff');
    }
}
