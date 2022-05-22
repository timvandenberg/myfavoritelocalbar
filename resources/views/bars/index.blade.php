<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bars') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($bars)
                        <ul class="mb-4">
                        @foreach($bars as $bar)
                            <li><a href="{{ route('bars.show', $bar->id) }}">{{$bar->name}}</a></li>
                        @endforeach
                        </ul>
                    @endif
                    <a href="{{ route('bars.create') }}">New bar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
