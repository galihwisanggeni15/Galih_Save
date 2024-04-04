 @extends('layoutuser.app')

 @section('title', 'Beli Produk')
  @section('content')
<div class="home-section">
  <div class="profil">
    <div class="card">
      <h1>Beli Produk</h1>
      <form action="/user/beliproduk/{{$data->id    }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="nama">Nama Lengkap :</label><br>
          <input type="text" name="nama">
        </div>
        <div class="form-group">
          <label for="nama">Nama barang :</label><br>
          <input type="text" name="namabarang" value="{{$data->nama}}" readonly>
        </div>
        <div class="form-group">
          <label for="nomor">Nomor Telepon :</label><br>
          <input type="number" name="nomor">
        </div>
        <div class="form-group">
          <label for="alamat">Alamat :</label><br>
          <input type="text" name="alamat">
        </div>
        <div class="form-group">
            <label for="status">Pengiriman :</label><br>
            <select name="pengiriman" id="pengiriman">
                <option value="">--Pilih--</option>
                <option value="JNT">JNT</option>
                <option value="JNE">JNE</option>
            </select>
        </div>  
        <div class="form-group">
            <label for="status">Pembayaran :</label><br>
            <select name="pembayaran" id="pembayaran" onchange="toggleNomorPembayaran()">
                <option value="">--Pilih--</option>
                <option value="OVO">OVO</option>
                <option value="GOPAY">GOPAY</option>
                <option value="DANA">DANA</option>
                <option value="BCA">BCA</option>
                <option value="BRI">BRI</option>
            </select>
        </div>  
        <div class="form-group" id="nomorPembayaran">
            <label for="jumlah">Nomor Rekening :</label><br>
            <input type="number" name="rekening" id="nomor_pembayaran">
        </div>
        <div class="form-group">
            <label for="jumlah">Jumlah Barang :</label><br>
            <input type="number" name="jumlah" id="jumlah" value="1" oninput="updateHarga()">
        </div>
        <div class="form-group">
            <label for="harga">Harga :</label><br>
            <input type="text" name="harga" id="harga" value="Rp. {{ number_format($data->price) }}" readonly>
        </div>
        <button type="submit" class="button">Simpan</button>
      </form>
    </div>
  </div>
</div>
<script>
    function updateHarga() {
        // Ambil nilai jumlah barang
        var jumlahBarang = document.getElementById('jumlah').value;

        // Ambil stok barang dari PHP
        var stokBarang = <?php echo $data->stok; ?>;

        // Jika jumlah barang melebihi stok, tampilkan alert dan reset nilai jumlah
        if (jumlahBarang > stokBarang) {
            alert("Jumlah barang melebihi stok yang tersedia!");
            document.getElementById('jumlah').value = stokBarang; // Reset nilai jumlah ke stok maksimum
        }

        // Ambil harga per barang dari PHP
        var hargaPerBarang = <?php echo $data->price; ?>;

        // Hitung total harga berdasarkan jumlah barang
        var totalHarga = jumlahBarang * hargaPerBarang;

        // Format angka ke dalam format mata uang
        var formattedHarga = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalHarga);

        // Update nilai input harga
        document.getElementById('harga').value = formattedHarga;
    }

    function toggleNomorPembayaran() {
        var pembayaranSelect = document.getElementById('pembayaran');
        var nomorPembayaranDiv = document.getElementById('nomorPembayaran');

        // Tampilkan form nomor pembayaran jika pembayaran dipilih, sebaliknya sembunyikan
        nomorPembayaranDiv.style.display = pembayaranSelect.value !== '' ? 'block' : 'none';
    }
</script>

 @endsection