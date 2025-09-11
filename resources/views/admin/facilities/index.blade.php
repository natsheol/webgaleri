@extends('admin.layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Daftar Fasilitas</h1>

    <a href="{{ route('admin.facilities.create') }}" class="mb-4 inline-block px-4 py-2 bg-amber-600 text-white rounded">Tambah Fasilitas</a>

    <table class="w-full border-collapse border">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2">ID</th>
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Gambar</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($facilities as $facility)
            <tr>
                <td class="border px-4 py-2">{{ $facility->id }}</td>
                <td class="border px-4 py-2">{{ $facility->name }}</td>
                <td class="border px-4 py-2">{{ $facility->category->name }}</td>
                <td class="border px-4 py-2">
                    <img src="{{ asset('storage/'.$facility->image) }}" alt="{{ $facility->name }}" class="h-16">
                </td>
                <td class="border px-4 py-2">
                    <!-- nanti bisa tambah edit/delete -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $facilities->links() }}
    </div>
</div>
@endsection
