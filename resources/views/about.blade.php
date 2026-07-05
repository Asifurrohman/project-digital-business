@section('title', 'Tentang Kami')
@section('page_title', 'Tentang Kami')
@extends('layouts/app')
@section('content')
<main class="max-w-7xl mx-auto px-6 py-12">
	<section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
		<div>
			<h1 class="text-4xl md:text-5xl font-extrabold mb-4">Siapa Kami</h1>
			<p class="text-slate-600 mb-6">
				Stile adalah platform pemesanan tiket acara yang memudahkan kamu menemukan konser, seminar, workshop, dan event seru lainnya.
				Kami membantu penyelenggara menjual tiket dan penonton untuk menemukan pengalaman terbaik di kota mereka.
			</p>
			<ul class="space-y-3">
				<li class="flex items-start gap-3">
					<span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-amber-100 text-amber-600 font-bold">1</span>
					<div>
						<h4 class="font-semibold">Misi</h4>
						<p class="text-slate-500">Menyederhanakan pengalaman mencari dan membeli tiket untuk semua orang.</p>
					</div>
				</li>
				<li class="flex items-start gap-3">
					<span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-amber-100 text-amber-600 font-bold">2</span>
					<div>
						<h4 class="font-semibold">Visi</h4>
						<p class="text-slate-500">Menjadi platform event terpercaya dan favorit di Indonesia.</p>
					</div>
				</li>
				<li class="flex items-start gap-3">
					<span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-amber-100 text-amber-600 font-bold">3</span>
					<div>
						<h4 class="font-semibold">Nilai</h4>
						<p class="text-slate-500">Keamanan pembayaran, transparansi informasi, dan layanan pelanggan yang ramah.</p>
					</div>
				</li>
			</ul>
		</div>
	</section>

	<section class="mt-16 bg-amber-50 border border-amber-100 rounded-3xl p-8 flex flex-col md:flex-row items-center justify-between gap-6">
		<div>
			<h3 class="text-xl font-extrabold">Butuh bantuan atau ingin bekerjasama?</h3>
			<p class="text-slate-600">Hubungi kami dan tim kami akan segera merespons.</p>
		</div>
		<div class="flex gap-4">
			<a href="{{ route('events.index') }}" class="px-6 py-3 border rounded-lg">Lihat Katalog Event</a>
		</div>
	</section>
</main>
@endsection
