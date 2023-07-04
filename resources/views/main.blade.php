<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div>
    <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
            </div>

            <nav class="mt-10">
                <a class="flex items-center py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100" href="{{ route("user.index") }}">
                    <span class="mx-3">Пользователи</span>
                </a>
            </nav>
            <nav class="">
                <a class="flex items-center py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100" href="{{ route("application.index") }}">
                    <span class="mx-3">Заявки</span>
                </a>
            </nav>
            <nav class="">
                <a class="flex items-center py-2 px-6 bg-gray-700 bg-opacity-25 text-gray-100" href="{{ route("city.index") }}">
                    <span class="mx-3">Города</span>
                </a>
            </nav>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-indigo-600">
                <span class="text-2xl no-underline text-grey-darkest font-sans font-bold">{{ auth()->user()->name }}</span>

                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                  stroke-linejoin="round"></path>
                        </svg>
                    </button>
                </div>

                <div class="flex items-center">

                    <nav class="font-sans flex flex-col text-center content-center sm:flex-row sm:text-left sm:justify-between py-2 px-6 bg-white shadow sm:items-baseline w-full">
                        <div class="sm:mb-0 self-center">
                            @auth("web")
                                <a href="{{ route('logout') }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Выйти</a>
                            @endauth
                            @guest("web")
                                <a href="{{ route('login') }}" class="text-md no-underline text-grey-darker hover:text-blue-dark ml-2 px-1">Войти</a>
                            @endguest
                        </div>
                    </nav>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                @yield('content')
            </main>
        </div>
    </div>
</div>

<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.7.0/flowbite.min.js"></script>
</body>
</html>
