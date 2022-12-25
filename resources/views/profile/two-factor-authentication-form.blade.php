<x-jet-action-section>
    <x-slot name="title">
        이중 보안인증
    </x-slot>

    <x-slot name="description">
        이중 보안인증을 사용하여 계정에 추가 보안을 추가할 수 있습니다.
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    이중 보안인증을 활성화합니다.
                @else
                    이중 보안인증을 사용하도록 설정했습니다.
                @endif
            @else
                이중 보안인증을 사용하도록 설정하지 않았습니다.
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
               이중 보안인증을 사용하도록 설정하면 인증 중에 안전한 임의 토큰을 입력하라는 메시지가 표시됩니다. 모바일의 Authenticator application 앱에서 이 토큰을 검색할 수 있습니다.
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            이중 보안인증을 완료하려면 모바일의 인증 프로그램을 사용하여 다음 QR 코드를 스캔하거나 설정 키를 입력하고 생성된 OTP 코드를 제공하십시오.
                        @else
                            이중 보안인증을 사용할 수 있습니다. 모바일의 인증 프로그램을 사용하여 다음 QR 코드를 스캔하거나 설정 키를 입력하십시오.
                        @endif
                    </p>
                </div>

                <div class="mt-4">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        설정 키: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-jet-label for="code" value="{{ __('Code') }}" />

                        <x-jet-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model.defer="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-jet-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        복구 코드를 암호 관리자에 저장합니다. 이중 보안인증을 설치한 디바이스를 손실할 경우 계정에 대한 액세스를 복구하는 데 사용할 수 있습니다.
                    </p>
                    <br/>
                    <p class="font-semibold">
                        아래 출력된 복구 코드 중 하나를 입력하면 됩니다.
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-jet-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-jet-button type="button" wire:loading.attr="disabled">
                        사용하기
                    </x-jet-button>
                </x-jet-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-jet-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            복구 코드 재생성
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @elseif ($showingConfirmation)
                    <x-jet-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-jet-button type="button" class="mr-3" wire:loading.attr="disabled">
                            {{ __('확인') }}
                        </x-jet-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="showRecoveryCodes">
                        <x-jet-secondary-button class="mr-3">
                            복구 코드 보기
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-secondary-button wire:loading.attr="disabled">
                            취소
                        </x-jet-secondary-button>
                    </x-jet-confirms-password>
                @else
                    <x-jet-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-jet-danger-button wire:loading.attr="disabled">
                            비활성화
                        </x-jet-danger-button>
                    </x-jet-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-jet-action-section>
