document.addEventListener("DOMContentLoaded", function() {
  
  const hamburger = document.getElementById('hamburger-menu');
  const lines     = document.querySelectorAll('.line');
  const menu      = document.querySelector('.menu');

  
  hamburger.addEventListener('click', (e) => {
    e.preventDefault();
    hamburger.classList.contains('is-clicked') ? hamburger.classList.remove('is-clicked') : hamburger.classList.add('is-clicked');
    menu.classList.toggle('is-open');
  })
  
  document.querySelector('main').addEventListener('click', function(){
    menu.classList.remove('is-open');
  });

});