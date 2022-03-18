<x-jet-dropdown dropdownClasses="navi-position" width="w-60" contentClasses="bg-white">
    <x-slot name="trigger">
        <span class="nav_toggle" id="nav_toggle">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </x-slot>
    <x-slot name="content">
        <ul class="nav_menu">
            <li class="nav_menu_li"><a href="{{ route('home') }}">{{ __('common.links.nav.home') }}</a></li>
            <li class="nav_menu_li"><a href="{{ route('getStaff') }}">{{ __('common.links.nav.staff') }}</a></li>
            <li class="nav_menu_li"><a href="#">{{ __('common.links.nav.account') }}</a></li>
        </ul>
    </x-slot>
</x-jet-dropdown>

<script>
    document.getElementById('nav_toggle').onclick = function () {
        document.getElementById('nav_toggle').classList.toggle('show')
    }
</script>