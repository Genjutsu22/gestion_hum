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
  Offres d'emploi
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
@php 
$types = [
    "Emploi à temps plein",
    "Emploi à temps partiel",
    "Contrat à durée déterminée",
    "Contrat à durée indéterminée",
    "Travail temporaire",
    "Stage"
];
@endphp


@if(session('error'))
    <div id="alert" class="alert alert-danger" style="display:none; text-align:center;">
        <i class="fas fa-exclamation-circle"></i>   <strong>{{session('error')}}</strong> 
    </div>
@elseif(session('success'))
    <div id="alert" class="alert alert-success" style="display:none; text-align:center;">
        <i class="fas fa-check-circle"></i>   <strong>{{session('success')}}</strong> 
    </div>
@endif
<h1>Les offres d'emploi</h1>
<h6>Voir les offres et chaque demandes associés</h6>
<div class="add_button">
<button type="button" class="btn btn-default add-student-btn" data-bs-toggle="modal" data-bs-target="#myModal_add_candidat"><i class="fa fa-plus"></i> Ajouter candidat</button>
<button type="button" class="btn btn-default add-student-btn" data-bs-toggle="modal" data-bs-target="#myModal_add_offre"><i class="fa fa-plus"></i> Ajouter Offre</button>
</div>

<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>
                <th >ID</th>
                <th >Département</th>
                <th >Profession</th>  
                <th >Date de Publication</th>
                <th >Detail </th>
                <th >Type d'emploi </th>
                <th > Actions </th>
            </tr>
</thead>
<tbody>
@foreach($offres as $offre)
  <tr class="table-light">
    <th>{{$offre->id_offre}}</th>
    <th>{{$offre->nom_depart}}</th>
    <th>{{$offre->nom_prof}}</th>
    <th>{{$offre->date_pub}}</th>
    <th><a href="{{ url('download_offre',$offre->detail) }}" download>
  <button class="btn btn-primary"><i class="fa fa-download"></i></button>
</a></th>
    <th>{{$offre->type_emploi}}</th>
    <th>
    <form action="{{route('delete_offre',$offre->id_offre)}}" method="post" id="delete-form-{{$offre->id_offre}}">
            @csrf
            @method('DELETE')
    </form>
    <form action="{{ route('offres_details', $offre->id_offre) }}" method="get" id="show-form-{{ $offre->id_offre }}">
          @csrf
    </form>
    <form action="{{ route('offres_inactive', $offre->id_offre) }}" method="post" id="inactive-form-{{ $offre->id_offre }}">
          @csrf
    </form>
    <button type="button" class="btn btn-default edit-offre-btn"  data-offre-id="{{$offre->id_offre}}"
    data-depart-id="{{$offre->id_depart}}"
    data-prof-id="{{$offre->id_prof}}"
    data-offre-details="{{$offre->detail}}"
    data-type="{{$offre->type_emploi}}"
    data-bs-toggle="modal" data-bs-target="#myModal_offre"><i class="fa fa-edit" title="modifier"></i></button>            
    <button type="submit" class="btn btn-default delete-offre-btn" data-id-offre="{{$offre->id_offre}}"><i class="fa fa-trash" title="supprimer"></i></button>
    <button type="submit" class="btn btn-default show-offre-btn"  data-id-offre="{{$offre->id_offre}}" ><i class="fa fa-eye" title="voir les demandes"></i></button>
    <button type="submit" class="btn btn-default inactive-offre-btn" data-id-offre="{{$offre->id_offre}}"><i class="fas fa-ban" title="terminer l'offre"></i> </button>
    </th>
  </tr>
@endforeach 
</tbody>
</table>


<!-- modal add-->
<div class="modal fade bd-example-modal-lg" id="myModal_add_offre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un offre d'emploi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Choisi le département, le poste et ajouter les details :</h3>
    <form action="{{ route('upload.file') }}" method="post" id="add-offre-form" enctype="multipart/form-data">
          @csrf
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect03" name="iddepart" required>
  <option value="" disabled selected>Département</option>
    @foreach($departs as $dep)
    <option value="{{$dep->id_depart}}" >{{$dep->nom_depart}}</option>
    @endforeach
  </select>
