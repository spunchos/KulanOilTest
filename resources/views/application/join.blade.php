@extends('main')

@section('title', 'join page')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Соединить заявки</h3>

        <div class="mt-8">

        </div>

        <div class="mt-8">
            @error('applications')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            @error('applications.*')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <form enctype="multipart/form-data" class="space-y-5 mt-5" method="POST" action="{{ route('application.joinProcess') }}">
                @csrf

                <div id="applications">
                </div>
                <p class="text-blue-700 hover:text-indigo-900 text-2xl font-small" onclick="addApplication()" style="cursor: pointer">Добавить заявки для обьединения</p>

                <button type="submit" class="text-center w-full bg-blue-900 rounded-md text-white py-3 font-medium">Сохранить</button>
            </form>
        </div>
    </div>
    <script>
        var i = 0;
        function addApplication() {
            var str = '<div class="form-row">\n' +
                '          <select name="applications[]" class="mt-4 w-full h-12 border border-gray-800 rounded px-3">\n' +
                '              @foreach($applications as $application)<option value="{{$application->id}}">{{$application->from}}, {{$application->to}}, {{$application->city->name}}, {{$application->date}}</option> @endforeach' +
                '          </select>\n' +
                '      </div>';
            document.getElementById("applications").insertAdjacentHTML("beforeend", str);
            i++;
        }
    </script>
@endsection
