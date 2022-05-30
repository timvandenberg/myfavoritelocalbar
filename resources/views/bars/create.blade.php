<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div>
            <search-add-bar-form
                route="{{ route('bars.store') }}"
                token="{{ csrf_token() }}"
            />
        </div>

    </x-auth-card>
</x-guest-layout>