// Toggle Class Active

let navbarNav = document.querySelector(".navbar-nav");
let humburgerMenu = document.querySelector("#humburger-menu");

// Ketika di klik
humburgerMenu.addEventListener("click", function (e) {
  e.preventDefault();
  navbarNav.classList.toggle("active");
});
// Klik di luar nav

document.addEventListener("click", function (e) {
  if (!humburgerMenu.contains(e.target) && !navbarNav.contains(e.target)) {
    navbarNav.classList.remove("active");
  }
});
