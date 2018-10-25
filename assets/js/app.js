document.addEventListener("DOMContentLoaded", function() {
  
  const hamburger = document.getElementById('hamburger-menu');
  const lines = document.querySelectorAll('.line');
  
  hamburger.addEventListener('click', () => {
    hamburger.classList.contains('is-clicked') ? hamburger.classList.remove('is-clicked') : hamburger.classList.add('is-clicked');
  })


});