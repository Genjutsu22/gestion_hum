@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('style/changepass.css')}}"> 
    <link rel="stylesheet" href = "{{asset('style/head.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href = "{{asset('style/employes.css')}}"> 
<link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href = "https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>

@endsection
@section('title')
   Mon compte
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" class="init">
	
$(document).ready(function(){
        $("#alert").show();
     });
     setTimeout(function() {
        $("#alert").fadeOut();
     }, 5000);

	</script>
<div class="container-1 ">
@if(session('error'))
    <div id="alert" class="alert alert-danger" style="display:none; text-align:center;  color:aliceblue;">
        <i class="fas fa-exclamation-circle"></i>   <strong>{{session('error')}}</strong> 
    </div>
@elseif(session('success'))
    <div id="alert" class="alert alert-success" style="display:none; text-align:center; color:aliceblue;">
        <i class="fas fa-check-circle"></i>   <strong>{{session('success')}}</strong> 
    </div>
@endif
<h1>Mes informations</h1>
<h6>Ici, vous pouvez voir et modifier vos informations</h6>
<div class="container-2">
<div class="card">
  <h2>Mes informations</h2>
  <div class="card-content">
    <p><strong>CIN:</strong> {{$candidat->cin}}</p>
    <p><strong>Nom:</strong> {{$candidat->nom}}</p>
    <p><strong>Prénom:</strong> {{$candidat->prenom}} </p>
    <p><strong>Email:</strong> {{$candidat->email}}</p>
    <p><strong>Ville:</strong> {{$candidat->ville}} </p>
    <p><strong>CV:</strong> <a href="{{ url('download_offre', $candidat->cv) }}" target="_blank">Download CV</a></p>
    <p><strong>Lettre de Motivation:</strong> <a href="{{ url('download_offre', $candidat->motivation) }}" target="_blank">Download Lettre</a></p>
    <button type="button" class="custom-btn btn-13" id="btn-13" style="background-color:#63618e;" data-bs-toggle="modal" data-bs-target="#myModal_add_candidat"
    data-cin="{{$candidat->cin}}" data-nom="{{$candidat->nom}}"
    data-prenom="{{$candidat->prenom}}" data-adresse="{{$candidat->id_adresse}}"
    data-cv="{{$candidat->cv}}" data-lmv="{{$candidat->motivation}}" data-email="{{$candidat->email}}" >Modifier</button> 
  </div>
</div>
@include('candidat.svg_infos')
</div>
<div class="modal fade bd-example-modal-lg" id="myModal_add_candidat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modifier les informations </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <section class="registration-form">
                    <h3>Remplir les champs suivants :</h3>
                    <!-- Form Wrapper -->
                    <form name="registration-form" id="registrationForm" method="POST" action="{{route('edit_candidat')}}" role="form" enctype="multipart/form-data">
                        @csrf
                        <input name="idcandidat" id="idcandidat" style="display :none;" value="{{$id}}">
                        <input name="idpersonne" id="idpersonne" style="display :none;" value="{{$candidat->id_personne}}">
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
                            <select class="custom-select" id="inputGroupSelect02" name="ville_id" required>
                                @foreach($villes as $ville)
                                    <option value="{{$ville->id_adresse}}">{{$ville->ville}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="file-upload" id="file-upload">
                            <div class="form-floating">
                                <div class="file-select">
                                    <div class="file-select-button">Choose File</div>
                                    <div class="file-select-name">Ajouter CV ...</div>
                                    <input type="file" name="CV" class="choose-file" id="cv">
                                </div>
                            </div>
                        </div>
                        <div class="file-upload" id="file-upload">
                            <div class="file-select">
                                <div class="file-select-button">Choose File</div>
                                <div class="file-select-name">Ajouter lettre de motivation ...</div>
                                <input type="file" name="LMV" class="choose-file" id="lmv">
                            </div>
                        </div>
                        <!--/ Form Wrapper -->
                </section>
                <!--/ Simple Registration Form -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="input" class="btn btn-primary">Save changes</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

</div>
<script>
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
$(document).on("click", ".btn-13", function () {
        var nom = $(this).data('nom');
        var prenom = $(this).data('prenom');
        var cin = $(this).data('cin');
        var email = $(this).data('email');
        var ville = $(this).data('adresse');
        var cv = $(this).data('cv');
        var lmv = $(this).data('lmv');
        $("#nom").val(nom);
        $("#prenom").val(prenom);
        $("#cin").val(cin);
        $("#email").val(email);
        $("#cv").val(cv);
        $("#lmv").val(lmv);
        $("#inputGroupSelect02").val(ville);
    });
</script>
@endsection













 