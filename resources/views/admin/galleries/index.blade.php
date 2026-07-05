
<!DOCTYPE html>
<html>
<head>
<title>Daftar Galeri - Stile</title>
</head>
<body>
<h2>Daftar Foto Dokumentasi (Galeri) Nama / NIM</h2>
<a href="#">
<button>Tambah Foto Baru</button>
</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
<thead>
<tr>
<th>ID</th>
<th>Caption</th>
<th>Nama File / Foto</th>
<th>Aksi</th>
</tr>
</thead>
<tbody>
@foreach($galleries as $index => $gallery)
<tr>
<td>{{ $index + 1 }}</td>
<td>{{ $gallery->caption }}</td>
<td>
<img src="{{ $gallery->image }}" alt="test" width="100">
</td>
<td>
<form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
@csrf
@method('DELETE')

<button type="submit">Hapus</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

</body>
</html>

==============================
<!DOCTYPE html>
<html>
<head>
<title>Tambah Foto - Stile</title>
</head>
<body>

<h2>Tambah Foto Dokumentasi Baru</h2>

<a href="#">Kembali ke Daftar</a>
<br><br>

<form action="#" method="POST" enctype="multipart/form-data">
<input type="hidden" name="_token" value="#" autocomplete="off">
<label for="caption">Caption Foto:</label><br>
<input type="text" id="caption" name="" required>
<br><br>

<label for="image">Pilih Foto:</label><br>
<input type="file" id="image" name="image" required accept="image/*">
<br><br>

<button type="submit">Simpan Foto</button>
</form>

</body>
</html>

