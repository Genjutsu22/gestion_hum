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
<h1>Les demandes de congés{{" de ".$employe[0]->nom." ".$employe[0]->prenom}}</h1>
<h6>Accepter ou refuser</h6>
<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>
                <th >CIN</th>
                <th >Date début</th>
                <th >Date fin</th>
                <th >Certificat medical</th>
                <th >Date demande</th>
                <th >Accepter/refuser</th>
            </tr>
</thead>
<tbody>
@foreach($conges as $conge)
  <tr class="table-light">
    <th>{{$employe[0]->cin}}</th>
    <th>{{$conge->date_debut}}</th>
    <th>{{$conge->date_fin}}</th>
    <th>{{$conge->certificat_medical}}</th>
    <th>{{$conge->date_demande}}</th>
    <th>
    <form action="{{ route('conge_accept', $conge->id_conge) }}" method="post" id="accept-form-{{ $conge->id_conge }}">
            @csrf
    </form>
     
    <button type="submit" class="btn btn-default accept-conge" data-conge-id="{{$conge->id_conge}}" ><i class="fa fa-check-circle"></i></button>
    <button type="submit" class="btn btn-default delete-conge" data-conge-id="{{$conge->id_conge}}" data-bs-toggle="modal" data-bs-target="#myModal_show"><i class="fa fa-times-circle"></i></button>      
    
  
   
    
    </th>
  </tr>
@endforeach 
</tbody>
</table>


<!-- modal update -->
<div class="modal fade bd-example-modal-lg" id="myModal_show" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier un employé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Remplir la justification de refuse :</h3>
    <form action="{{ route('conge_refuse') }}" method="post" id="refuse-form">
          @csrf
          <input type="text" style="display: none;" name="idconge" id="idconge" value="">
          <div class="form-floating">
        <textarea name="justif" cols="100" class="myform-control" rows="10" id="justif" placeholder="Justification" required></textarea>
        <label for="jutif">Justification</label>
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
  
</div>
<script>
 
    document.querySelectorAll('.accept-conge').forEach((button) => {
        button.addEventListener('click', (event) => {
            const congeId = button.getAttribute('data-conge-id');
            const acceptForm = document.getElementById(`accept-form-${congeId}`);
            acceptForm.submit();
        });
    });
    $(document).on("click", ".delete-conge", function () {
        var idconge = $(this).data('conge-id');
        $("#idconge").val(idconge);
    });
</script>

@endsection













 