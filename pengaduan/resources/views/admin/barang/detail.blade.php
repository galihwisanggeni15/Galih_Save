@extends('layouts.admin')
@section('title', 'Detail Data Pengaduan')
@section('content')
    <section class="p-5">
        <center>
            <h1>Detail Data Pengaduan</h1>
        </center>
        <div class="mt-5">
            <form action="{{ route('admindatabarangdetailsubmit', $data['join']->id_pengaduan) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Kode Pengaduan</label>
                    <input type="text" value="{{ $data['join']->kode_pengaduan }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Pengaduan</label>
                    <input type="text" value="{{ $data['join']->nama_lengkap }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">NIP</label>
                    <input type="number" value="{{ $data['join']->nip }}" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                    <input type="text" value="{{ $data['join']->nama_barang }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Keterangan</label>
                    <input type="text" value="{{ $data['join']->keterangan }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <img src="{{ asset('upload/' . $data['join']->gambar) }}" width="200px" height="200px" alt="">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Catatan</label>
                    <input type="catatan" name="catatan" value="{{ $data['join']->catatan }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <select name="status" class="form-select" aria-label="Default select example">
                    <option disabled>Pilih Status</option>
                    @foreach ($data['status'] as $item)
                        <option value="{{ $item->id_status }}"
                            {{ $item->id_status == $data['join']->id_status ? 'selected' : '' }}>
                            {{ $item->status }}
                        </option>
                    @endforeach
                </select>

                <br>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
    @if (session('submit'))
        <script>
            alert('Berhasil Update');
        </script>
    @endif
@endsection
