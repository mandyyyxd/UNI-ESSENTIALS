document.addEventListener('DOMContentLoaded', function() {
  document.getElementById("menu").addEventListener("click", function(event) {
      event.stopPropagation();
      document.querySelector(".navbar").classList.toggle("show");
  });

  document.body.addEventListener("click", function(event) {
      var navbar = document.querySelector(".navbar");
      if (!navbar.contains(event.target) && !document.getElementById("menu").contains(event.target)) {
          navbar.classList.remove("show");
      }
  });
});

document.addEventListener("DOMContentLoaded", function() {
    var cookieConsentModal = document.getElementById("cookieConsentModal");
    var acceptCookiesButton = document.getElementById("acceptCookiesButton");

    if (!sessionStorage.getItem("cookiesAccepted")) {
        cookieConsentModal.style.display = "block";
    }

    acceptCookiesButton.addEventListener("click", function() {
        sessionStorage.setItem("cookiesAccepted", "true");
        cookieConsentModal.style.display = "none";
    });
});