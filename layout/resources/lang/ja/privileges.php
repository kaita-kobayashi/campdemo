<?php

return [
    /**
     * 画面ごとの権限をprivilegesに設定
     * keyに対応する名称をprivileges_topに設定
     * separate：例としてstaff-listのようにjoinするためその分割文字列
     */
    'privileges' => [
        'staff' => [
            'list' => '一覧',
            'detail' => '詳細',
            'create' => '登録',
            'edit' => '編集',
            'delete' => '削除',
        ],
        'account' => [
            'list' => '一覧',
            'detail' => '詳細',
            'create' => '登録',
            'edit' => '編集',
            'delete' => '削除',
        ],
        'analytics' => [
            'select' => 'キャンペーン選択',
            'summary' => 'サマリー',
            'transition' => '応募推移',
            'gender' => '応募性別',
            'age' => '応募年代',
            'eria' => '応募エリア',
        ],
    ],
    'privileges_top' => [
        'staff' => 'スタッフ',
        'account' => 'アカウント',
        'analytics' => 'アナリティクス',
    ],
    'separate' => '-',
];
