<?php

namespace App\Services;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        if (Session::has($key)) {
            return Session::get($key);
        } else {
            return false;
        }
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
