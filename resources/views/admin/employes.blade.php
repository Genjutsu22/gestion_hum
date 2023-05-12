@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('style/employes.css')}}"> 
<link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href = "https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>

    <link rel="stylesheet" href = "{{asset('style/head.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
@endsection
@section('title')
   Liste des employes
@endsection
@section('content')
@section('icon')        
 <a  href="{{ route('logout')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"><i id="dropbtn" class="fas fa-power-off"></i></a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
@endsection
@include('admin.head')

<script type="text/javascript" src="/media/js/site.js?_=e9941f271f8b970b156847cf7274c719" data-domain="datatables.net" data-api="https://plausible.sprymedia.co.uk/api/event"></script>
  <script src="/media/js/dynamic.php?comments-page=examples%2Fstyling%2Fbootstrap5.html"></script>
  <!-- <script defer async src="https://media.ethicalads.io/media/client/ethicalads.min.js" onload="window.dtAds()" onerror="window.dtAds()"></script> -->
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/js/bootstrap.min.js"></script>
  <script type="text/javascript" class="init">
  

$(document).ready(function () {
    $('#student-datatable').DataTable();
});
$(document).ready(function(){
        $("#alert").show();
     });
     setTimeout(function() {
        $("#alert").fadeOut();
     }, 5000);

  </script>
 
 <div class="container-1 ">



@if(session('error'))
    <div id="alert" class="alert alert-danger" style="display:none; text-align:center;">
        <i class="fas fa-exclamation-circle"></i>   <strong>{{session('error')}}</strong> 
    </div>
@elseif(session('success'))
    <div id="alert" class="alert alert-success" style="display:none; text-align:center;">
        <i class="fas fa-check-circle"></i>   <strong>{{session('success')}}</strong> 
    </div>
@endif
<h1>Les employes : </h1>
<h6>Vous pouvez ajoutez modifier supprimer ou bien voir les demandes de congés d'un employé</h6>
<div class="add_button">
<button type="button" class="btn btn-default add-student-btn" data-bs-toggle="modal" data-bs-target="#myModal_add"><i class="fa fa-plus"></i> Ajouter employé</button>
</div>
<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>
                <th >CIN</th>
                <th >Nom</th>
                <th >Prenom</th>
                <th >Email</th>
                <th >Ville</th>
                <th >Département</th>
                <th >Profession</th>
                <th >Actions</th>
            </tr>
</thead>
<tbody>
@foreach($data as $arr)
  <tr class="table-light">
    <th>{{$arr->cin}}</th>
    <th>{{$arr->nom}}</th>
    <th>{{$arr->prenom}}</th>
    <th>{{$arr->email}}</th>
    <th>{{$arr->ville}}</th>
    <th>{{$arr->nom_depart}}</th>
    <th>{{$arr->nom_prof}}</th>
    <th>
    <form action="{{ route('destroy', $arr->id_personne) }}" method="POST" id="delete-form-{{ $arr->id_personne }}">
            @csrf
            @method('DELETE')
    </form>
    <form action="{{ route('conge_details', $arr->id_employe) }}" method="get" id="show-form-{{ $arr->id_employe }}">
          @csrf
    </form>
            <button type="button" class="btn btn-default edit-student-btn"  data-personne-id="{{$arr->id_personne}}"
    data-personne-nom="{{$arr->nom}}"
    data-personne-prenom="{{$arr->prenom}}"
    data-personne-email="{{$arr->email}}"
    data-personne-ville="{{$arr->id_adresse}}"
    data-personne-departement="{{$arr->id_depart}}"
    data-personne-profession="{{$arr->id_prof}}"
    data-personne-bureau ="{{$arr->num_bureau}}"
    data-employe-idemploye = "{{$arr->id_employe}}"
    data-personne-cin = "{{$arr->cin}}"
    data-bs-toggle="modal" data-bs-target="#myModal"><i class="fa fa-edit"></i></button>            
    <button type="submit" class="btn btn-default delete-student-btn" data-personne-id="{{$arr->id_personne}}"><i class="fa fa-trash"></i></button>
    <button type="submit" class="btn btn-default show-student-btn"  data-employe-id="{{$arr->id_employe}}" ><i class="fa fa-eye"></i></button>
    
    </th>
  </tr>
@endforeach 
</tbody>
</table>
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un employé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Remplir les champs suivants :</h3>
  
    <!-- Form Wrapper -->
    <form name="registration-form" id="registrationForm" method="POST" action="{{route('personne.update')}}" role="form">
        @csrf
      <input name="idemploye" id="idemploye" style="display :none;" value="">
      <input name="idpersonne" id="idpersonne" style="display :none;" value="">
      <div class="form-floating">
        <input type="text" name="cin" class="myform-control" id="cin" placeholder="CIN" value="" required/>
        <label for="cin">CIN</label>
      </div>
      <div class="form-floating">
        <input type="text" name="firstName" class="myform-control" id="firstName" placeholder="First Name" value="" required/>
        <label for="firstName">First Name</label>
      </div>
      <div class="form-floating">
        <input type="text" name="lastName" class="myform-control" id="lastName" placeholder="Last Name" value="" required/>
        <label for="lastName">Last Name</label>
      </div>
      <div class="form-floating">
        <input type="email" name="emailAddress" class="myform-control" id="emailAddress" placeholder="Email Address" value="" required />
        <label for="emailAddress">Email Address</label>
      </div>
      <div class="form-floating">
         <select class="custom-select" id="inputGroupSelect02" name="ville_id" required>
           @foreach($villes as $ville)
            <option value="{{$ville->id_adresse}}">{{$ville->ville}}</option>
         @endforeach
             </select>
       </div>
      
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect03" name="depart_id" required>
    @foreach($departs as $dep)
    <option value="{{$dep->id_depart}}" >{{$dep->nom_depart}}</option>
    @endforeach
  </select>
