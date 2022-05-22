<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
        </x-slot>

        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            What bar from your local city do you want to find (where you are now)
        </h1>

        <form
                method="POST"
                action="{{ route('search-step-3-post') }}"
        >
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="bar">
                    {{ __('Bar') }}
                </label>
                <input
                    id="bar"
                    class="block mt-1 w-full"
                    type="text"
                    name="bar"
                    :value="old('bar')"
                    required
                    autofocus
                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3
                    text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                />
            </div>

            <div class="w-full flex justify-center">
                <x-button>
                    Continue
                </x-button>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>