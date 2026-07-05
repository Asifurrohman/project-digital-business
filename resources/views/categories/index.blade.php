@section('title', 'Categories')
@section('page_title', 'All Categries')
@extends('layouts/app')
@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
    {{-- <section id="events" class="mx-auto px-6 py-20"> --}}
        <div class="mx-auto">
            <div>
                <h2 class="text-3xl font-extrabold mb-2">List Kategori</h2>
                <p class="text-slate-500 font-medium">Daftar kategori event:</p>
            </div>
            
            <div class="flex flex-col gap-4 mt-8">
                @foreach ($categories as $category)
                <a href="events/?category={{ $category->slug }}" class="px-4 py-2 max-w-full md:max-w-1/3 bg-white hover:bg-amber-600 hover:text-white text-amber-700 rounded shadow-sm transition">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>
        {{-- </section> --}}
    </main>
    @endsection
    