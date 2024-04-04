@extends('layout.app')
@section('title', 'Data User')
@section('content')
    <div class="container-barang">
        <div class="card">
            <div class="table-container">
                <center>
                    <h1>Data User</h1>
                </center>
                <table>
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th scope="col" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->telephone }}</td>
                                <td>{{ $item->role }}</td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    @if ($item->id_status == '1')
                                        <a href="{{ route('dataadminusernonaktif', $item->id_user) }}"><i
                                                class="bi bi-x"></i></a>
                                    @elseif($item->id_status == '2')
                                        <a href="{{ route('dataadminuseraktif', $item->id_user) }}"><i
                                                class="bi bi-check-lg"></i></a>
                                        <a href="{{ route('dataadminusertolak', $item->id_user) }}"><i
                                                class="bi bi-x"></i></a>
                                    @else
                                        <a href="{{ route('dataadminuserhapus', $item->id_user) }}"><i
                                                class="bi bi-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
