@extends('main')

@section('title', 'create page')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Добавить новый город</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            <form enctype="multipart/form-data" class="space-y-5 mt-5" method="POST" action="{{ isset($city) ? route("city.update", $city->id) : route("city.store") }}">
                @csrf

                @if(isset($city))
                    @method("PUT")
                @endif

                <input name="name" type="text" class="w-full h-12 border border-gray-800 rounded px-3 @error('title') border-red-500 @enderror" value="{{ $city->name ?? "" }}" placeholder="Название" />

                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
@endsection
