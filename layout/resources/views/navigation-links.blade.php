<x-jet-dropdown dropdownClasses="navi-position" width="w-60" contentClasses="bg-white">
    <x-slot name="trigger">
        <span class="nav_toggle" id="nav_toggle">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </x-slot>
    <x-slot name="content">
        @php
            $privileges = json_decode(Auth::user()->privileges, true);
        @endphp
        <ul class="nav_menu">
            <li class="nav_menu_li"><a href="{{ route('home') }}">{{ __('common.links.nav.home') }}</a></li>
            @if (array_key_exists('staff', $privileges) && in_array('list', $privileges['staff']))
                <li class="nav_menu_li"><a href="{{ route('getStaff') }}">{{ __('common.links.nav.staff') }}</a></li>
            @endif
            @if (array_key_exists('account', $privileges) && in_array('list', $privileges['account']))
                <li class="nav_menu_li"><a href="#">{{ __('common.links.nav.account') }}</a></li>
            @endif
            @if (array_key_exists('analytics', $privileges) && in_array('select', $privileges['analytics']))
                <li class="nav_menu_li"><a href="{{ route('getAnalytics') }}">{{ __('common.links.nav.analytics') }}</a></li>
            @endif
        </ul>
    </x-slot>
</x-jet-dropdown>

<script>
    document.getElementById('nav_toggle').onclick = function () {
        document.getElementById('nav_toggle').classList.toggle('show')
    }
</script>