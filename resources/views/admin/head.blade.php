<header>
        <a href="\" class="logo">MyLogo</a>
        <ul>
            <li ><a href="\" alt="Accueil" class="first">Accueil</a></li>
            <li ><a href="\employes" alt="Liste Des Employés">Liste Des Employés</a></li>
            <li ><a href="\posts" alt="Liste Des Postes">Liste Des Postes</a></li>
            <li><a href="\demandes" alt="Offres D'emploi">Offres D'emploi</a></li>
            <li>
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