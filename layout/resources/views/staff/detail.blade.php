<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('staff.title.staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between content-header">
                    <div class="font-semibold">{{ __('staff.title.detail') }}</div>
                    <a href="{{ route('getStaff') }}" class="mr-4">{{ __('staff.links.backList') }}</a>
                </div>
                <table class="text-left table-auto mt-5">
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.id') }}</th>
                        <td class="border pl-4">{{ $result->id }}</td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.name') }}</th>
                        <td class="border pl-4">{{ $result->last_name . ' ' . $result->first_name }}</td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.email') }}</th>
                        <td class="border pl-4">{{ $result->email_address }}</td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.privileges') }}</th>
                        <td class="py-1 border-r pl-4 flex" style="margin-right:-0.03rem;">
                            <table class="table-auto">
                                @foreach (__('privileges.privileges') as $privilegeTop => $privileges)
                                    <tr>
                                        <th>
                                            <x-jet-label for="{{ $privilegeTop }}" value="{{ __('privileges.privileges_top.' . $privilegeTop) }}"/>
                                        </th>
                                        <td class="flex ml-3">
                                            @foreach ($privileges as $key => $privilege)
                                                <x-jet-label for="{{ $privilegeTop . $key }}" value="{{$privilege}}" />
                                                @php
                                                    $array = !empty($result->privileges) && property_exists($result->privileges, str_replace(__('privileges.separate'), '', $privilegeTop))
                                                        ? $result->privileges->{str_replace(__('privileges.separate'), '', $privilegeTop)}
                                                        : [];
                                                @endphp
                                                <x-jet-input id="{{ $privilegeTop . $key }}" class="block mx-2 {{ $privilegeTop }}" type="checkbox" disabled checked="{{ in_array($key, $array) }}"/>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.status') }}</th>
                        <td class="border pl-4">{{ __('staff.status.' . $result['status']) }}</td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.tfa_setting') }}</th>
                        <td class="border pl-4">
                            <div class="flex">
                                <x-jet-label for="on" value="{{ __('staff.radio.tfa_setting.on') }}"/>
                                <x-jet-input id="on" type="radio" class="mx-2" disabled checked="{{ $result->tfa_setting }}"/>
                                <x-jet-label for="off" value="{{ __('staff.radio.tfa_setting.off') }}"/>
                                <x-jet-input id="off" type="radio" class="mx-2" disabled checked="{{ !$result->tfa_setting }}"/>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.created') }}</th>
                        <td class="border pl-4">{{ $result->created_date }}</td>
                    </tr>
                    <tr>
                        <th class="border">{{ __('staff.tableHeader.updated') }}</th>
                        <td class="border pl-4">{{ $result->updated_date }}</td>
                    </tr>
                </table>
                <div class="mt-3">
                    <a href="{{ route('getStaffEdit', ['id' => $result->id]) }}">
                        <x-jet-button>
                            {{ __('common.btn.edit') }}
                        </x-jet-button>
                    </a>
                    <a href="#">
                        <x-jet-button>
                            {{ __('common.btn.delete') }}
                        </x-jet-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
