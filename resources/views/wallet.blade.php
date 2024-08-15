<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Wallet Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- User Information Card -->
                        <p> {{ $wallet->user->name }}</p>

                    <!-- Wallet Information Card -->
                    <div class="bg-gray-100 p-4 mt-4 rounded-lg shadow-md">
                        {{-- <h3 class="text-lg font-semibold mb-4">Wallet Information</h3> --}}
                        <p><strong>Amount:</strong> ${{ number_format($wallet->amount, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>


</x-app-layout>




