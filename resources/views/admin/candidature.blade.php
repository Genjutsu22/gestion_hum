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
   Conges
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
<h1>Les demandes de candidature pour l'offre <br>{{$offres[0]->nom_depart." ".$offres[0]->nom_prof}}</h1>
<h6>Accepter ou refuser</h6>
<div class="add_button">
<button type="button" class="btn btn-default add-student-btn" data-bs-toggle="modal" data-bs-target="#myModal_add"><i class="fa fa-plus"></i> Ajouter candidat</button>
</div>
<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>
                <th >CIN</th>
                <th >Nom</th>
                <th >Prénom</th>
                <th >ville</th>
                <th>CV</th>
                <th>Lettre de motivation</th>
                <th >Accepter/refuser</th>
            </tr>
</thead>
<tbody>
@foreach($demandes as $demande)
  <tr class="table-light">
    <th>{{$demande->cin}}</th>
    <th>{{$demande->nom}}</th>
    <th>{{$demande->prenom}}</th>
    <th>{{$demande->ville}}</th>
    <th>
  @if ($demande->cv)
    <a href="{{ url('download_offre', $demande->cv) }}" download>
      <button class="btn btn-primary"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
</th>
<th>
  @if ($demande->motivation)
    <a href="{{ url('download_offre', $demande->motivation) }}" download>
      <button class="btn btn-primary"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
</th>
    <th>
    <form action="{{route('accepter_offre',$demande->id_candidat)}}" method="post" id="accept-form-{{$demande->id_candidat}}">
            @csrf
        <input name="idoffre" id="idoffre" style="display :none;" value="">
    </form>
    <form action="{{route('refuse_offre',$demande->id_candidat)}}" method="post" id="refuse-form-{{$demande->id_candidat}}">
            @csrf
        <input name="idoffre" id="idoffre_ref" style="display :none;" value="">
    </form>
   
    <button type="submit" class="btn btn-default accept-offre" data-demande-id="{{$demande->id_candidat}}" data-offre-id="{{$demande->id_offre}}"><i class="fa fa-check-circle"></i></button>
    <button type="submit" class="btn btn-default refuse-offre" data-demande-id="{{$demande->id_candidat}}" data-offre-id="{{$demande->id_offre}}" ><i class="fa fa-times-circle"></i></button>      
    
  
   
    
    </th>
  </tr>
@endforeach 
</tbody>
</table>



 </div>
<script>
 
    document.querySelectorAll('.accept-offre').forEach((button) => {
        button.addEventListener('click', (event) => {
            const CandidatId = button.getAttribute('data-demande-id');
            const offreId = button.getAttribute('data-offre-id'); 
            $("#idoffre").val(offreId);
            const acceptForm = document.getElementById(`accept-form-${CandidatId}`);
            acceptForm.submit();
        });
    });
    document.querySelectorAll('.refuse-offre').forEach((button) => {
        button.addEventListener('click', (event) => {
            const CandidatId = button.getAttribute('data-demande-id');
            const offreId = button.getAttribute('data-offre-id'); 
            $("#idoffre_ref").val(offreId);
            const refuseForm = document.getElementById(`refuse-form-${CandidatId}`);
            refuseForm.submit();
        });
    });
</script>

@endsection













 