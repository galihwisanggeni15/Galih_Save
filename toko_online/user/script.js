function toggleMenu() {
  var navLink = document.getElementById("navLink");
  navLink.classList.toggle("slide");
}


document.addEventListener("DOMContentLoaded", function () {
  var cardTitles = document.querySelectorAll(".beranda .card-title");

  cardTitles.forEach(function (title) {
    var lineHeight = parseInt(window.getComputedStyle(title).lineHeight);
    var maxLines = 2;
    var maxHeight = lineHeight * maxLines;

    if (title.clientHeight > maxHeight) {
      title.style.overflow = "hidden";
      title.style.maxHeight = maxHeight + "px";
    }
  });
});


 document.addEventListener("DOMContentLoaded", function () {
   const searchInput = document.querySelector(".beranda .search input");
   const cards = document.querySelectorAll(".beranda .card");

   searchInput.addEventListener("input", function () {
     const searchTerm = searchInput.value.toLowerCase();

     cards.forEach(function (card) {
       const title = card
         .querySelector(".card-title")
         .textContent.toLowerCase();

       if (title.includes(searchTerm)) {
         card.style.display = "block";
       } else {
         card.style.display = "none";
       }
     });
   });
 });