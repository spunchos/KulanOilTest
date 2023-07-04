@extends('main')

@section('title', 'applications')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <h3 class="text-gray-700 text-3xl font-medium">Заявки</h3>

        <div class="mt-8">
            <a href="{{ route("application.create") }}" class="text-indigo-600 hover:text-indigo-900">Добавить заявку</a>
        </div>
        <div class="mt-8">
            <a href="{{ route("application.joinForm") }}" class="text-indigo-600 hover:text-indigo-900">Соединить заявки</a>
        </div>

        <div class="flex flex-col mt-8">
            <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                    <table class="min-w-full">
                        <thead class="bg-gray-900 text-gray-100">
                        <tr>
                            <th scope="col">Город</th>
                            <th scope="col">Откуда</th>
                            <th scope="col">Куда</th>
                            <th scope="col">Статус</th>
                            <th scope="col">Действие</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                        @foreach($applications as $application)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $application->city->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $application->from }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $application->to }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                    <div class="text-sm leading-5 text-gray-900">{{ $application->status }}</div>
                                </td>

                                <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                                    <a href="{{ route("application.decline", $application->id) }}" class="text-indigo-600 hover:text-indigo-900">Отклонить</a>
                                    <form action="{{ route("application.destroy", $application->id) }}" method="POST">
                                        @csrf

                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 hover:text-red-900">Удалить</button>
                                    </form>
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
