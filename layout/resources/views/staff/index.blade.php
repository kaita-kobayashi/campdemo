<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('staff.title.staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="search-form">
                    <span class="font-semibold">{{ __('staff.title.search') }}</span>
                </div>
                <form action="{{ route('postStaffSearch') }}" method="POST" class="mt-5 search-form-content">
                    @csrf
                    <x-jet-label for="staff_id" value="ID" />
                    <x-jet-input id="staff_id" class="block mt-1" type="text" name="id" :value="old('staff_id', $search['id'])" />
                    <x-jet-label for="email_address" value="メールアドレス" />
                    <x-jet-input id="email_address" class="block mt-1" type="text" name="email_address" :value="old('email_address', $search['email_address'])" />
                    <x-jet-label for="last_name" value="性" />
                    <x-jet-input id="last_name" class="block mt-1" type="text" name="last_name" :value="old('last_name', $search['last_name'])" />
                    <x-jet-label for="first_name" value="名" />
                    <x-jet-input id="first_name" class="block mt-1" type="text" name="first_name" :value="old('first_name', $search['first_name'])" />
                    <x-jet-label for="status" value="ステータス" />
                    <select name="status" id="status" class="block mt-1 border-gray-300 shadow-sm rounded-md">
                        <option @if ($search['status'] === '' || $search['status'] === '未選択') selected @endif >{{ __('common.search.default') }}</option>
                        @foreach ( __('staff.status') as $key => $value)
                            <option value={{ $key }} @if ($search['status'] == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <x-jet-button class="mt-3">
                        {{ __('common.search.btn') }}
                    </x-jet-button>
                </form>
            </div>
            <div class="p-2 mt-10 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="font-semibold">{{ __('staff.title.list') }}</div>
                    <a href="{{ route('getStaffCreate') }}" class="mr-4">{{ __('common.create') }}</a>
                </div>
                <form action="{{ route('postStaff') }}" method="POST" name="showNum">
                    @csrf
                    <select name="showNum" id="showNum" class="block mt-5 border-gray-300 shadow-sm rounded-md" onchange="document.showNum.submit()">
                        @foreach ( __('common.showNum') as $key => $value)
                            <option value={{ $key }} @if ($showNum == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </form>
                {{ $result->links('page') }}
                <table class="w-full table-auto mt-5" id="staffs">
                    <thead>
                        <tr class="text-left">
                            <th class="sort" data-sort="id">{{ __('staff.tableHeader.id') }}</th>
                            <th class="sort" data-sort="name">{{ __('staff.tableHeader.name') }}</th>
                            <th class="sort" data-sort="email">{{ __('staff.tableHeader.email') }}</th>
                            <th class="sort" data-sort="status">{{ __('staff.tableHeader.status') }}</th>
                            <th class="sort" data-sort="created">{{ __('staff.tableHeader.created') }}</th>
                            <th class="sort" data-sort="updated">{{ __('staff.tableHeader.updated') }}</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($result as $data)
                            <tr>
                                <td class="id"><a href="{{ route('getStaffDetail', ['id' => $data['id']]) }}">{{ $data['id'] }}</a></td>
                                <td class="name">{{ $data['last_name'] . ' ' . $data['first_name'] }}</td>
                                <td class="email">{{ $data['email_address'] }}</td>
                                <td class="status">{{ __('staff.status.' . $data['status']) }}</td>
                                <td class="created">{{ $data['created_date'] }}</td>
                                <td class="updated">{{ $data['updated_date'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // ソート
    var options = {
        valueNames: [ 'id', 'name', 'email', 'status', 'created', 'updated' ]
    };
    var staffList = new List('staffs', options);

    // アコーディオン
    document.querySelector('.search-form').onclick = function () {
        document.querySelector('.search-form-content').classList.toggle('is-open');
    }
</script>
