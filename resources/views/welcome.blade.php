
@extends('layouts/app')
@section('title', 'Temukan Event Seru!')
@section('page_title', 'Beranda')
@section('content')
<!-- Hero Section -->
<section class="max-w-7xl mx-auto px-6 py-20 flex flex-col md:flex-row items-center gap-12">
    <div class="flex-1 space-y-8">
        <span class="inline-block px-4 py-1.5 bg-amber-100 text-amber-700 rounded-full text-sm font-bold uppercase tracking-wider">
            #1 Event Platform
        </span>
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight">
            Temukan & Pesan <span class="text-amber-600">Tiket Event</span> Impianmu.
        </h1>
        <p class="text-lg text-slate-500 max-w-lg leading-relaxed">
            Dari konser musik hingga workshop teknologi, semua ada di genggamanmu. Pesan aman & cepat dengan
            Midtrans.
        </p>
        <div class="flex gap-4">
            <a href="{{ route('events.index') }}" class="px-8 py-4 bg-amber-600 text-white rounded-2xl font-bold text-lg shadow-xl hover:scale-105 transition-transform">
                Mulai Jelajah
            </a>
        </div>
    </div>
    <div class="flex-1 relative">
        <div class="absolute -top-10 -left-10 w-64 h-64 bg-amber-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob">
        </div>
        <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000">
        </div>
        <img src="assets/workshop.png" alt="Workshop" class="rounded-4xl shadow-2xl relative z-10 w-full object-cover aspect-3/4 object-center">
        
        <div class="absolute -bottom-6 -left-6 glass p-6 rounded-2xl shadow-xl z-20 border border-white">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                        </path>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-slate-500 font-bold uppercase">Terverifikasi</p>
                    <p class="font-bold">Pembayaran Aman via Midtrans</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Events Grid -->
<section id="events" class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex flex-col lg:flex-row lg:justify-between items-start gap-4 lg:gap-0 mb-12">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
            <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
        </div>
        <div class="mb-8 flex gap-4 justify-center">
            <a href="/" class="px-4 py-2 rounded shadow-sm transition font-medium {{ !request('category') ? 'bg-amber-600 text-white' : 'bg-amber-100 hover:bg-amber-200 text-amber-700' }}">
                Semua Kategori
            </a>
            @foreach ($categories->take(2) as $category)
            <a href="/?category={{ $category->slug }}" class="px-4 py-2 rounded shadow-sm transition font-medium {{ request('category') === $category->slug ? 'bg-amber-600 text-white' : 'bg-amber-100 hover:bg-amber-200 text-amber-700' }}">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($events->take(6) as $event)
        <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
            <div class="relative overflow-hidden aspect-3/4">
                {{-- <img src="https://placehold.co/200x600" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"> --}}
                <img src="{{ Storage::url($event->poster_path) }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4 px-3 py-1 bg-white/90 backdrop-blur rounded-lg text-xs font-bold uppercase text-amber-600">
                    {{ $event->category->name }}
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold mb-2 group-hover:text-amber-600 transition">
                    {{ $event->title }}
                </h3>
                <div class="flex items-start justify-between">  
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ \Carbon\Carbon::parse($event->date)->format('d-m-Y H:i') }}</span>
                    </div>
                    <div class="text-amber-600 font-semibold">
                        Tersisa: {{ $event->stock }}
                    </div>
                </div>
                <div class="flex justify-between items-center pt-4 border-t">
                    <span class="text-2xl font-black text-amber-600">
                        Rp {{ number_format($event->price, 0, ',', '.') }}
                    </span>
                    <a href="{{ route('events.show', $event->id) }}" class="px-5 py-2 bg-amber-50 text-amber-600 rounded-xl font-bold hover:bg-amber-600 hover:text-white transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <h2 class="text-2xl font-bold text-slate-500">
                Event Kosong
            </h2>
        </div>
        @endforelse
        
        
    </div>
    <div class="mt-12 text-center">
        <a href="{{ route('events.index') }}" class="px-8 py-4 bg-amber-600 text-white rounded-2xl font-bold text-lg shadow-xl hover:scale-105 transition-transform">
            Lihat Semua Event
        </a>
    </div>
</section>

<section id="partners" class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-3xl font-extrabold mb-2">Partner</h2>
            <p class="text-slate-500 font-medium">Partner kami yang hebat!</p>
        </div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
        @forelse ($partners as $partner)
        <div class="group flex flex-col items-center gap-4 p-4 bg-white rounded-2xl transition">
            <img src="{{ $partner->logo_url ?? '$partner->name' }}" alt="{{ $partner->name }}" class="h-40 w-40 object-cover group-hover:scale-110 transition-transform duration-500">
            <p class="text-center font-medium text-slate-700 mt-2">{{ $partner->name }}</p>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <h2 class="text-2xl font-bold text-slate-500">
                Partner Kosong
            </h2>
        </div>
        @endforelse
    </div>
</section>
@endsection
