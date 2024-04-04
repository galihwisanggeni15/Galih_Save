@extends('layout.app2')
@section('title', 'Data Peminjaman')
@section('content')
    <div class="container-pinjam">
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
                            <th>Aksi</th>
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
                                    @if ($item->id_status == '2')
                                        <!-- Tambahkan event onclick yang memanggil fungsi konfirmasiKembali() -->
                                        <a href="{{ route('konfirmasikembaliuser', $item->id_pinjaman) }}"
                                            onclick="konfirmasiKembali()"><i class="bi bi-check-lg"></i></a>
                                    @endif
                                    <a href="{{ route('konfirmasihapus', $item->id_pinjaman) }}"><i class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Fungsi untuk menampilkan alert meminta pengguna memasukkan angka
        function konfirmasiKembali() {
            var input = prompt("Masukkan angka:");
            // Cek apakah input bukan null dan merupakan angka
            if (input !== null && !isNaN(input)) {
                // Lakukan tindakan sesuai kebutuhan, misalnya kirim input ke server atau lakukan tindakan lainnya
                alert("Anda memasukkan angka: " + input);
            } else {
                // Jika input kosong atau bukan angka, tampilkan pesan kesalahan
                alert("Masukkan angka yang valid.");
            }
        }
    </script>
@endsection
