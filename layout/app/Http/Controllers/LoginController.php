<?php

namespace App\Http\Controllers;

use App\Mail\TwoFactorAuthPassword;
use App\Models\Staff;
use App\Models\User;
use App\Services\LoginService;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Requests\LoginRequest;

class LoginController extends AuthenticatedSessionController
{
    protected $service;

    public function __construct(StatefulGuard $guard, LoginService $service)
    {
        parent::__construct($guard);
        $this->service = $service;
    }

    /**
     * ログイン処理
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request): mixed
    {
        $credentials = $request->only('email_address', 'password');
        if (Auth::validate($credentials)) {
            $user = Staff::where('email_address', $request->email_address)->first();
            if ($user->tfa_setting) {
                // トークン生成
                $randomPassword = $this->service->getToken();

                // トークン格納
                $this->service->setToken($user, $randomPassword);

                // メール送信
                Mail::to(['email' => $user->email_address])->send(new TwoFactorAuthPassword($randomPassword));

                // OTP入力画面表示
                $viewAssign = [
                    'user_id' => $user->id,
                ];
                return view('login.two_factor_auth', $viewAssign);
            } else {
                // 二要素認証なしでログイン
                $this->service->execLogin($user, $request);
                return redirect('home');
            }
        }
        return redirect('login')->withErrors('スタッフ、もしくはアカウントが存在しません');
    }

    /**
     * ２段階認証
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function twoFactorAuth(Request $request): mixed
    {
        $result = false;
        if ($request->filled('tfa_token', 'user_id')) {
            $user = Staff::find($request->user_id);
            $expiration = new Carbon($user->tfa_expiration);
            // トークン一致、かつ10分以内
            if ($user->tfa_token === $request->tfa_token && $expiration > now()) {
                $this->service->execLogin($user, $request);
                $result = true;
            }
        }

        if ($result) {
            return redirect('home');
        } else {
            return redirect('login')->withErrors('2要素認証に失敗しました。');
        }
    }

    /**
     * ログアウト
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->service->setLog('execLogout', Auth::user(), $request);
        return parent::destroy($request);
    }
}
