<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bar') }}: {{ $thisBar->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6zxl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="w-full max-w-xs">
                        <form
                            method="POST"
                            action="{{ route('barsConnection') }}"
                            class="bg-white px-8 pt-6 pb-8 mb-4"
                        >
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="bar">
                                    {{ __('Bar') }}
                                </label>
                                <select
                                    name="connected_bar_id"
                                    id="bar"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                >
                                    @if($otherBars)
                                        @foreach($otherBars as $bar)
                                            <option value="{{ $bar->id }}">{{ $bar->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="similarity">
                                    {{ __('Similarity') }}
                                </label>
                                <input
                                    id="similarity"
                                    class="block mt-1 w-full"
                                    type="number"
                                    name="similarity"
                                    :value="old('similarity')"
                                    required
                                    autofocus
                                    min="0" max="100" size="1" maxlength="2"
                                    class="shadow appearance-none border border-red-500 rounded w-full py-2 px-3
                                    text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
                                />

                            </div>
                            <div class="flex items-center justify-between mt-4">
                                <x-button class="">
                                    {{ __('Connect Bars') }}
                                </x-button>
                            </div>

                            <input
                                type="hidden"
                                name="bar_id"
                                value="{{ $thisBar->id }}"
                            >
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="">
        <div class="max-w-6zxl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($connections)
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Bar') }} connections
                        </h2>
                        @foreach($connections as $key => $connection)
                            <p>{{ $key }} -> match: {{ array_sum($connection)/count($connection) }} </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
