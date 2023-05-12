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
   Candidatures
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
@include('candidat.head')

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
<h1>Mes candidatures: </h1>
<h6>Ici, Vous pouvez voir vos demandes</h6>
<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>
                <th >Département</th>
                <th >Profession</th>
                <th >Details</th>
                <th >Type d'emploi</th>
                <th >Etat</th>
            </tr>
</thead>
<tbody>
@foreach($offres as $offre)
  <tr class="table-light">
    <th>{{$offre->nom_depart}}</th>
    <th>{{$offre->nom_prof}}</th>
    <th>
    @if ($offre->detail)
    <a href="{{ url('download_offre', $offre->detail) }}" download>
      <button class="btn btn-primary"><i class="fa fa-download"></i></button>
    </a>
  @else
    --------------
  @endif
    </th>
    <th>{{$offre->type_emploi}}</th>
    <th>
        @if($offre->accepted == '1')
        <i class="fas fa-check-double fa-lg fa-circle" title="accepter"></i>
        @elseif($offre->accepted == '0')
        <i class="fa fa-times-circle fa-lg" title="refuser"></i>
        @elseif($offre->accepted == null)
        <i class="fa fa-clock fa-lg"></i title="en attend">
        @endif
    </th>
  </tr>
@endforeach 
</tbody>
</table>

  

</div>
<script>
   
</script>

@endsection













 