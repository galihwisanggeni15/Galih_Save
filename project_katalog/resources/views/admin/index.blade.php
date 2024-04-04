 @extends('layout.app')

 @section('title', 'Welcome Toko Media')

 @section('content')
 <div class="home-section">
    <div class="text">
     <h1>Selamat datang {{Auth::user()->username}}</h1>
     <div class="index">
      <div class="container" id="productContainer">
         @foreach ($products as $item)
         <div class="card">
            <img src="../upload/{{$item->image}}" alt="GAMBAR" width="100%" height="200px">
            <div class="text-isi">
               <h6>{{$item->nama}}</h6>
               <p class="desk">{{$item->description}}</p>
               <p>Rp. {{ number_format($item->price) }}</p>
            </div>
         </div>
         @endforeach
      </div>
     </div>
     </div>
</div>
 @endsection
 