<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Dashboard - @yield('title')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 flex min-h-screen">
    <aside class="w-64 bg-indigo-900 text-indigo-100 flex flex-col p-6 space-y-8 sticky top-0 h-screen">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">
                AH
            </div>
            <span class="text-xl font-bold text-white tracking-tight">AmikomEventHub</span>
        </div>

        <nav class="flex-1 space-y-2">
            <p class="text-[10px] font-bold uppercase tracking-widest text-indigo-400 mb-4 px-2">Main Menu</p>
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <x-icon name="material-symbols:dashboard-outline-rounded" class="w-5 h-5 {{ request()->routeIs('admin.events.*') ? 'text-indigo-300' : 'text-indigo-400' }}" />
                Dashboard
            </a>
            <a href="{{ route('admin.events.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.events.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <x-icon name="material-symbols:event-note-outline-rounded" class="w-5 h-5 {{ request()->routeIs('admin.events.*') ? 'text-indigo-300' : 'text-indigo-400' }}" />
                Kelola Event
            </a>
            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.categories.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <x-icon name="material-symbols:category-outline-rounded" class="w-5 h-5 {{ request()->routeIs('admin.categories.*') ? 'text-indigo-300' : 'text-indigo-400' }}" />
                Kelola Kategori
            </a>
            <a href="{{ route('admin.partners.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.partners.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <x-icon name="material-symbols:handshake-outline-rounded" class="w-5 h-5 {{ request()->routeIs('admin.partners.*') ? 'text-indigo-300' : 'text-indigo-400' }}" />
                Kelola Partner
            </a>
            {{-- <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition"> --}}
            <a href="{{ route('admin.transactions.index') }}" class="flex items-center gap-3 px-4 py-3 {{ request()->routeIs('admin.transactions.*') ? 'bg-indigo-800 text-white' : 'hover:bg-indigo-800' }} rounded-xl font-bold transition">
                <x-icon name="material-symbols:receipt-long-outline-rounded" class="w-5 h-5 {{ request()->routeIs('admin.transactions.*') ? 'text-indigo-300' : 'text-indigo-400' }}" />
                Laporan Transaksi
            </a>
        </nav>

        <div class="pt-6 border-t border-indigo-800">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="cursor-pointer w-full flex items-center gap-3 px-4 py-3 text-indigo-300 hover:text-white transition font-medium text-left">
                    <x-icon name="ic:round-log-out" class="w-5 h-5 text-indigo-400" />
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10 overflow-y-auto">
        <!-- Header -->
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black">
                    @yield('page_title', 'Dashboard')
                </h1>
                <p class="text-slate-500 font-medium">
                    @yield('page_subtitle', 'Selamat datang kembali, Admin!')
                </p>
            </div>
            <div class="flex items-center gap-4">
                <div class="text-right hidden md:block">
                    <p class="font-bold">Admin Super</p>
                    <p class="text-xs text-slate-400">Penyelenggara Utama</p>
                </div>
                <div class="w-12 h-12 bg-white rounded-2xl shadow-sm border flex items-center justify-center p-1">
                    <img src="https://ui-avatars.com/api/?name=Admin+Super&background=6366f1&color=fff"
                        class="rounded-xl">
                </div>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-xl mb-6 font-bold text-sm">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>