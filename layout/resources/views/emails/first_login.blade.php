初回ログイン時のパスワード設定用URLを送付します。<br>
<br>
【URL】<br>
<a href="{{ (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'] . '/first_login?token=' . $data['token'] . '&email=' . $data['email'] }}">初回ログイン</a>