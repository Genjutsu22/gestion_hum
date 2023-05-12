@extends('master.layout')
@section('style')

<link rel="stylesheet" href = "{{asset('style/home.css')}}"> 
<link rel="stylesheet" href = "{{asset('style/head.css')}}"> 

@section('title')
   Home
@endsection
@section('content')
@section('icon')
<div class="dropdown">
            <i class="fas fa-cog" id="dropbtn" onclick="toggleDropdown()"></i>
            <div class="dropdown-content" id="myDropdown">
            <a href="{{route('change_password',$data[0])}}" alt="Change Password">Change Password</a>
            <a href="{{ route('logout')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" alt="LOGOUT">LOGOUT <i class="fas fa-power-off"></i></a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
            </div>
@endsection


<div class="container-1">
@if($type == "admin")
@include('admin.head')
@include('admin.svg_admin')

<div class="text-area">
<p class="ttl">Bienvenue, <br>{{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Bienvenue dans votre espace {{$type}}, vous pouvez naviguez en utilisant les liens en haut !</p>
<a href="{{ route('apropos') }}">
  <button type="button" class="custom-btn btn-13">À propos <span class="fas fa-arrow-right"></span></button>
</a>

</div>
</div>
@elseif($type == "employe")
@include('employes.head')
@include('employes.svg_employe')
<div class="text-area">
<p class="ttl">Bienvenue,  <br>{{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Bienvenue dans votre espace {{$type}}, vous pouvez naviguez en utilisant les liens en haut !</p>
<a href="{{ route('apropos') }}">
  <button type="button" class="custom-btn btn-13">À propos <span class="fas fa-arrow-right"></span></button>
</a>
</div>
@elseif($type == "candidat")
@include('candidat.head')
@include('candidat.svg_candidat')
<div class="text-area">
<p class="ttl">Bienvenue, <br>{{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Bienvenue dans votre espace {{$type}}, vous pouvez naviguez en utilisant les liens en haut !</p>
<a href="route('apropos')">
  <button type="button" class="custom-btn btn-13">À propos <span class="fas fa-arrow-right"></span></button>
</a>
</div>
@endif
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

