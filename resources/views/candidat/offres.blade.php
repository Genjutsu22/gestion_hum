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
   Les offres
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
<h1>Offres d'emploi : </h1>
<h6>Vous pouvez postuler pour un emploi</h6>
<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>
                <th >Département</th>
                <th >Profession</th>
                <th >Details</th>
                <th >Date de publication</th>
                <th >Type d'emploi</th>
                <th >Demande</th>
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
    <th>{{$offre->date_pub}}</th>
    <th>{{$offre->type_emploi}}</th>
    <th>
    <form action="{{ route('demande_emploi', $offre->id_offre) }}" method="post" id="demande-form-{{ $offre->id_offre }}">
          @csrf
          <input name="id_candidat" id="idcandidat" style="display :none;" value="{{$id}}">
    </form>
            <button type="button" class="btn btn-default apply-btn" data-id-offre="{{$offre->id_offre}}" ><i class="fas fa-briefcase"></i></button>                 
  </th>
  </tr>
@endforeach 
</tbody>
</table>

  

</div>
<script>

 $(document).on("click", ".apply-btn", function (){
    const offreID = $(this).data('id-offre');
    const showform = document.getElementById(`demande-form-${offreID}`);
    showform.submit();
    });
   
</script>

@endsection













 