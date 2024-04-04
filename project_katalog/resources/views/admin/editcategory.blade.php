 @extends('layout.app')

 @section('title', 'Edit Kategori')
 @section('content')
 <div class="home-section">
  <div class="profil">
    <div class="card">
      <h1>Edit Kategori</h1>
      <form action="/admin/editkategori/{{$data->category_id}}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="nama">Nama Kategori :</label><br>
          <input type="text" name="nama" placeholder="Masukkan nama kategori....." value="{{$data->nama}}">
        </div>
        <button type="submit" name="submit" class="button">Simpan</button>
      </form>
    </div>
  </div>
</div>
 @endsection