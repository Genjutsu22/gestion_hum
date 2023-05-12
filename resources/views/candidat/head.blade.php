<header>
     <a href="/" alt="">
     <img src="{{asset('images/logo2.png')}}" class="im_logo" href="/">
     </a>
       
        <ul class="ma_list">
            <li class="ele"><a href="\" alt="Accueil" class="first">Accueil</a></li>
            <li class="ele"><a href="{{route('info_candidat')}}" alt="Mon compte">Mon compte</a></li>
            <li class="ele"><a href="{{route('offres_candid')}}" alt="Les offres">Les offres</a></li>
            <li class="ele"><a href="{{route('mes_demandes_candid')}}" alt="Mes demandes de candidatures">Mes demandes de candidatures</a></li>
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