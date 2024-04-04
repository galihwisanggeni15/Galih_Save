@extends('layout.app2')
@section('title', 'Beranda')
@section('content')
    <div class="container-index">
        <center>
            <h1>Barang Siap Dipinjam</h1>
        </center>
        <!-- Tambahkan id pada input untuk referensi dengan JavaScript -->
        <input type="text" id="searchInput" name="keyword" placeholder="Cari barang...">
        <div class="container-barang">
            @foreach ($data as $item)
                <div class="card" data-nama="{{ $item->barang }}"> <!-- Tambahkan atribut data-nama dengan nama barang -->
                    <img src="../upload/{{ $item->foto }}" width="230px" height="200px" alt="">
                    <div class="text">
                        <table>
                            <tbody>
                                <tr>
                                    <th style="text-align: left;">Nama Barang</th>
                                    <th>:</th>
                                    <td>{{ $item->barang }}</td>
                                </tr>
                                <tr>
                                    <th style="text-align: left;">Stok Barang</th>
                                    <th>:</th>
                                    <td>{{ $item->stok }}</td>
                                </tr>
                            </tbody>
                        </table><br>
                        <a href="/detailpinjaman/{{ $item->id_barang }}">Pinjam Barang</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        // Fungsi untuk menangani perubahan input pada elemen pencarian
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase(); // Ambil nilai input dan ubah menjadi lowercase
            const cards = document.querySelectorAll('.card'); // Ambil semua elemen card

            cards.forEach(function(card) {
                const namaBarang = card.getAttribute('data-nama').toLowerCase(); // Ambil nama barang dari atribut data-nama dan ubah menjadi lowercase
                // Periksa apakah nama barang mengandung nilai pencarian, jika tidak, sembunyikan elemen card, jika iya, tampilkan
                if (namaBarang.includes(searchValue)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>
@endsection
