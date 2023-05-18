@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('style/changepass.css')}}"> 
    <link rel="stylesheet" href = "{{asset('style/head.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
@section('title')
   Changer mot de passe
@endsection
@section('content')

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
<br><br>
<h1>Choisir un mot de passe</h1>
<h6>Ici, vous pouvez changer votre mot de passe</h6>
<div class="container-2">
<div class="form-pass">
<form name="registration-form" id="registrationForm" method="POST" action="{{route('login')}}" role="form">
    <fieldset>
        <legend>Changer mot de passe !</legend>
        @csrf
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
<!-- <div class="wav"> -->
<svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
<defs>
<path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z"></path>
</defs>
<g class="parallax">
<use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7"></use>
<use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)"></use>
<use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)"></use>
<use xlink:href="#gentle-wave" x="48" y="7" fill="#fff"></use>
</g>
</svg>

<!-- </div> -->

<div class="content flex">
    <ul>
        <li><p class="foot">SFE © 2023 </p></li>
         <li> <p class="foot">Abdallah Oubella - ESTG </p></li>

  </ul>
</div>
@endsection













 