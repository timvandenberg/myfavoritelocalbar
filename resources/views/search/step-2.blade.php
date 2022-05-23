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
                <searchbar-bar
                    :localcity="'{{$localCity}}'"
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