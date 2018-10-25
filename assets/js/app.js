document.addEventListener("DOMContentLoaded", function() {
  
  const hamburger        = document.getElementById('hamburger-menu');
  const lines            = document.querySelectorAll('.line');
  const sidenavContainer = document.querySelector('.sidenav-container');
  const submenu          = document.querySelector('.submenu');

  console.log(submenu);
  

  
  hamburger.addEventListener('click', () => {
    hamburger.classList.contains('is-clicked') ? hamburger.classList.remove('is-clicked') : hamburger.classList.add('is-clicked');
    sidenavContainer.classList.toggle('hidden');
  })


});