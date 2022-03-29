<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Closure;

class CommonService
{
    /**
     * セッション取得
     *
     * @param string $key
     * @return mixed
     */
    public function getSession(string $key): mixed
    {
        return Session::get($key, false);
    }

    /**
     * セッション格納
     *
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function setSession(string $key, mixed $value): void
    {
        if (Session::has($key)) {
            Session::forget($key);
        }
        Session::put($key, $value);
    }
}
