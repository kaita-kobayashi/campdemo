<?php

return [
    /**
     * イベント名
     */
    'event_name' => [
        '0' => 'ログイン',
        '1' => 'ログアウト',
        '2' => '登録',
        '3' => '更新',
        '4' => '参照',
        '5' => '削除',
        '6' => 'アップロード',
        '7' => 'ダウンロード',
    ],
    /**
     * ルート名:[ イベント番号、画面名 ]の形で記載
     */
    'execLogin'             => [ 'event_name' => '0',           'function_name' => 'ログイン' ],
    'execLogout'            => [ 'event_name' => '1',           'function_name' => 'ログアウト' ],
    'getStaff'              => [ 'event_name' => '4',           'function_name' => __('staff.title.list') ],
    'postStaff'             => [ 'event_name' => '4',           'function_name' => __('staff.title.list') ],
    'postStaffSearch'       => [ 'event_name' => '4',           'function_name' => __('staff.title.list') ],
    'postStaffCreate'       => [ 'event_name' => '2',           'function_name' => __('staff.title.create') ],
    'getStaffDetail'        => [ 'event_name' => '4',           'function_name' => __('staff.title.detail') ],
    'postStaffEdit'         => [ 'event_name' => '3',           'function_name' => __('staff.title.edit') ],
];
