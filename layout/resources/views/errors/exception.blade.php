<x-guest-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-2 bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-between">
                    <div class="font-semibold">{{ __('common.exception') }}</div>
					@if (Auth::check())
						<a href="{{ route('home') }}" class="mr-4">{{ __('common.links.home') }}</a>
					@else
						<a href="{{ route('login') }}" class="mr-4">{{ __('common.links.login') }}</a>
					@endif
                </div>
				@if ($errors->has('exception'))
					<table class="text-left table-auto mt-5">
						<tr>
							<th class="border">エラーコード</th>
							<td class="border pl-4">{{ $errors->first('code') }}</td>
						</tr>
						<tr>
							<th class="border">エラーメッセージ</th>
							<td class="border pl-4">{{ $errors->first('exception') }}</td>
						</tr>
					</table>
				@endif
            </div>
        </div>
    </div>
</x-guest-layout>
