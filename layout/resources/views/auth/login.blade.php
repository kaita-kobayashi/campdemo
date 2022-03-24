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

        <form method="POST" action="{{ route('login') }}" id="login_form">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('login.label.email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email_address" :value="old('email_address')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('login.label.password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            {{-- <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">入力値を記憶する</span>
                </label>
            </div> --}}

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('login.links.forget') }}
                    </a>
                @endif

                <x-jet-button class="ml-4" id="login_btn">
                    {{ __('login.btn.login') }}
                </x-jet-button>
            </div>
            {!! no_captcha()->input() !!}
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
{!! no_captcha()->script() !!}
{!! no_captcha()->getApiScript() !!}
<script>
    var btn = document.getElementById('login_btn');
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        grecaptcha.ready(function () {
            const siteKey = @json(config('no-captcha.sitekey'));
            grecaptcha.execute(siteKey,  {action: 'login'}).then(function (token) {
                document.getElementById('g-recaptcha-response').value = token;
                document.getElementById('login_form').submit();
            })
        })
    }, false)
</script>
