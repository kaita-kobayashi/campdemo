<?php

namespace App\Services;

use App\Models\PasswordReset;
use App\Models\Staff;
use Illuminate\Http\Request;
use App\Services\CommonService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginService extends CommonService
{
    /**
     * トークン生成
     *
     * @return string
     */
    public function getToken(): string
    {
        $randomPassword = '';
        for ($i = 0; $i < 4; $i++) {
            $randomPassword .= strval(rand(0, 9));
        }
        return $randomPassword;
    }

    /**
     * トークン格納
     *
     * @param \App\Models\Staff $user
     * @param string $token
     * @return \App\Models\Staff
     */
    public function setToken(Staff $user, string $token): void
    {
        $user->tfa_token = $token;
        $user->tfa_expiration = now()->addMinutes(10);
        $user->save();
    }

    /**
     * ログイン処理
     *
     * @param \App\Models\Staff
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function execLogin(Staff $user, Request $request): void
    {
        $user->tfa_token = null;
        $user->tfa_expiration = null;
        $user->login_date = now();
        $user->save();
        Auth::login($user);
        // ログ作成
        $this->setLog('execLogin', $user, $request);
        // 権限セッション保持
        $privileges = json_decode($user->privileges, true);
        $this->setSession(config('const.CONST.SESSION_USER_PRIVILEGES'), $privileges);
    }

    /**
     * ログ作成
     *
     * @param string $routeName
     * @param mixed $user
     * @param Illuminate\Http\Request $request
     * @return void
     */
    public function setLog(string $routeName, mixed $user, Request $request): void
    {
        $userTableName = $user->getTable();
        $info = $this->getOperationInfo($routeName, $user);
        // 取得できた場合に登録実行
        if (!empty($info)) {
            $insertInput = [
                $userTableName . '_id' => $user->id,
                $userTableName . '_name' => $user->last_name . ' ' . $user->first_name,
                'ip_address' => $_SERVER['REMOTE_ADDR'],
                'user_agent' => $request->headers->get('user-agent'),
                'event_name' => $info['event_name'],
                'event_description' => $info['event_description'],
                'source' => $routeName,
            ];
            DB::table($userTableName . '_log')->insert($insertInput);
        }
    }

    /**
     * 操作情報取得
     *
     * @param string $routeName
     * @param mixed $user
     * @return array
     */
    public function getOperationInfo(string $routeName, mixed $user): array
    {
        if (gettype(__('log.' . $routeName)) === 'array') {
            $logInfo = __('log.' . $routeName);
            $eventNames = __('log.event_name');
            return [
                'event_name' => $eventNames[$logInfo['event_name']],
                'event_description' => ''
                    . $user->last_name . ' ' . $user->first_name
                    . 'さんが'
                    . $logInfo['function_name'] . '画面で'
                    . $eventNames[$logInfo['event_name']]
                    . '処理を行いました。'
            ];
        } else {
            return [];
        }
    }

    /**
     * パスワード更新(初回ログイン)
     *
     * @param array $formInput
     * @return \App\Models\Staff
     */
    public function updatePassword(array $formInput): \App\Models\Staff
    {
        $user = Staff::where('email_address', $formInput['email'])->first();
        $user->password = Hash::make($formInput['password']);
        $user->status = 1;  // 仮登録→本登録
        $user->save();

        PasswordReset::where('email', $formInput['email'])->delete();
        return $user;
    }
}
