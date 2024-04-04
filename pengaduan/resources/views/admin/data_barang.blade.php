@extends('layouts.admin')
@section('title', 'Data Pengaduan')
@section('content')
    <section class="p-5">
        <center>
            <h1>Data Pengaduan</h1>
        </center>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pengaduan</th>
                    <th>Nama Pelapor</th>
                    <th>Barang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_pengaduan }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            <a href="{{ route('admindatabarangdetail', $item->id_pengaduan) }}">Detail</a>
                            <a href="{{ route('admindatabaranghapus', $item->id_pengaduan) }}">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
