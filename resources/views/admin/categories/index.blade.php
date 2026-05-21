
@extends('layouts.admin')
@section('title', 'Kelola Kategori - Admin')
@section('page_title', 'Kelola Kategori')
@section('page_subtitle', 'Buat dan atur kategori event di sini.')
@section('content')

<header class="mb-4 text-right">
    <a href="{{ route('admin.categories.create') }}" class="cursor-pointer inline-flex justify-center items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
        <x-icon name="material-symbols:add-rounded" class="w-5 h-5" />
        Tambah Kategori Baru
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-8 py-6 bg-slate-50/50 border-b gap-4 w-full">
        <form action="{{ route('admin.categories.index') }}" method="GET" class="flex w-full">
            <input type="text" name="search" placeholder="Cari nama kategori..." class="flex-1 px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">Kategori</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($categories as $index => $category)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">
                        {{ $categories->firstItem() + $index }}
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-semibold text-lg text-slate-800">{{ $category->name }}</p>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="cursor-pointer p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                <x-icon name="material-symbols:edit-square-outline-rounded" class="w-5 h-5" />
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="cursor-pointer p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
                                    <x-icon name="material-symbols:delete-outline-rounded" class="w-5 h-5" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-8 py-6 text-center text-slate-400">
                        Tidak ada kategori ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
