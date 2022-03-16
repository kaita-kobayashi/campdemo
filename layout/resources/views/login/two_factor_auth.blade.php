<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{-- <x-jet-authentication-card-logo /> --}}
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('postTwoFactorAuth') }}">
            @csrf
            
            <div>
                <x-jet-label for="tfa_token" value="２段階認証のパスワードをメールアドレスに登録しました。（有効時間：10分間）" />
                <x-jet-input id="tfa_token" class="block mt-1 w-full" type="text" name="tfa_token" value="{{ old('tfa_token') }}" placeholder="２段階パスワード" required autofocus />
                <x-jet-input id="#" class="block mt-1 w-full" type="hidden" name="user_id" value="{{ old('user_id', $user_id) }}" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button class="ml-4">
                    送信する
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
