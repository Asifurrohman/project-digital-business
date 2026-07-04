<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AmikomEventHub - @yield('title')</title>
    {{-- <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon"> --}}
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }

        .mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .mobile-menu.active {
            max-height: 300px;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">

    
    <nav class="glass sticky top-8 z-40 mx-4 mt-4 px-6 py-4 rounded-2xl border border-white/20 shadow-lg">
        <div class="flex justify-between items-center">
            
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                    AH
                </div>
                <span class="text-xl font-bold tracking-tight">AmikomEventHub</span>
            </div>

            
            <div class="hidden md:flex gap-8 font-medium">
                <a href="{{ route('home') }}" class="text-black {{ request()->routeIs('home') ? 'text-indigo-600' : 'hover:text-indigo-600 transition' }}">Beranda</a>
                <a href="{{ route('events.index') }}" class="text-black {{ request()->routeIs('events.*') ? 'text-indigo-600' : 'hover:text-indigo-600 transition' }}">Event</a>
                <a href="{{ route('events.index') }}" class="text-black {{ request()->routeIs('events.*') ? 'text-indigo-600' : 'hover:text-indigo-600 transition' }}">Kategori</a>
                <a href="{{ route('events.index') }}" class="text-black {{ request()->routeIs('events.*') ? 'text-indigo-600' : 'hover:text-indigo-600 transition' }}">Tentang Kami</a>
            </div>

            
            <button id="menuToggle" class="md:hidden flex items-center justify-center w-10 h-10 rounded-lg hover:bg-white/20 transition">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        
        <div id="mobileMenu" class="mobile-menu md:hidden">
            <div class="pt-4 space-y-3 border-t border-white/20 mt-4">
                <a href="{{ route('home') }}" class="block px-4 py-2 rounded-lg text-black {{ request()->routeIs('home') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-white/30 transition' }}">
                    <i class="fas fa-home mr-2"></i>Beranda
                </a>
                <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded-lg text-black {{ request()->routeIs('events.*') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-white/30 transition' }}">
                    <i class="fas fa-calendar mr-2"></i>Event
                </a>
                <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded-lg text-black {{ request()->routeIs('events.*') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-white/30 transition' }}">
                    <i class="fas fa-calendar mr-2"></i>Kategori
                </a>
                <a href="{{ route('events.index') }}" class="block px-4 py-2 rounded-lg text-black {{ request()->routeIs('events.*') ? 'bg-indigo-100 text-indigo-600 font-semibold' : 'hover:bg-white/30 transition' }}">
                    <i class="fas fa-calendar mr-2"></i>Tentang Kami
                </a>
            </div>
        </div>
        <!-- <div class="flex gap-3">
            <button class="px-5 py-2.5 rounded-xl font-semibold hover:bg-slate-200 transition">Login</button>
            <button
                class="px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-semibold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition">Daftar</button>
        </div> -->
    </nav>

    @yield('content')

    <!-- Footer -->
    <footer class="bg-indigo-900 text-indigo-100 py-20 px-6 mt-20">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
            <div class="space-y-4 col-span-2">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-900 font-bold text-xl">
                        AH</div>
                    <span class="text-2xl font-bold text-white">AmikomEventHub</span>
                </div>
                <p class="max-w-xs text-indigo-300">Platform reservasi tiket event online terbaik untuk mahasiswa dan
                    penyelenggara profesional.</p>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Navigasi</h4>
                <ul class="space-y-4">
                    <li><a href="#" class="hover:text-white transition">Home</a></li>
                    <li><a href="#" class="hover:text-white transition">Semua Event</a></li>
                    <li><a href="#" class="hover:text-white transition">Cara Bayar</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-bold mb-6">Hubungi Kami</h4>
                <ul class="space-y-4">
                    <li>support@eventtiket.com</li>
                    <li>+62 812 3456 7890</li>
                </ul>
            </div>
        </div>
        <div class="max-w-7xl mx-auto pt-12 mt-12 border-t border-indigo-800 text-center text-indigo-400 text-sm">
            &copy; 2024 AmikomEventHub. Built with Laravel & Tailwind CSS.
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const menuToggle = document.getElementById('menuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        menuToggle.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
        });

        // Close menu when clicking on a link
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
            });
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!e.target.closest('nav')) {
                mobileMenu.classList.remove('active');
            }
        });
    </script>

</body>

</html>