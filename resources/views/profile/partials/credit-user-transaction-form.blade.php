<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Credit Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Enter card details to add credit to your acount  .') }}
        </p>
    </header>

    <form method="post" action="{{ route('account.credit') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="amount_to_credit" :value="__('Credit Amount')" />
            <x-text-input id="amount_to_credit" name="amount_to_credit" type="text" class="mt-1 block w-full" />
            {{-- <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" /> --}}
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
