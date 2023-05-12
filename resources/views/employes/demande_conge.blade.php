@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('style/changepass.css')}}"> 
    <link rel="stylesheet" href = "{{asset('style/head.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
@endsection
@section('title')
   Demande congé
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

@include('employes.head')
@php
    $types = [
        "Congé annuel",
        "Congé de maladie",
        "Congé maternité/paternité",
        "Congé parental",
        "Congé de mariage",
        "Congé de deuil",
        "Congé sans solde",
        "Congé sabbatique"
    ];
@endphp

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
<h1>Demande congé</h1>
<h6>Ici, vous pouvez demander un congé</h6>
<div class="container-2">
<div class="form-pass">
<form name="registration-form" id="registrationForm" method="POST" action="{{route('demande_conge')}}" role="form" enctype="multipart/form-data">
    <fieldset>
        <legend>Remplir la demande</legend>
        @csrf
      <input name="id_employe" id="idemploye" style="display :none;" value="{{$id}}">
      <div class="form-floating">
        <input type="date" id="myDate" name="datedebut" class="myform-control"  placeholder="Date debut" value="" required/>
        <label for="oldpass">Date debut</label>
      </div>
      <div class="form-floating">
        <input type="date" id="myDate" name="datefin" class="myform-control"  placeholder="Date fin" value="" required/>
        <label for="nvpass">Date fin</label>
      </div>
      <div class="form-floating">
         <select class="custom-select" id="inputGroupSelect02" name="type" required>
         <option value="" disabled selected>Type de congé</option>
           @foreach($types as $type)
            <option value="{{$type}}">{{$type}}</option>
         @endforeach
             </select>
      </div>
             <div class="file-upload">
<div class="file-upload">
  <div class="file-select">
    <div class="file-select-button">Choose File</div>
    <div class="file-select-name">Ajouter une certifcat médical ...</div>
    <input type="file" name="CM" class="choose-file">
  </div>
</div>
 </div>
      <button type="submit" class="custom-btn btn-13">Envoyer</button>
      </fieldset>
</form>
</div>
@include('employes.svg_demande')
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
</script>
@endsection













 