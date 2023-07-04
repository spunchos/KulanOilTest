@extends('template')

@section('title', 'Nomad_Standart')

@section('content')
    <div class="container mx-auto px-6 py-8">
{{--        <h3 class="text-gray-700 text-3xl font-medium">--}}
{{--            Вы зашли как--}}
{{--            @guest('web')Гость@endguest--}}
{{--            @auth('web')--}}
{{--                @can('manager')--}}
{{--                    Менеджер--}}
{{--                @endcan--}}
{{--                @can('admin')--}}
{{--                    Администратор, вы можете удалять и создавать пользователей--}}
{{--                @endcan--}}
{{--            @endauth--}}
{{--        </h3>--}}

        <div class="mt-8">
            @auth("web")
                <a href="{{ route('logout') }}" class="text-indigo-600 hover:text-indigo-900">Выйти</a>
                <a href="{{ route("register") }}" class="ml-10 text-indigo-600 hover:text-indigo-900">Добавить пользователя</a>
            @endauth
            @guest("web")
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-900">Войти</a>
            @endguest
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                Список пользователей
                            </th>
                            <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                        </tr>
                        </thead>

                        <tbody class="bg-white">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $user->name }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    @can('admin', $user)
                                        {{--                                    <a href="{{ route("index", $user->id) }}"--}}
                                        {{--                                       class="text-indigo-600 hover:text-indigo-900">Редактировать</a>--}}
                                        <form action="{{ route("destroy", $user->id) }}" method="POST">
                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
