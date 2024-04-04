 @extends('layoutuser.app')

 @section('title', 'Welcome Toko Media')

 @section('content')
 <div class="home-section">
    <div class="text">
     <h1>Selamat datang di TOKOMEDIA</h1>
     <div class="index">
      <div class="container" id="productContainer">
         @foreach ($products as $item)
         <div class="card">
            <img src="../upload/{{$item->image}}" alt="GAMBAR" width="100%" height="200px">
            <div class="text-isi">
               <h6>{{$item->nama}}</h6>
               <p class="desk">{{$item->description}}</p>
               <p>Rp. {{ number_format($item->price) }}</p>
               <a href="/user/lengkap/{{$item->id}}">Selengkapnya</a>
            </div>
         </div>
         @endforeach
      </div>
     </div>
     </div>
</div>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

 @endsection
 