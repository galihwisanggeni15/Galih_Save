 @extends('layoutuser.app')

 @section('title', 'Profil')
  @section('content')
<div class="home-section">
  <div class="profil">
    <div class="card">
      <h1>Profil Anda</h1>
      <form action="/user/profil/update" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
          <label for="nama">Nama Lengkap :</label><br>
          <input type="text" name="nama" value="{{Auth::user()->nama}}">
        </div>
        <div class="form-group">
          <label for="username">Username :</label><br>
          <input type="text" name="username" value="{{Auth::user()->username}}">
        </div>
        <div class="form-group">
          <label for="email">Email :</label><br>
          <input type="email" name="email" value="{{Auth::user()->email}}">
        </div>
        <div class="form-group">
          <label for="nomor">Nomor Telepon :</label><br>
          <input type="number" name="nomor" value="{{Auth::user()->telephone}}">
        </div>
        <div class="form-group">
          <label for="alamat">Alamat :</label><br>
          <input type="text" name="alamat" value="{{Auth::user()->alamat}}">
        </div>
        <button type="submit" class="button">Simpan</button>
      </form>
    </div>
  </div>
</div>
 @endsection