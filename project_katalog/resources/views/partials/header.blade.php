<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{!! asset('admincss/style.css') !!}">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <script src="{!! asset('admincss/script.css') !!}"></script>
   <div class="sidebar">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus icon'></i>
        <div class="logo_name">TOKOMEDIA</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
        <i class='bx bx-search'></i>
        <input type="text" id="searchInput" placeholder="Search..." oninput="searchItems()">
        <span class="tooltip">Search</span>
      </li>
      <li>
        <a href="/admin/index">
          <i class='bx bx-grid-alt'></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="/admin/profil">
         <i class='bx bx-user' ></i>
         <span class="links_name">User</span>
       </a>
       <span class="tooltip">User</span>
     </li>
     <li>
       <a href="/admin/datacategory">
         <i class='bx bx-category'></i>
         <span class="links_name">Category</span>
       </a>
       <span class="tooltip">Category</span>
     </li>
     <li>
       <a href="/admin/dataproduct">
         <i class='bx bx-cart-alt' ></i>
         <span class="links_name">Order</span>
       </a>
       <span class="tooltip">Order</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name">{{Auth::user()->username}}</div>
             <div class="job">Web designer</div>
           </div>
         </div>
        <a href="/admin/logout"><i class='bx bx-log-out' id="log_out" ></i></a>
     </li>
    </ul>
  </div>
  <script>
   function searchItems() {
      var input, filter, container, cards, card, title, i;
      input = document.getElementById("searchInput");
      filter = input.value.toUpperCase();
      container = document.getElementById("productContainer");
      cards = container.getElementsByClassName("card");

      for (i = 0; i < cards.length; i++) {
         title = cards[i].querySelector(".text-isi h6");
         if (title.innerHTML.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = "";
         } else {
            cards[i].style.display = "none";
         }
      }
   }
</script>
