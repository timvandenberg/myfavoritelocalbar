<x-guest-layout>
    <x-auth-card>

        <x-slot name="logo">
        </x-slot>
        <h1 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
            Find your favorite local bar in a different city!
        </h1>

        <div class="w-full flex justify-center">
            <a href="{{ route('search-step-1') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                Start
            </a>
        </div>

    </x-auth-card>
</x-guest-layout>