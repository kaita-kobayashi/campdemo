<?php

namespace App\Services;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\Hash;

class StaffService extends CommonService
{
    protected $model;

    public function __construct(Staff $model)
    {
        $this->model = $model;
    }

    /**
     * スタッフ取得(一覧)
     *
     * @param array $search
     * @param string $showNum
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function getStaffList(array $search, string $showNum): \Illuminate\Pagination\LengthAwarePaginator
    {
        $result = $this->model->getStaffList($search, $showNum);
        return $result;
    }

    /**
     * スタッフ取得(一件)
     *
     * @param string $staffId
     * @return \App\Models\Staff
     */
    public function getStaff(Request $request): \App\Models\Staff
    {
        $staffId = $request->route()->parameter('id');
        $result = $this->model->getStaff($staffId);
        $result->privileges = json_decode($result->privileges);
        return $result;
    }

    /**
     * スタッフ登録
     *
     * @param array $formInput
     * @return void
     */
    public function createStaff(array $formInput): void
    {
        $formInput = [
            'email_address' => $formInput['email_address'],
            'password' => Hash::make($formInput['password']),
            'last_name' => $formInput['last_name'],
            'first_name' => $formInput['first_name'],
            'privileges' => json_encode($formInput['privileges']),
            'status' => 0,
        ];
        $this->model->createStaff($formInput);
        // 成功したらメール送信
    }

    /**
     * スタッフ更新
     *
     * @param array $formInput
     * @return void
     */
    public function updateStaff(array $formInput): void
    {
        $updateForm = [
            'email_address' => $formInput['email_address'],
            'last_name' => $formInput['last_name'],
            'first_name' => $formInput['first_name'],
            'privileges' => json_encode($formInput['privileges']),
            'status' => $formInput['status'],
        ];
        if (!is_null($formInput['password'])) {
            $updateForm['password'] = Hash::make($formInput['password']);
        }
        $this->model->updateStaff($updateForm, $formInput['id']);
    }
}
