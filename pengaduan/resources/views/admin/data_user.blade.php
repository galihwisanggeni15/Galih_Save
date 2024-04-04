@extends('layouts.admin')
@section('title', 'Data User')
@section('content')
    <section class="p-5">
        <center><h1>Data User</h1></center>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Telephone</th>
                    <th>NIP</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_lengkap }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->telephone }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->role }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            @if ($item->id_status == '1')
                                <a href="{{route('admindatauserblokir', $item->id_user)}}">Blokir</a>
                            @elseif($item->id_status == '2')
                                <a href="{{route('admindatauserterima', $item->id_user)}}">Terima</a>
                                <a href="{{route('admindatausertolak', $item->id_user)}}">Tolak</a>
                            @else
                                <a href="{{route('admindatauserterima', $item->id_user)}}">Terima</a>
                                <a href="{{route('admindatauserhapus', $item->id_user)}}">Hapus</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