</div>  
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect04" name="idprof" required>
  <option value="" disabled selected>Profession</option>
    @foreach($profs as $prof)
    <option value="{{$prof->id_prof}}">{{$prof->nom_prof}}</option>
    @endforeach
  </select>   
</div>
<div class="form-floating">
  <select class="custom-select" id="inputGroupSelect05" name="typemploi" required>
  <option value="" disabled selected>Type d'emploi</option>
    @foreach($types as $type)
    <option value="{{$type}}">{{$type}}</option>
    @endforeach
  </select>   
</div>

<div class="file-upload">
  <div class="file-select">
    <div class="file-select-button">Choose File</div>
    <div class="file-select-name">Ajouter un descriptif...</div>
    <input type="file" name="chooseFile" class="choose-file" required>
  </div>
</div>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
  </div>
<!-- modal edit -->
<div class="modal fade bd-example-modal-lg" id="myModal_offre" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un offre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Remplir les champs :</h3>
    <form action="{{ route('conge_refuse') }}" method="post" id="update-form">
          @csrf
          <input type="text" style="display: none;" name="idoffre" id="idoffre" value="">
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
  <select class="custom-select" id="inputGroupSelect06" name="typemploi" required>
    @foreach($types as $type)
    <option value="{{$type}}">{{$type}}</option>
    @endforeach
  </select>   
</div>
<div class="file-upload">
  <div class="file-select">
    <div class="file-select-button">Choose File</div>
    <div class="file-select-name">Ajouter un descriptif...</div required>
    <input type="file" name="chooseFile" class="choose-file">
  </div>
</div>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
  </div>
  <div class="modal fade bd-example-modal-lg" id="myModal_add_candidat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un candidat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Remplir les champs suivants :</h3>
    <!-- Form Wrapper -->
    <form name="registration-form" id="registrationForm" method="POST" action="{{route('ajouter_candidat')}}" role="form" enctype="multipart/form-data">
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
       <div class="file-upload">
<div class="form-floating">
<div class="file-upload">
  <div class="file-select">
    <div class="file-select-button">Choose File</div>
    <div class="file-select-name">Ajouter CV ...</div>
    <input type="file" name="CV" class="choose-file" required>
  </div>
</div>
</div>
<div class="file-upload">
  <div class="file-select">
    <div class="file-select-button">Choose File</div>
    <div class="file-select-name">Ajouter lettre de motivation ...</div required>
    <input type="file" name="LMV" class="choose-file">
  </div>
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
 
 
    $(document).on("click", ".delete-offre-btn", function () {
        var idoffre = $(this).data('id-offre');
    const deleteForm = document.getElementById(`delete-form-${idoffre}`);
    if (confirm('Are you sure you want to delete this record?')) {
    deleteForm.submit();
    }
    });

    $(document).on("click", ".show-offre-btn", function (){
    const offreID = $(this).data('id-offre');
    const showform = document.getElementById(`show-form-${offreID}`);
    showform.submit();
    });
    $(document).on("click", ".inactive-offre-btn", function (){
    const offreID = $(this).data('id-offre');
    const inactiveform = document.getElementById(`inactive-form-${offreID}`);
    inactiveform.submit();
    });
    

$(document).on("click", ".edit-offre-btn", function () {
       var offre = $(this).data('id-offre');
        var depart = $(this).data('id-depart');
        var prof = $(this).data('id-prof');
        var type = $(this).data('type');
        $("#idoffre").val(offre);
        $("#inputGroupSelect03").val(depart);
        $("#inputGroupSelect04").val(prof);
        $("#inputGroupSelect06").val(type);
    });



    $('.choose-file').bind('change', function () {
    var filename = $(this).val();
    var ext = filename.split('.').pop().toLowerCase();

    if (/^\s*$/.test(filename)) {
        $(this).closest('.file-upload').removeClass('active');
       // $(this).siblings('.file-select-name').text("No file chosen..."); 
    } else if ($.inArray(ext, ['pdf', 'doc', 'docx']) == -1) {
        alert("Only PDF and Word files are allowed!");
        $(this).val("");
        $(this).closest('.file-upload').removeClass('active');
       // $(this).siblings('.file-select-name').text("No file chosen..."); 
    } else {
        $(this).closest('.file-upload').addClass('active');
        $(this).siblings('.file-select-name').text(filename);
    }
});

</script>

@endsection













 