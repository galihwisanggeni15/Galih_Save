@extends('layouts.user')
@section('title', 'Home')
@section('content')
    <section class="p-5">
        <div class="row">
            <div class="col-8 d-flex flex-column justify-content-center align-items-center text-left">
                <h2>Pengaduan Kerusakan Barang?</h2>
                <p>Jangan ambil pusing! Sampaikan kepada kami</p>
                <p class="mt-3">Cek status pengaduan anda</p>
                <form action="{{ route('cekbarang') }}" method="POST" class="mt-3">
                    @csrf
                    <div class="d-flex align-items-center">
                        <input type="text" name="kode" class="form-control me-2" required>
                        <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i> Cari</button>
                    </div>
                </form>
                <p class="mt-4">Atau ajukan pengaduan anda</p>
                <a class="btn btn-primary mt-1" href="/user/pengajuan" role="button">Disini</a>
            </div>

            <div class="col-4 d-flex justify-content-center align-items-center">
                <img src="https://i.pinimg.com/736x/30/71/a2/3071a236f9736ca3166c725fe14466b1.jpg" width="400px"
                    alt="">
            </div>
        </div>
    </section>
    @if (session('tunggu'))
        <script>
            alert('Barangmu segera diproses');
        </script>
    @endif
@endsection
