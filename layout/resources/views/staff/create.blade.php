<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('staff.title.staff') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="font-semibold">{{ __('staff.title.create') }}</div>
                    <a href="{{ route('getStaff') }}" class="mr-4">{{ __('staff.links.backList') }}</a>
                </div>
                <form action="{{ route('postStaffCreate') }}" method="POST" class="mt-5">
                    @csrf
                    {{-- メールアドレス --}}
                    <x-jet-label for="email_address" value="{{ __('staff.label.email') }}" />
                    <span class="error-msg">{{ $errors->first('email_address') }}</span>
                    <x-jet-input id="email_address" class="block mt-1" type="email" name="email_address" :value="old('email_address')" />
                    {{-- 性 --}}
                    <x-jet-label for="last_name" value="{{ __('staff.label.last_name') }}" />
                    <span class="error-msg">{{ $errors->first('last_name') }}</span>
                    <x-jet-input id="last_name" class="block mt-1" type="text" name="last_name" :value="old('last_name')"/>
                    {{-- 名 --}}
                    <x-jet-label for="first_name" value="{{ __('staff.label.first_name') }}" />
                    <span class="error-msg">{{ $errors->first('first_name') }}</span>
                    <x-jet-input id="first_name" class="block mt-1" type="text" name="first_name" :value="old('first_name')" />
                    {{-- 権限 --}}
                    <x-jet-label for="" value="{{ __('staff.label.privileges') }}" class="mb-1"/>
                    <span class="error-msg">{{ $errors->first('privileges') }}</span>
                    <div class="flex">
                        @foreach (__('common.privileges') as $key => $privileges)
                            <x-jet-label for="{{ $privileges }}" value="{{$privileges}}" />
                            <x-jet-input id="{{ $privileges }}" class="block mx-2" type="checkbox" name="privileges[]" value="{{ $key }}" />
                        @endforeach
                    </div>
                    <x-jet-button class="mt-3">
                        {{ __('common.btn.create') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
