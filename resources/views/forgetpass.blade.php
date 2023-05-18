@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{ asset('style/forgetpassword.css') }}"> 
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">
@endsection
@section('title')
   Forget password
@endsection
@section('content')
@if(session('error'))
<div id="alert" class="alert alert-danger" style="display:none; text-align:center;">
<i class="fas fa-exclamation-circle"></i>   <strong>{{session('error')}}</strong> 
</div>
@endif
@php
    $email = session('email');
    $maskedEmail = substr_replace($email, str_repeat('*', 6), 3, 6);
@endphp
<div class="container">
    
  <div class="row justify-content-md-center">
  <img src="{{asset('images/logo2.png')}}">
      <div class="col-md-4 text-center">
        <div class="row">
          <div class="col-sm-12 mt-5 bgWhite">
            <div class="title">
              Vérification OTP
              <h5>Saisir le code OTP envoyé par email </h5>
              <h6>{{ $maskedEmail}}</h6>
            </div>
            <form action="{{ route('login') }}" class="mt-5" method="POST">
  @csrf
  <input name="digit1" class="otp" type="text" oninput="digitValidate(this)" onkeyup="tabChange(1)" maxlength="1">
  <input name="digit2" class="otp" type="text" oninput="digitValidate(this)" onkeyup="tabChange(2)" maxlength="1">
  <input name="digit3" class="otp" type="text" oninput="digitValidate(this)" onkeyup="tabChange(3)" maxlength="1">
  <input name="digit4" class="otp" type="text" oninput="digitValidate(this)" onkeyup="tabChange(4)" maxlength="1">
  <input name="digit5" class="otp" type="text" oninput="digitValidate(this)" onkeyup="tabChange(5)" maxlength="1">
  
  <hr class="mt-4">
  <button type="submit" class="btn btn-primary btn-block mt-4 mb-4 customBtn">Vérifier</button>
</form>
          </div>
        </div>
      </div>
  </div>
</div>
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
<script>
    var i;
let digitValidate = function(ele){
  ele.value = ele.value.replace(/[^0-9]/g,'');
}

let tabChange = function(val){
    let ele = document.querySelectorAll('input');
    if(ele[val-1].value != ''){
      ele[val].focus()
    }else if(ele[val-1].value == ''){
      ele[val-2].focus()
    }   
 }
 
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/path/to/bootstrap-growl.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection