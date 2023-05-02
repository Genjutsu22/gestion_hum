<header>
     <a href="/" alt="">
     <img src="{{asset('images/logo2.png')}}" class="im_logo" href="/">
     </a>
       
        <ul class="ma_list">
            <li class="ele"><a href="\" alt="Accueil" class="first">Accueil</a></li>
            <li class="ele"><a href="\employes" alt="Liste Des Employés">Liste Des Employés</a></li>
            <li class="ele"><a href="\posts" alt="Liste Des Postes">Liste Des Postes</a></li>
            <li class="ele"><a href="\demandes" alt="Offres D'emploi">Offres D'emploi</a></li>
            <li class="ele">
            @yield('icon')
            </li>
        </ul>
    </header>
    
  
    <script>
      function toggleDropdown() {
  var dropdownContent = document.getElementById("myDropdown");
  dropdownContent.classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('#dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    for (var i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>