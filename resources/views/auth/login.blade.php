<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo/>
            <p class="text-center">
                <b>RMMW</b>은 개체와 알을 관리하는 데 도움을 주고자 만든 사이트입니다.
                <br/>
            </p>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    @if(session('status') == 'passwords.sent')
                        성공적으로 이메일을 발송했습니다.
                    @elseif(session('status') == 'passwords.reset')
                        성공적으로 비밀번호를 수정했습니다.
                    @elseif(session('status') == 'passwords.user')
                        사용자에 대한 응답을 찾을 수 없습니다.
                    @elseif(session('status') == 'passwords.token')
                        유효하지 않은 토큰입니다.
                    @elseif(session('status') == 'passwords.throttled')
                        제한된 비밀번호 재설정 시도입니다.
                    @endif
                </div>
            @endif
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="이메일" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="비밀번호" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('기억하기') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                       {{ __('비밀번호를 잊어버리셨나요?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('로그인') }}
                </x-jet-button>

                <a href="{{url('register')}}">
                    <x-jet-button class="ml-4" type="button">
                        회원가입
                    </x-jet-button>
                </a>
            </div>
        </form>
    </x-jet-authentication-card>

    {{--[추가예정]
    네이버 로그인
    카카오 로그인
    구글 로그인 --}}
</x-guest-layout>
