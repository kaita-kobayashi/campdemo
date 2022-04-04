<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('analytics.title.analytics') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 mt-10 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div>
                    <span class="font-semibold">{{ __('analytics.title.select') }}</span>
                </div>
                <form action="{{ route('postAnalytics') }}" method="POST">
                    @csrf
                    {{-- キャンペーン --}}
                    <x-jet-label for="campaign" value="{{ __('analytics.label.campaign') }}" class="mt-4"/>
                    <span class="error-msg">{{ $errors->first('campaign') }}</span>
                    <select name="campaign" id="campaign" class="block mt-1 border-gray-300 shadow-sm rounded-md">
                        @foreach ( $result as $key => $value)
                            <option value={{ $value['id'] }}>{{ $value['name'] }}</option>
                        @endforeach
                    </select>
                    <x-jet-button class="mt-3">
                        {{ __('analytics.btn.select') }}
                    </x-jet-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
