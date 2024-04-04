@extends('layouts.user')
@section('title', 'Ubah Password')
@section('content')
    <section class="p-5">
        <center>
            <h1>Ubah Password</h1>
        </center>
        <div class="mt-5">
            <form action="{{route('adminubahpasswordsubmit', $data->id_user)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">NIP</label>
                    <input type="number" name="nip" value="{{ $data->nip }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" readonly>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Password Baru</label>
                    <input type="password" name="password" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
@endsection
