 @extends('layout.app')

 @section('title', ' Data Kategori')
  @section('content')
  <div class="home-section">
  <div class="product">
    <div class="card">
        <h1>Data Kategori</h1>
        <div class="isi">
        <a class="btn mx-auto text-center " href="/admin/editdatacategory">Tambah Data</a>
        <table class="table" border="1">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Kategori</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($category as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{  $user->nama}}</td>
        <td>
            <a class="edit" href="/admin/edit/category/{{$user->category_id}}">Edit</a> || 
            <a class="tambah" href="/admin/hapus/category/{{$user->category_id}}">Hapus</a>
        </td>
    </tr>
@endforeach

          </tbody>
        </table>
        </div>
    </div>
</div>
</div>
 @endsection
 