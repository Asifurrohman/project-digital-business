@section('title', 'Events')
@section('page_title', 'All Events')
@extends('layouts/app')
@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    {{-- <section id="events" class="mx-auto px-6 py-20"> --}}
        <div class="">
            <div class="flex flex-col lg:flex-row lg:justify-between items-start gap-4 lg:gap-0 mb-12">
                <div>
                    <h2 class="text-3xl font-extrabold mb-2">Event Terdekat</h2>
                    <p class="text-slate-500 font-medium">Jangan sampai ketinggalan acara seru minggu ini!</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($events as $event)
                <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-300 overflow-hidden">
                    <div class="relative overflow-hidden aspect-3/4">
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
            <div class="mt-8 flex justify-center">
                {{ $events->links() }}
            </div>
        </div>
        {{-- </section> --}}
    </main>
    @endsection
    