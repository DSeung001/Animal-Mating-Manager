<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            비밀번호를 잊어버리셨나요?,
            이메일 주소를 알려주시면 비밀번호 재설정 링크를 보내드리겠습니다.
        </div>

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

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
