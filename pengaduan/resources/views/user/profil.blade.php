@extends('layouts.user')
@section('title', 'Profil')
@section('content')
    <section class="p-5">
        <center>
            <h1>Profil Saya</h1>
        </center>
        <div class="mt-5">
            <form action="{{route('userprofilsubmit', $data->id_user)}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ $data->nama_lengkap }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">NIP</label>
                    <input type="number" name="nip" value="{{ $data->nip }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Username</label>
                    <input type="text" name="username" value="{{ $data->username }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Telephone</label>
                    <input type="number" name="telephone" value="{{ $data->telephone }}" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </section>
@endsection
