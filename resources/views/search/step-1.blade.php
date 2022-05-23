<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
        </x-slot>

        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            What is your local party city?
        </h1>

        <form
            method="POST"
            action="{{ route('search-step-2-post') }}"
        >
            @csrf

            <div class="mb-4">
                <searchbar-city />
            </div>

            <div class="w-full flex justify-center">
                <x-button>
                    Continue
                </x-button>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>