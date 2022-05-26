<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('bars.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Name -->
            <div>
                <x-label for="description" :value="__('Description')" />
                <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="old('description')" autofocus />
            </div>

            <div>
                <searchbar-place />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ml-4">
                    {{ __('Create Bar') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
