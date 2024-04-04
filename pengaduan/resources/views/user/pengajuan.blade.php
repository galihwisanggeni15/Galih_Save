@extends('layouts.user')
@section('title', 'Pengaduan')
@section('content')
    <section class="p-5">
        <div class="row">
            <div class="col-6">
                <h2 class="mb-2">Form Pengaduan Kerusakan Barang</h2>
                <form action="{{ route('pengajuansubmit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="kodePengaduan" class="form-label">Kode Pengaduan</label>
                        <input type="text" name="kode" class="form-control" id="kodePengaduan"
                            aria-describedby="emailHelp" value="KP_<?php echo sprintf('%05d', rand(0, 99999)); ?>" readonly>
                        <div id="emailHelp" class="form-text">Harap catat kode ini untuk melakukan pengecekan barang
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                        <input type="text" name="barang" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="file" name="gambar" class="form-control" id="inputGroupFile02" required>
                        {{-- <label class="input-group-text" for="inputGroupFile02">Upload</label> --}}
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"
                            name="keterangan" required></textarea>
                        <label for="floatingTextarea2">Keterangan</label>
                    </div>

                    <button class="btn btn-outline-success mt-4" type="submit" role="button">Ajukan</button>
                </form>
            </div>

            <div class="col-6 d-flex justify-content-center align-items-center">
                <img src="https://i.pinimg.com/736x/30/71/a2/3071a236f9736ca3166c725fe14466b1.jpg" width="400px"
                    alt="">
            </div>
        </div>
    </section>
    @if (session('kodesudahada'))
        <script>
            alert('Terjadi kesalahan silahkan refresh halaman dan ulangi memasukkan pengajuan');
        </script>
    @endif
@endsection
