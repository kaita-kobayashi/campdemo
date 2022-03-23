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
                    <x-jet-label for="staff_id" value="{{ __('staff.label.id') }}" />
                    <x-jet-input id="staff_id" class="block mt-1" type="text" name="id" :value="old('staff_id', $search['id'])" />
                    <x-jet-label for="email_address" value="{{ __('staff.label.email') }}" />
                    <x-jet-input id="email_address" class="block mt-1" type="text" name="email_address" :value="old('email_address', $search['email_address'])" />
                    <x-jet-label for="last_name" value="{{ __('staff.label.last_name') }}" />
                    <x-jet-input id="last_name" class="block mt-1" type="text" name="last_name" :value="old('last_name', $search['last_name'])" />
                    <x-jet-label for="first_name" value="{{ __('staff.label.first_name') }}" />
                    <x-jet-input id="first_name" class="block mt-1" type="text" name="first_name" :value="old('first_name', $search['first_name'])" />
                    <x-jet-label for="status" value="{{ __('staff.label.status') }}" />
                    <select name="status" id="status" class="block mt-1 border-gray-300 shadow-sm rounded-md">
                        <option @if ($search['status'] === '' || $search['status'] === __('common.select_default')) selected @endif >{{ __('common.select_default') }}</option>
                        @foreach ( __('staff.status') as $key => $value)
                            <option value={{ $key }} @if ($search['status'] == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <x-jet-button class="mt-3">
                        {{ __('common.btn.search') }}
                    </x-jet-button>
                </form>
            </div>
            <div class="p-2 mt-10 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between content-header">
                    <div class="font-semibold">{{ __('staff.title.list') }}</div>
                    <a href="{{ route('getStaffCreate') }}" class="mr-4">{{ __('common.links.create') }}</a>
                </div>
                <form action="{{ route('postStaff') }}" method="POST" name="show_num">
                    @csrf
                    <select name="show_num" id="show_num" class="block mt-5 border-gray-300 shadow-sm rounded-md" onchange="document.show_num.submit()">
                        @foreach ( __('common.show_num') as $key => $value)
                            <option value={{ $key }} @if ($show_num == $key) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                </form>
                {{ $result->appends(request()->query())->links('page') }}
                <table class="w-full table-auto mt-5 data-table" id="staffs">
                    <thead class="data-table-head">
                        @php
                            $sort = request('sort') ?? '';
                            $direction = request('direction') ?? '';
                        @endphp
                        <tr class="text-left">
                            <th @if ($sort === "id") class="{{ 'sort-' . $direction }}" @endif>@sortablelink('id', __('staff.tableHeader.id'))</th>
                            <th @if ($sort === "name") class="{{ 'sort-' . $direction }}" @endif>@sortablelink('name', __('staff.tableHeader.name'))</th>
                            <th @if ($sort === "email_address") class="{{ 'sort-' . $direction }}" @endif>@sortablelink('email_address', __('staff.tableHeader.email'))</th>
                            <th @if ($sort === "status") class="{{ 'sort-' . $direction }}" @endif>@sortablelink('status', __('staff.tableHeader.status'))</th>
                            <th @if ($sort === "created_date") class="{{ 'sort-' . $direction }}" @endif>@sortablelink('created_date', __('staff.tableHeader.created'))</th>
                            <th @if ($sort === "updated_date") class="{{ 'sort-' . $direction }}" @endif>@sortablelink('updated_date', __('staff.tableHeader.updated'))</th>
                        </tr>
                    </thead>
                    <tbody class="data-table-body"> 
                        @foreach ($result as $data)
                            <tr>
                                <td><a href="{{ route('getStaffDetail', ['id' => $data['id']]) }}">{{ $data['id'] }}</a></td>
                                <td>{{ $data['last_name'] . ' ' . $data['first_name'] }}</td>
                                <td>{{ $data['email_address'] }}</td>
                                <td>{{ __('staff.status.' . $data['status']) }}</td>
                                <td>{{ $data['created_date'] }}</td>
                                <td>{{ $data['updated_date'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // アコーディオン
    document.querySelector('.search-form').onclick = function () {
        document.querySelector('.search-form').classList.toggle('is-open');
        document.querySelector('.search-form-content').classList.toggle('is-open');
    }
</script>
