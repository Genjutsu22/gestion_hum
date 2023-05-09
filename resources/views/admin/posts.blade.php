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
   Liste des posts
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
<h1>Les posts : </h1>
<h6>Vous pouvez ajoutez modifier supprimer les professions et les départements</h6>
<div class="add_button">
<button type="button" class="btn btn-default add-student-btn" data-bs-toggle="modal" data-bs-target="#myModal_depart"><i class="fa fa-plus"></i> Ajouter Département</button>
<button type="button" class="btn btn-default add-student-btn" data-bs-toggle="modal" data-bs-target="#myModal_prof"><i class="fa fa-plus"></i> Ajouter Profession</button>
</div>
<table id="student-datatable" class="table table-striped  table-hover table-highlight table-checkable" cellspacing="0">
<thead>
<tr>

                <th >Département</th>
                <th >Profession</th>
                <th >Nombre Des Employes</th>
                <th >Acions</th>
            </tr>
</thead>
<tbody>
@foreach($employes as $employe)
  <tr class="table-light">
    <th>{{$employe->nom_depart}}</th>
    <th>{{$employe->nom_prof}}</th>
    <th>{{$employe->num_employees}}</th>
    <th>
    <form action="{{ route('delete_prof', $employe->id_prof) }}" method="POST" id="delete-post-{{ $employe->id_prof }}">
            @csrf
            @method('DELETE')
    </form>
            <button type="button" class="btn btn-default edit-student-btn" 
    data-bs-toggle="modal" data-bs-target="#myModal_update" data-id-depart="{{$employe->id_depart}}" data-id-prof="{{$employe->id_prof}}" data-nom-prof="{{$employe->nom_prof}}" data-nom-depart="{{$employe->nom_depart}}"><i class="fa fa-edit"></i></button>            
    <button type="submit" class="btn btn-default delete-post" data-post-id="{{$employe->id_prof}}"><i class="fa fa-trash"></i></button>      
  </th>
  </tr>
@endforeach 
</tbody>
</table>

<div class="modal fade bd-example-modal-lg" id="myModal_depart" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter un département</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Saisir le libellé de département :</h3>
    <form action="{{ route('departement_add') }}" method="post" id="add-form">
          @csrf
          <div class="form-floating">
        <input type="text" name="nomdepart" class="myform-control" id="nomdepart" placeholder="Nom Département" value="" required/>
        <label for="nomdepartement">Nom Département</label>
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
  
  <!-- modal add profession -->
  <div class="modal fade bd-example-modal-lg" id="myModal_prof" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ajouter une profession</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Saisir le libellé de profession :</h3>
    <form action="{{ route('profession_add') }}" method="post" id="add-form">
          @csrf
          <div class="form-floating">
        <input type="text" name="nomprofession" class="myform-control" id="nomprofession" placeholder="Nom Profession" value="" required/>
        <label for="nomprofession">Nom Profession</label>
      </div> 
        
</section></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
    </form>
            </div>
        </div>
    </div>
  </div>
    <!-- modal update -->
   
 <div class="modal fade bd-example-modal-lg" id="myModal_update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modifier une profession ou un département</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <section class="registration-form">
    <h3>Saisir le libellé de profession ou département:</h3>
    <form action="{{ route('update_prof') }}" method="post" id="update-form">
        @csrf
          <input name="idprof" id="idprof" style="display :none;" value="">
          <input name="iddepart" id="iddepart" style="display :none;" value="">
          <div class="form-floating">
        <input type="text" name="nomprof" class="myform-control" id="nomprof_update" placeholder="Nom Profession" value="" required="">
        <label for="nomprofession">Nom Profession</label>
      </div> 
      <div class="form-floating">
        <input type="text" name="nomdepart" class="myform-control" id="nomdepart_update" placeholder="Nom Département" value="" required="">
        <label for="nomdepart">Nom Département</label>
      </div>
    
</section></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
    </form>
            </div>
        </div>
    </div>

</div>
<script>
 $(document).on("click", ".edit-student-btn", function () {
       var profID = $(this).data('id-prof');
       var profNOM = $(this).data('nom-prof');
       var departID= $(this).data('id-depart');
       var departNOM= $(this).data('nom-depart');
       $("#idprof").val(profID);
       $("#iddepart").val(departID);
       $("#nomdepart_update").val(departNOM);
       $("#nomprof_update").val(profNOM);
    });

    $(document).on("click", ".delete-post", function (){
    const postId = $(this).data('post-id');
    const deleteForm = document.getElementById(`delete-post-${postId}`);
    if (confirm('Are you sure you want to delete this record?')) {
    deleteForm.submit();
    }
});

</script>

@endsection













 