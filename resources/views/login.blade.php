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
<!-- <header>
		<p>connecter vous a votre espace travail</p>
	</header> -->
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
					<h6>SFE © 2023</h6>
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

@endsection