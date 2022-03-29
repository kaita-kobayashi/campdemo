<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomException;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PrivilegesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param string $key
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     * @throw \App\Exceptions\CustomException
     */
    public function handle(Request $request, Closure $next, string $key): mixed
    {
        if (Auth::check()) {
            $privileges = json_decode(Auth::user()->privileges, true);
            $path = $request->path();
            if ($this->isPermissionError($privileges, $path, $key)) {
                throw new CustomException(config('errors.FAILD_PRIVILEGES'));
            }
            return $next($request);
        } else {
            return redirect('login');
        }
    }

    /**
     * 権限エラー
     *
     * @param array $privileges
     * @param string $path
     * @param string $key
     * @return bool
     */
    public function isPermissionError(array $privileges, string $path, string $key): bool
    {
        if (!array_key_exists($key, $privileges)) {
            return true;
        }

        if (preg_match('/staff$/', $path) || preg_match('/search$/', $path)) {
            return !in_array('list', $privileges[$key]);
        }

        if (preg_match('/detail/', $path)) {
            return !in_array('detail', $privileges[$key]);
        }

        if (preg_match('/create/', $path)) {
            return !in_array('create', $privileges[$key]);
        }

        if (preg_match('/edit/', $path)) {
            return !in_array('edit', $privileges[$key]) || !in_array('detail', $privileges[$key]);
        }

        if (preg_match('/delete/', $path)) {
            return !in_array('delete', $privileges[$key]) || !in_array('detail', $privileges[$key]);
        }
        return false;
    }
}
