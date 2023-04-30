@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{ asset('style/style_login.css') }}"> 

@endsection
@section('title')
   Login
@endsection
@section('content')
@if(session('modal') == 'password-incorrect')
 <script>
	alert('Email ou Mot de passe incorrect !');
 </script>
@endif
<p>Connectez-vous pour accéder <br> à votre espace !</p>
<div class="cont">	

<!--?xml version="1.0" standalone="no"?-->              <svg id="sw-js-blob-svg" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1">                    <defs>                         <linearGradient id="sw-gradient" x1="0" x2="1" y1="1" y2="0">                            <stop id="stop1" stop-color="rgba(93, 92, 139, 1)" offset="0%"></stop>                            <stop id="stop2" stop-color="rgba(93, 92, 139, 1)" offset="100%"></stop>                        </linearGradient>                    </defs>                <path fill="url(#sw-gradient)" d="M27.9,-31.2C35,-27.3,38.7,-17.4,40.6,-7.1C42.5,3.2,42.4,13.8,37.6,21.1C32.7,28.4,22.9,32.2,13.1,35.7C3.3,39.1,-6.6,42.2,-14.6,39.5C-22.6,36.8,-28.7,28.5,-32,19.9C-35.3,11.3,-35.7,2.4,-34.9,-6.8C-34.1,-16.1,-32,-25.8,-25.9,-29.9C-19.9,-34,-9.9,-32.5,0.2,-32.8C10.4,-33.1,20.8,-35.2,27.9,-31.2Z" width="100%" height="100%" transform="translate(50 50)" stroke-width="0" style="transition: all 0.3s ease 0s;" stroke="url(#sw-gradient)"></path>              </svg>
<div class="main">  
	
		<input type="checkbox" id="chk" aria-hidden="true">
		<div class="signup">
		<form method="post" role="form" action="{{ route('login') }}">
		@csrf
					<label for="chk" aria-hidden="true">Login</label>		
					<div class="input-group">
						<div class="zone-text">
						   <i class="fa-solid fa-envelope"></i>
							<input name="email" type="email" placeholder="Email" autocomplete="off" required>
						</div>
						<div class="zone-text">
							<i class="fa-solid fa-lock"></i>
							 <input type="password" name="password" placeholder="Mot de passe" autocomplete="off" required>
						 </div>
					</div>
					<input  type="submit" name="login" class="btn2" value="Login">
					
				</form>	
                
			</div>
			<div class="login" >
			<form role="form" method="post">
					<label for="chk" aria-hidden="true" class="lab">Mot de passe <br>&nbsp;&nbsp;&nbsp;&nbsp; oublié</label>
					<div class="input-group">
						<div class="zone-text">
							<i class="fa-solid fa-envelope"></i>
							 <input type="email" name="semail" placeholder="Email" autocomplete="off" required>
						 </div>
					</div>
					<input type="submit" name="signup" class="btn1" value= "Vérifier">
				</form>
           
			</div>
		 
	</div>
	</div>
	<footer><h6>SFE © 2023</h6></footer>
@endsection