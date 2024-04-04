 @extends('layout.app')

 @section('title', 'Tambah Produk')
 @section('content')
 <div class="home-section">
  <div class="profil">
    <div class="card">
      <h1>Tambah Product</h1>
      <form action="/admin/store" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="nama">Kategori Barang :</label><br>
          <select name="kategori" id="cars">
            <option value="">--Pilih--</option>
            @foreach ($category as $item)
            <option value="{{ $item->category_id }}">{{ $item->nama }}</option>
            @endforeach
        </select>
        </div>
        <div class="form-group">
          <label for="nama">Nama Barang :</label><br>
          <input type="text" name="nama" placeholder="Masukkan nama barang.....">
        </div>
        <div class="form-group">
          <label for="harga">Harga Barang :</label><br>
          <input type="number" name="harga" placeholder="Masukkan harga barang.....">
        </div>
        <div class="form-group">
          <label for="deskripsi">Deskripsi Barang :</label><br>
          <input type="text" name="deskripsi" placeholder="Masukkan deskripsi barang.....">
        </div>
        <div class="form-group">
          <label for="gambar">Foto Barang :</label><br>
          <input type="file" name="foto" placeholder="Masukkan foto barang.....">
        </div>
        <div class="form-group">
          <label for="stok">Stok Barang :</label><br>
          <input type="number" name="stok" placeholder="Masukkan stok barang.....">
        </div>
        <div class="form-group">
          <label for="status">Status Barang :</label><br>
          <select name="status" id="cars">
            <option value="">--Pilih--</option>
            <option value="1">Aktif</option>
            <option value="0">Tidak Aktif</option>
        </select>
        </div>
        <button type="submit" name="submit" class="button">Simpan</button>
      </form>
    </div>
  </div>
</div>
 @endsection