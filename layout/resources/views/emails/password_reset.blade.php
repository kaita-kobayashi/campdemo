以下のリンクよりパスワードを再設定してください。<br>
<br>
【パスワードリセット】<br>
<a href="{{ (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/reset-password/' . $data['token'] }}">パスワード再設定</a>