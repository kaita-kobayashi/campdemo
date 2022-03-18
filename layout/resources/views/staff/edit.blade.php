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
                    <x-jet-label for="password" value="{{ __('staff.label.password') }}" />
                    <span class="error-msg">{{ $errors->first('password') }}</span>
                    <x-jet-input id="password" class="block mt-1 w-72" type="password" name="password" :value="old('password')" placeholder="更新する場合は入力してください。"/>
                    {{-- 性 --}}
                    <x-jet-label for="last_name" value="{{ __('staff.label.last_name') }}" />
                    <span class="error-msg">{{ $errors->first('last_name') }}</span>
                    <x-jet-input id="last_name" class="block mt-1 w-72" type="text" name="last_name" :value="old('last_name', $result->last_name)" />
                    {{-- 名 --}}
                    <x-jet-label for="first_name" value="{{ __('staff.label.first_name') }}" />
                    <span class="error-msg">{{ $errors->first('first_name') }}</span>
                    <x-jet-input id="first_name" class="block mt-1 w-72" type="text" name="first_name" :value="old('first_name', $result->first_name)" />
                    {{-- 権限 --}}
                    <x-jet-label for="" value="{{ __('staff.label.privileges') }}" class="mb-1"/>
                    <span class="error-msg">{{ $errors->first('privileges') }}</span>
                    <div class="flex">
                        @foreach (__('common.privileges') as $key => $privileges)
                            <x-jet-label for="{{ $privileges }}" value="{{$privileges}}" />
                            @if (in_array($key, $result->privileges))
                                <x-jet-input id="{{ $privileges }}" class="block mx-2" type="checkbox" name="privileges[]" value="{{ $key }}" checked/>
                            @else
                                <x-jet-input id="{{ $privileges }}" class="block mx-2" type="checkbox" name="privileges[]" value="{{ $key }}"/>
                            @endif
                        @endforeach
                    </div>
                    {{-- ステータス --}}
                    <x-jet-label for="status" value="ステータス" class="mt-1"/>
                    <select name="status" id="status" class="block mt-1 border-gray-300 shadow-sm rounded-md">
                        @foreach ( __('staff.status') as $key => $value)
                            <option value={{ $key }} @if ($key === $result->status) selected @endif>{{ $value }}</option>
                        @endforeach
                    </select>
                    <x-jet-button class="mt-3">
                        {{ __('common.btn.edit') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
