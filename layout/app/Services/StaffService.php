<?php

namespace App\Services;

use App\Mail\FirstLogin;
use App\Models\PasswordReset;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
            'password' => Hash::make(''),
            'last_name' => $formInput['last_name'],
            'first_name' => $formInput['first_name'],
            'privileges' => json_encode($formInput['privileges']),
            'status' => 0,
        ];
        $this->model->createStaff($formInput);
        // メール送信
        $this->sendFirstLoginMail($formInput['email_address']);
    }

    /**
     * 初回ログインメール送信
     *
     * @param string $email
     * @return void
     */
    public function sendFirstLoginMail(string $email): void
    {
        // トークン作成
        $token = Hash::make(Str::random(40));
        // トークン格納
        $passwordReset = new PasswordReset();
        $passwordReset->setToken($email, $token);
        // メール送信
        Mail::to(['email' => $email])->send(new FirstLogin($token, $email));
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
