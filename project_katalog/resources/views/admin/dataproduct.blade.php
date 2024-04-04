 @extends('layout.app')

 @section('title', ' Data Produk')
  @section('content')
  <div class="home-section">
  <div class="product">
    <div class="card">
        <h1>Data Produk</h1>
        <div class="isi">
        <a class="btn mx-auto text-center " href="/admin/tambahdata">Tambah Data</a>
        <table class="table" border="1">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kategori</th>
              <th scope="col">Nama</th>
              <th scope="col">Price</th>
              <th scope="col">Gambar</th>
              <th scope="col">Stok</th>
              <th scope="col">Status</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{  $user->category_id}}</td>
        <td>{{ $user->nama }}</td>
        <td>Rp. {{ number_format($user->price) }}</td>
        <td><img src="../upload/{{ $user->image }}" alt="" width="50px"></td>
        <td>{{ $user->stok }}</td>
        @if ($user->status == 1)
            <td>Aktif</td>
        @else
            <td>Tidak Aktif</td>
        @endif
        <td>
            <a class="edit" href="/admin/edit/product/{{$user->id}}">Edit</a> || 
            <a class="tambah" href="/admin/hapus/product/{{$user->id}}">Hapus</a>
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
 