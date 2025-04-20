@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($film)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $film->film_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Film</th>
                        <td>{{ $film->film_kode }}</td>
                    </tr>
                    <tr>
                        <th>Judul Film</th>
                        <td>{{ $film->film_nama }}</td>
                    </tr>
                     <tr>
                        <th>Kategori</th>
                        <td>{{ $film->kategori->kategori_nama ?? '-' }}</td> {{-- Asumsi relasi ke tabel kategori --}}
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td>Rp. {{ number_format($film->harga_jual, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $film->film_deskripsi }}</td>
                    </tr>
                    {{-- Tambahkan field lain jika ada --}}
                </table>
            @endempty
            <a href="{{ url('film') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection
@push('css')
@endpush
@push('js')
@endpush