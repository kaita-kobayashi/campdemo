<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class SaveLogsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next): \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
    {
        $response = $next($request);
        // ログイン中
        if (Auth::check() && is_null($response->exception)) {
            $user = Auth::user();
            $userTableName = $user->getTable();
            $routeName = Route::currentRouteName() ?? '';
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
        return $response;
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
}
