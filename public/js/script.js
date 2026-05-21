// Script untuk PKBM Sidandu Website
document.addEventListener("DOMContentLoaded", function () {
  // Set active nav item
  const currentUrl = window.location.pathname;
  const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

  navLinks.forEach((link) => {
    if (currentUrl.includes(link.getAttribute("href"))) {
      link.classList.add("active");
    }
  });
});
