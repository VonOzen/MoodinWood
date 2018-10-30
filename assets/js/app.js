document.addEventListener("DOMContentLoaded", function() {
  
  const hamburger = document.getElementById('hamburger-menu');
  const lines     = document.querySelectorAll('.line');
  const body      = document.querySelector('body');

  
  hamburger.addEventListener('click', (e) => {
    e.preventDefault();
    body.classList.toggle('sidebar-open');
    hamburger.classList.contains('is-clicked') ? hamburger.classList.remove('is-clicked') : hamburger.classList.add('is-clicked');
  })
  
  document.getElementById('backdrop').addEventListener('click', function(){
    body.classList.remove('sidebar-open');
    hamburger.classList.remove('is-clicked');
  });

});