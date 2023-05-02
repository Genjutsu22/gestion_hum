@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{ asset('style/style_login.css') }}"> 
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Raleway:300,600" rel="stylesheet">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">@endsection
@section('title')
   Login
@endsection
@section('content')

@if(session('error'))
<div id="alert" class="alert alert-danger" style="display:none; text-align:center;">
<i class="fas fa-exclamation-circle"></i>   <strong> Email ou mot de passe !</strong> 
</div>
@endif

<div class="container">
   <section id="formHolder">

      <div class="row">

         <!-- Brand Box -->
         <div class="col-sm-6 brand">
           <img src="{{asset('images/logo2.png')}}">
            <div class="heading">
               <p>Connectez-vous<br> pour accéder à votre espace </p>
            </div>
         </div>


         <!-- Form Box -->
         <div class="col-sm-6 form">
                <!-- Signup Form -->
            <div class="login form-peice ">
            <form class="login-form" action="{{ route('login') }}" method="post">
            @csrf

               <p>Saisir votre adress email et mot de passe</p>
                  <div class="form-group">
                     <label for="loginemail">Email</label>
                     <input type="email" name="email" id="loginemail" class="email "required>
                     <span class="error"></span>
                  </div>

                  <div class="form-group">
                     <label for="loginPassword">Mot de passe</label>
                     <span class="error"></span>
                     <input type="password" name="password" id="loginPassword" class="email" required>
                     <span class="error"></span>
                  </div>

                  <div class="CTA">
                     <input type="submit" value="Login" name="login" id="submit">
                     <a href="#" class="switch">Mot de passe oublié</a>
                  </div>
               </form>
              
            </div>
            <!-- End Signup Form -->
            <!-- Login Form -->
            <div class="signup form-peice switched">
               
            <form class="signup-form" action="#" method="post">
            <p>Saisir votre adress email</p>
            <div class="form-group">
               <label for="email">Email Adersse</label>
               <input type="email" name="semail" id="email" class="email" required>
               <span class="error"></span>
            </div>


         <div class="CTA">
            <input type="submit" value="Vérifier" name="forget" id="submit" >
            <a href="#" class="switch" >Retoure à Login</a>
         </div>
         </form>
            </div><!-- End Login Form -->


         
         </div>
      </div>

   </section>
  
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="/path/to/bootstrap-growl.js"></script>
<script src="{{asset('script/login_script.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection