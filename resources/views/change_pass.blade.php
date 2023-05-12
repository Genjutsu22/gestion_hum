@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('style/changepass.css')}}"> 
    <link rel="stylesheet" href = "{{asset('style/head.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
@if($type == "admin")
    @include('admin.head')
@elseif($type =="employe")
    @include('employes.head')
@elseif($type == "candidat")
    @include('candidat.head') 
@endif

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
<h1>{{$pers->nom." ".$pers->prenom}}</h1>
<h6>Ici, vous pouvez changer votre mot de passe</h6>
<div class="container-2">
<div class="form-pass">
<form name="registration-form" id="registrationForm" method="POST" action="{{route('passchange')}}" role="form">
    <fieldset>
        <legend>Changer mot de passe !</legend>
        @csrf
      <input name="idemploye" id="idemploye" style="display :none;" value="{{$pers->id_personne}}">
      <div class="form-floating">
        <input type="password" name="oldpass" class="myform-control" id="oldpass" placeholder="Ancien mot de passe" value="" required/>
        <label for="oldpass">Ancien mot de passe</label>
      </div>
      <div class="form-floating">
        <input type="password" name="nvpass" class="myform-control" id="nvpass" placeholder="Nouveau mot de passe" value="" required/>
        <label for="nvpass">Nouveau mot de passe</label>
      </div>
      <div class="form-floating">
        <input type="password" name="conpass" class="myform-control" id="conpass" placeholder="Confirmez le mot de passe" value="" required/>
        <label for="conpass">Confirmez le mot de passe</label>
      </div>
      <button type="submit" class="custom-btn btn-13">Changer</button>
      </fieldset>
</form>
</div>
@include('pass_svg')
</div>
</div>
@endsection













 