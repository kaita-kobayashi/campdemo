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
                    <div class="font-semibold">{{ __('staff.title.edit') }}</div>
                    <div>
                        <a href="{{ route('getStaffDetail', ['id' => $result->id]) }}" class="mr-4">{{ __('staff.links.backDetail') }}</a>
                        <a href="{{ route('getStaff') }}" class="mr-4">{{ __('staff.links.backList') }}</a>
                    </div>
                </div>
                <form action="{{ route('postStaffEdit') }}" method="POST" class="mt-5">
                    @csrf
                    {{-- ID --}}
                    <input type="hidden" name="id" value="{{ $result->id }}">
                    <span class="error-msg">{{ $errors->first('id') }}</span>
                    {{-- メールアドレス --}}
                    <x-jet-label for="email_address" value="{{ __('staff.label.email') }}" />
                    <span class="error-msg">{{ $errors->first('email_address') }}</span>
                    <x-jet-input id="email_address" class="block mt-1 w-72" type="email" name="email_address" :value="old('email_address', $result->email_address)" />
                    {{-- パスワード --}}
                    <x-jet-label for="password" value="{{ __('staff.label.password') }}" class="mt-4"/>
                    <span class="error-msg">{{ $errors->first('password') }}</span>
                    <x-jet-input id="password" class="block mt-1 w-72" type="password" name="password" :value="old('password')" placeholder="更新する場合は入力してください。"/>
                    {{-- 性 --}}
                    <x-jet-label for="last_name" value="{{ __('staff.label.last_name') }}" class="mt-4"/>
                    <span class="error-msg">{{ $errors->first('last_name') }}</span>
                    <x-jet-input id="last_name" class="block mt-1 w-72" type="text" name="last_name" :value="old('last_name', $result->last_name)" />
                    {{-- 名 --}}
                    <x-jet-label for="first_name" value="{{ __('staff.label.first_name') }}" class="mt-4"/>
                    <span class="error-msg">{{ $errors->first('first_name') }}</span>
                    <x-jet-input id="first_name" class="block mt-1 w-72" type="text" name="first_name" :value="old('first_name', $result->first_name)" />
                    {{-- 権限 --}}
                    <x-jet-label for="" value="{{ __('staff.label.privileges') }}" class="mt-4"/>
                    <span class="error-msg">{{ $errors->first('privileges') }}</span>
                    <table class="table-auto ml-5">
                        @foreach (__('common.privileges') as $privilegeTop => $privileges)
                            <tr>
                                <th class="flex">
                                    <x-jet-label for="{{ $privilegeTop }}" value="{{ __('common.privileges_top.' . $privilegeTop) }}"/>
                                </th>
                                <td class="flex ml-5">
                                    @foreach ($privileges as $key => $privilege)    
                                        <x-jet-label for="{{ $privilegeTop . $privilege }}" value="{{$privilege}}" />
                                        @php
                                            $array = !empty($result->privileges) && property_exists($result->privileges, str_replace('-', '', $privilegeTop))
                                                ? $result->privileges->{str_replace('-', '', $privilegeTop)}
                                                : [];
                                        @endphp
                                        @if (in_array($key, $array))
                                            <x-jet-input id="{{ $privilegeTop . $privilege }}" class="block mx-2 {{ $privilegeTop }}" type="checkbox" name="privileges[]" value="{{ $privilegeTop . $key }}" checked/>
                                        @else
                                            <x-jet-input id="{{ $privilegeTop . $privilege }}" class="block mx-2 {{ $privilegeTop }}" type="checkbox" name="privileges[]" value="{{ $privilegeTop . $key }}"/>
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    {{-- ステータス --}}
                    <x-jet-label for="status" value="{{ __('staff.label.status') }}" class="mt-4"/>
                    <select name="status" id="status" class="block mt-1 border-gray-300 shadow-sm rounded-md">
                        @foreach ( __('staff.status') as $key => $value)
                            @if ($value === __('staff.status.0'))
                                @continue
                            @endif
                            <option value={{ $key }} @if ($key === $result->status) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    {{-- 2要素認証 --}}
                    <x-jet-label for="tfa_setting" value="{{ __('staff.label.tfa_setting') }}" class="mt-4"/>
                    <div class="flex mt-2">
                        <x-jet-label for="on" value="{{ __('staff.radio.tfa_setting.on') }}"/>
                        @if ($result->tfa_setting)
                            <x-jet-input id="on" type="radio" value="1" name="tfa_setting" class="mx-2" checked/>
                        @else
                            <x-jet-input id="on" type="radio" value="1" name="tfa_setting" class="mx-2"/>
                        @endif
                        <x-jet-label for="off" value="{{ __('staff.radio.tfa_setting.off') }}"/>
                        @if (!$result->tfa_setting)
                            <x-jet-input id="off" type="radio" value="0" name="tfa_setting" class="mx-2" checked/>
                        @else
                            <x-jet-input id="off" type="radio" value="0" name="tfa_setting" class="mx-2"/>
                        @endif
                    </div>

                    <x-jet-button class="mt-3">
                        {{ __('common.btn.edit') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>