<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Dynamic title -->
    @hasSection('title')
        <title>{{ config('app.name') }} | @yield('title')</title>
    @else
        <title>{{ config('app.name') }}</title>
    @endif

    <!-- Vite and Livewire Styles -->
    <livewire:styles>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('icon.png') }}">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-[#ECECEC] font-sans leading-normal tracking-normal h-screen overflow-hidden">
    <div class="flex flex-col h-screen overflow-hidden">
        <!-- Header -->
        <header class="bg-[#70aff3] text-black py-8 px-6 fixed top-0 left-0 right-0 z-20">
            <div class="flex items-center justify-start gap-x-5">
                <div class="flex items-center">
                    <img src="{{ asset('assets/img/avatar.png') }}" alt="avatar">
                </div>
                <div>
                    <p class="font-semibold text-xl mb-2">{{ Auth::user()->name }}</p>
                    <h1 class="font-bold text-3xl">{{ Auth::user()->getRoleNames()[0] == 'admin' ? 'Administrator' : 'Mahasiswa' }}</h1>
                </div>
            </div>
        </header>

        <div class="flex flex-1 pt-32" x-data="{ modalLogout: false}" x-cloak>
            <!-- Sidebar -->
            <aside id="sidebar" class="sidebar w-64 bg-white h-[calc(100vh-5.9rem)] fixed top-19 left-0 z-10 pt-4">
                <nav class="text-black text-base font-semibold px-4 py-2">
                    <!-- Sidebar links -->
                    <a href="{{ route('mahasiswa.dashboard') }}" class="flex items-center py-2.5 @if (str_starts_with(Route::currentRouteName(), 'admin.dashboard'))
                    border-l-4 pl-3.5 rounded-l border-current  text-black font-bold @else px-4 rounded hover:bg-black hover:text-white @endif transition duration-300">
                        <i class="fa-solid fa-house-chimney mr-2"></i>
                      <span class="overflow-hidden text-ellipsis whitespace-nowrap">Beranda</span>
                    </a>
                    <a href="{{ route('mahasiswa.absensi') }}" class="flex items-center py-2.5 @if (str_starts_with(Route::currentRouteName(), 'mahasiswa.absensi'))
                    border-l-4 pl-3.5 rounded-l border-current  text-black font-bold @else px-4 rounded hover:bg-black hover:text-white @endif transition duration-300">
                        <i class="fa-solid fa-clock mr-2"></i>
                      <span class="overflow-hidden text-ellipsis whitespace-nowrap">Absensi</span>
                    </a>
                    <a href="{{ route('mahasiswa.riwayat-absensi') }}" class="flex items-center py-2.5 @if (str_starts_with(Route::currentRouteName(), 'mahasiswa.riwayat-absensi'))
                    border-l-4 pl-3.5 rounded-l border-current  text-black font-bold @else px-4 rounded hover:bg-black hover:text-white @endif transition duration-300">
                        <i class="fa-solid fa-clock-rotate-left mr-2"></i>
                      <span class="overflow-hidden text-ellipsis whitespace-nowrap">Riwayat Absensi</span>
                    </a>
                    <a href="{{ route('mahasiswa.profile') }}" class="flex items-center py-2.5 @if (str_starts_with(Route::currentRouteName(), 'mahasiswa.profile'))
                    border-l-4 pl-3.5 rounded-l border-current  text-black font-bold @else px-4 rounded hover:bg-black hover:text-white @endif transition duration-300">
                      <i class="fa-solid fa-user mr-2"></i>
                      <span class="overflow-hidden text-ellipsis whitespace-nowrap">Profile</span>
                    </a>
                    <a href="#" @click="modalLogout = true" class="flex items-center py-2.5  px-4 rounded hover:bg-black hover:text-white transition duration-300">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>
                      <span class="overflow-hidden text-ellipsis whitespace-nowrap">Logout</span>
                    </a>
                </nav>
            </aside>

            <!-- Main content -->
            <main class="flex-1 ml-64 p-6 overflow-y-auto">
                @yield('content')

                @isset($slot)
                    {{ $slot }}
                @endisset
            </main>

            <!-- modal logout -->
            <div x-show="modalLogout" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0
            bg-gray-900 bg-opacity-50 flex items-center justify-center z-40">
                <div @click.away="modalLogout = false" class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded-2xl shadow-lg overflow-y-auto z-50">
                    <div class="modal-content py-4 text-left px-8">
                        <div class="flex justify-between items-center pb-6">
                            <p class="text-2xl font-bold">Logout</p>
                            <div class="modal-close cursor-pointer z-50" @click="modalLogout = false">
                                <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                                    <path d="M14.53 3.47a.75.75 0 0 0-1.06-1.06L9 6.94 4.53 2.47a.75.75 0 0 0-1.06 1.06L7.94 9l-4.47 4.47a.75.75 0 0 0 1.06 1.06L9
                                    11.06l4.47 4.47a.75.75 0 0 0 1.06-1.06L10.06 9l4.47-4.47z" />
                                </svg>
                            </div>
                        </div>
                        <div class="py-10 text-xl font-semibold">
                            <p>
                                Apakah Anda Yakin Ingin keluar?
                            </p>
                        </div>
                        <div class="flex gap-3 items-center justify-end">
                            <a href="{{ route('logout') }}" class="bg-red-600 text-white px-8 py-2 rounded-lg mb-6 mt-2" type="submit">Ya</a>
                            <button @click="modalLogout=false" id="closeModalButton" class="bg-gray-500 text-white border border-gray-300 px-4 py-2
                            rounded-lg mb-6 mt-2" type="button">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:scripts>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    </body>
</html>
