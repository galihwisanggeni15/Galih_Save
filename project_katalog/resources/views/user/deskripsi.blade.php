@extends('layoutuser.app')

@section('title', 'Deskripsi Barang')

@section('content')
<div class="home-section">
    <div class="deskripsi">
        <div class="card">
            <img src="{{ asset('upload/' . $data->image) }}" alt="GAMBAR" width="500px" height="400px">
            <div class="text">
                <table>
                    <tbody>
                        <tr class="jarakk">
                            <td class="jarak">Kategori Barang</td>
                            <td>: {{$data->category_id}}</td>
                        </tr>
                        <tr>
                            <td class="jarak">Nama Barang</td>
                            <td>: {{$data->nama}}</td>
                        </tr>
                        <tr>
                            <td class="jarak">Harga Barang</td>
                            <td>: {{$data->price}}</td>
                        </tr>
                        <tr>
                            <td class="jarak">Stok Barang</td>
                            <td>: {{$data->stok}}</td>
                        </tr>
                        <tr>
                            <td class="jarak">Status Barang</td>
                            @if($data->status == 1)
                            <td>: Aktif</td>
                            @else
                            <td>: Tidak Aktif</td>
                            @endif
                        </tr>
                        <tr>
                            <td class="jarak">Deskripsi Barang</td>
                            <td class="deskripsii">: {{$data->description}}</td:>
                        </tr>
                    </tbody>
                </table>
                <div class="butbuy">
                    @if($data->status == 1 && $data->stok > 0)
                    <a href="/user/linkbeliproduk/{{$data->id}}">Beli Langsung</a>
                    @else
                    <p>Maaf barang tidak aktif atau stok habis</p>
                    @endif
                    <a href="http://">Keranjang</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
