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


// Suppression des images produits
document.querySelectorAll('[data-delete]').forEach(function(a){
  a.addEventListener('click', function(event){
    event.preventDefault();
    fetch(a.getAttribute('href'), {
      method: 'DELETE',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({'_token': a.dataset.token})
    })//fin fetch
    .then(function(response){
      return response.json()
    })//fin then
    .then(function(data){
      if (data.success) {
        a.parentNode.parentNode.removeChild(a.parentNode)
      } else {
        alert(data.error)
      }
    })//fin second then
    .catch(function(error){
      alert(error)
    })//fin catch
  });//fin callback click
});//fin foreacg

});