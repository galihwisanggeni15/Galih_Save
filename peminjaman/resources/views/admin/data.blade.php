@extends('layout.app')
@section('title', 'Data Peminjaman')
@section('content')
    <div class="container-barang">
        <div class="card">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th width="50px">No</th>
                            <th>Nama Barang</th>
                            <th>Nama</th>
                            <th>Telephone</th>
                            <th>Email</th>
                            <th>Alamat</th>
                            <th>Jumlah Pinjaman</th>
                            <th>Tanggal Pinjaman</th>
                            <th>Tanggal Kembali</th>
                            <th>Foto Barang</th>
                            <th>Status</th>
                            <th scope="col" width="100px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->barang }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->telephone }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->alamat }}</td>
                                <td>{{ $item->jumlahpinjaman }}</td>
                                <td>{{ $item->tanggalpinjam }}</td>
                                <td>{{ $item->tanggalkembali }}</td>
                                <td><img src="{{ asset('upload/' . $item->foto) }}" alt="" width="50px"
                                        style="text-align: left; display:block;"></td>
                                <td>{{ $item->status }}</td>
                                <td>
                                    @if ($item->id_status == '1')
                                        <a href="{{ route('konfirmasiditerima', $item->id_pinjaman) }}"><i
                                                class="bi bi-check-lg"></i></a>
                                        <a href="{{ route('konfirmasiditolak', $item->id_pinjaman) }}"><i
                                                class="bi bi-x"></i></a>
                                    @elseif($item->id_status == '5')
                                        <a href="{{ route('konfirmasipengembalianadmin', $item->id_pinjaman) }}"><i
                                                class="bi bi-check-lg"></i></a>
                                    @endif
                                    <a href="{{ route('konfirmasihapus', $item->id_pinjaman) }}"><i
                                            class="bi bi-trash"></i></a>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
