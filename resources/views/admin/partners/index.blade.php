
@extends('layouts.admin')
@section('title', 'Kelola Partner - Admin')
@section('page_title', 'Kelola Partner')
@section('page_subtitle', 'Buat dan atur partner event di sini.')
@section('content')

<header class="mb-4 text-right">
    <a href="{{ route('admin.partners.create') }}" class="cursor-pointer inline-flex justify-center items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
        <x-icon name="material-symbols:add-rounded" class="w-5 h-5" />
        Tambah Partner Baru
    </a>
</header>

<div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
    <div class="px-8 py-6 bg-slate-50/50 border-b gap-4 w-full">
        <form action="{{ route('admin.partners.index') }}" method="GET" class="flex w-full gap-2">
            <input type="text" name="search" placeholder="Cari nama partner..." class="flex-1 px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            <button type="submit" class="cursor-pointer px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition">
                Cari
            </button>
        </form>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                <tr>
                    <th class="px-8 py-4 w-16">No</th>
                    <th class="px-8 py-4">Nama</th>
                    <th class="px-8 py-4">Foto</th>
                    <th class="px-8 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y border-t">
                @forelse($partners as $index => $partner)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-8 py-6 font-bold text-slate-400">
                        {{ $partners->firstItem() + $index }}
                    </td>
                    <td class="px-8 py-6">
                        <p class="font-semibold text-lg text-slate-800">{{ $partner->name }}</p>
                    </td>
                    <td class="px-8 py-6">
                        @if($partner->logo_url)
                        <img src="{{ $partner->logo_url }}" class="w-16 h-16 rounded-xl object-cover shadow-sm">
                        @else
                        <img src="https://placehold.co/16x16" class="w-16 h-16 rounded-xl object-cover shadow-sm">
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.partners.edit', $partner->id) }}" class="cursor-pointer p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                <x-icon name="material-symbols:edit-square-outline-rounded" class="w-5 h-5" />
                            </a>
                            <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?')">
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
                        Tidak ada data partner.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="px-8 py-6 bg-slate-50/50 border-t items-center">
        {{ $partners->links() }}
    </div>
</div>
@endsection
