 @extends('layout.app')

 @section('title', 'Tambah Kategori')
 @section('content')
 <div class="home-section">
  <div class="profil">
    <div class="card">
      <h1>Tambah Kategori</h1>
      <form action="/admin/tambahkategori" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="nama">Nama Kategori :</label><br>
          <input type="text" name="nama" placeholder="Masukkan nama kategori.....">
        </div>
        <button type="submit" name="submit" class="button">Simpan</button>
      </form>
    </div>
  </div>
</div>
 @endsection