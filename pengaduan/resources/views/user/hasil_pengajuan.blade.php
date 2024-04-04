@extends('layouts.user')
@section('title', 'Hasil Pengaduan')
@section('content')
    <section class="p-5">
        <div class="row">
            <div class="col-6">
                <h2>Status Pengaduan Anda</h2>
                <p>Nomor Pengaduan : {{ $get->kode_pengaduan }}</p>
                <p>Tanggal Pengaduan : {{ $get->created_at }}</p>
                <p>Nama Pelapor : {{ $get->nama_lengkap }}</p>
                <p>NIP : {{ $get->nip }}</p>
                <p>Nama Barang : {{ $get->nama_barang }}</p>
                <p>Keterangan : {{ $get->keterangan }}</p>
                <p>Status : {{ $get->status }}</p>
                <b class="mt-5">Catatan dari petugas</b>
                @if ($get->catatan)
                    <p>{{$get->catatan}}</p>
                @endif
                <p>
                    <a class="btn btn-danger" href="javascript:history.back()" role="button">Kembali</a>
                </p>
            </div>

            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="https://i.pinimg.com/736x/30/71/a2/3071a236f9736ca3166c725fe14466b1.jpg" width="400px"
                    alt="">
            </div>
        </div>
    </section>
@endsection
