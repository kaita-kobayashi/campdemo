<div class="flex">
    <span class="nav_toggle" id="nav_toggle">
        <i></i>
        <i></i>
        <i></i>
    </span>

    <nav class="nav" id="nav">
        <ul class="nav_menu_ul">
            <li class="nav_menu_li"><a href="{{ route('home') }}">ホーム</a></li>
            <li class="nav_menu_li"><a href="{{ route('getStaff') }}">スタッフ</a></li>
        </ul>
    </nav>
</div>

<script>
    document.getElementById('nav_toggle').onclick = function () {
        document.getElementById('nav_toggle').classList.toggle('show')
        document.getElementById('nav').classList.toggle('show')
    }
</script>