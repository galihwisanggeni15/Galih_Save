 @extends('layout.app')

 @section('title', 'Edit Produk')
 @section('content')
 <div class="home-section">
  <div class="profil">
    <div class="card">
      <h1>Edit Produk</h1>
      <form action="/admin/update/product/{{$data->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="nama">Kategori Barang :</label><br>
            <select name="kategori" id="cars">
                <option value="">--Pilih--</option>
                @foreach ($category as $item)
                    <option value="{{ $item->category_id }}" @if($data->category_id == $item->category_id) selected @endif>
                        {{ $item->nama }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
          <label for="nama">Nama Barang :</label><br>
          <input type="text" name="nama" placeholder="Masukkan nama barang....." value="{{$data->nama}}">
        </div>
        <div class="form-group">
          <label for="harga">Harga Barang :</label><br>
          <input type="number" name="harga" placeholder="Masukkan harga barang....." value="{{$data->price}}">
        </div>
        <div class="form-group">
          <label for="deskripsi">Deskripsi Barang :</label><br>
          <input type="text" name="deskripsi" placeholder="Masukkan deskripsi barang....." value="{{$data->description}}">
        </div>
       <div class="form-group">
            <label for="gambar">Foto Barang :</label><br>
            <img src="{{ asset('upload/' . $data->image) }}" alt="" width="50px" style="text-align: left; display:block;">
            <input type="file" name="foto" placeholder="Masukkan foto barang.....">
        </div>
        <div class="form-group">
          <label for="stok">Stok Barang :</label><br>
          <input type="number" name="stok" placeholder="Masukkan stok barang....." value="{{$data->stok}}">
        </div>
        <div class="form-group">
            <label for="status">Status Barang :</label><br>
            <select name="status" id="cars">
                <option value="">--Pilih--</option>
                <option value="1" @if($data->status == 1) selected @endif>Aktif</option>
                <option value="0" @if($data->status == 0) selected @endif>Tidak Aktif</option>
            </select>
        </div>
        <button type="submit" name="submit" class="button">Simpan</button>
      </form>
    </div>
  </div>
</div>
 @endsection