@extends('main')

@section('title', 'create page')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Вызвать курьера</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" method="POST" action="{{ route("application.store") }}">
                @csrf

                <label class="text-gray-700 text-2xl font-small">Город</label>
                <select name="city_id" class="w-full h-12 border border-gray-800 rounded px-3">
                    @foreach($cities as $city)
                        <option value="{{(int) $city->id }}">{{ $city->name }}</option>
                    @endforeach
                </select>

                <input name="from" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('from') border-red-500 @enderror" placeholder="Откуда" />

                @error('from')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <input name="to" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('to') border-red-500 @enderror" placeholder="Куда" />

                @error('to')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input name="date" type="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('date') border-red-500 @enderror" placeholder="Select date">
                </div>

                @error('date')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