</div>  
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect04" name="prof_id" required>
    @foreach($profs as $prof)
    <option value="{{$prof->id_prof}}">{{$prof->nom_prof}}</option>
    @endforeach
  </select>

</div>
<div class="form-floating">
        <input type="text" name="bureau" class="myform-control" id="num_bureau" placeholder="N° Bureau" value="" required/>
        <label for="Bureau">N° Bureau</label>
  </div>

    <!--/ Form Wrapper -->
  </section>
  <!--/ Simple Registration Form -->
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="input" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>

<!-- modal add -->
<div class="modal fade bd-example-modal-lg" id="myModal_add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un employé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Remplir les champs suivants :</h3>
    <!-- Form Wrapper -->
    <form name="registration-form" id="registrationForm" method="POST" action="{{route('ajouter_employe')}}" role="form">
        @csrf
      <div class="form-floating">
        <input type="text" name="cin" class="myform-control" id="cin" placeholder="CIN" value="" required/>
        <label for="cin">CIN</label>
      </div>
      <div class="form-floating">
        <input type="text" name="nom" class="myform-control" id="nom" placeholder="Nom" value="" required/>
        <label for="Nom">Nom</label>
      </div>
      <div class="form-floating">
        <input type="text" name="prenom" class="myform-control" id="prenom" placeholder="Prénom" value="" required/>
        <label for="Prenom">Prénom</label>
      </div>
      <div class="form-floating">
        <input type="email" name="email" class="myform-control" id="email" placeholder="Email Address" value="" required />
        <label for="email">Email</label>
      </div>
      <div class="form-floating">
        <input type="password" name="motdepasse" class="myform-control" id="motdepasse" placeholder="Mot de passe" value="" required />
        <label for="motdepasse">Mot de passe</label>
      </div>
      
      <div class="form-floating">
    
         <select class="custom-select" id="inputGroupSelect02" name="ville_id" required>
         <option value="" disabled selected>Ville</option>
           @foreach($villes as $ville)
            <option value="{{$ville->id_adresse}}">{{$ville->ville}}</option>
         @endforeach
             </select>
       </div>
      
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect03" name="depart_id" required>
  <option value="" disabled selected>Département</option>
    @foreach($departs as $dep)
    <option value="{{$dep->id_depart}}" >{{$dep->nom_depart}}</option>
    @endforeach
  </select>
</div>  
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect04" name="prof_id" required>
  <option value="" disabled selected>Profession</option>
    @foreach($profs as $prof)
    <option value="{{$prof->id_prof}}">{{$prof->nom_prof}}</option>
    @endforeach
  </select>

</div>
<div class="form-floating">
        <input type="text" name="bureau" class="myform-control" id="num_bureau" placeholder="N° Bureau" value="" required/>
        <label for="Bureau">N° Bureau</label>
  </div>

    <!--/ Form Wrapper -->
  </section>
  <!--/ Simple Registration Form -->
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="input" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
<script>
 
 $(document).on("click", ".delete-student-btn", function (){
    const personneId = $(this).data('personne-id');
    const deleteForm = document.getElementById(`delete-form-${personneId}`);
    if (confirm('Are you sure you want to delete this record?')) {
    deleteForm.submit();
    }
});
$(document).on("click", ".show-student-btn", function (){
    const employeID = $(this).data('employe-id');
    const showform = document.getElementById(`show-form-${employeID}`);
    showform.submit();
    
});
    $(document).on("click", ".edit-student-btn", function () {
       var personne = $(this).data('personne-id');
        var Nom = $(this).data('personne-nom');
        var Prenom = $(this).data('personne-prenom');
        var Email = $(this).data('personne-email');
       var  Ville = $(this).data('personne-ville');
        var departement =$(this).data('personne-departement');
        var profession =$(this).data('personne-profession');
        var bureau = $(this).data('personne-bureau');
        var employe = $(this).data('employe-idemploye');
        var cin = $(this).data('personne-cin');
        $("#firstName").val(Nom);
        $("#lastName").val(Prenom);
        $("#emailAddress").val(Email);
        $("#inputGroupSelect02").val(Ville);
        $('#inputGroupSelect03').val(departement);
        $("#inputGroupSelect04").val(profession);
        $("#num_bureau").val(bureau);
        $("#idpersonne").val(personne);
        $("#idemploye").val(employe);
        $("#cin").val(cin);

    });
    
</script>

@endsection













 