@extends('master.layout')
@section('style')

<link rel="stylesheet" href = "{{asset('style/home.css')}}"> 
<link rel="stylesheet" href = "{{asset('style/head.css')}}"> 

@section('title')
   Home
@endsection
@section('content')
@if($type == "admin")
@section('icon')
<div class="dropdown">
            <i class="fas fa-cog" id="dropbtn" onclick="toggleDropdown()"></i>
            <div class="dropdown-content" id="myDropdown">
            <a href="#" alt="Change Password">Change Password</a>
            <a href="{{ route('logout')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" alt="LOGOUT">LOGOUT <i class="fas fa-power-off"></i></a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
            </div>
@endsection
@include('admin.head')
<!-- <img src="{{asset('images/emplo.svg')}}" class="bg-img"> -->

@include('admin.svg_admin')
<div class="text-area">
<p class="ttl">Bienvenue, {{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Bienvenue dans votre espace {{$type}}, vous pouvez naviguez en utilisant les liens en haut !</p>
<button class="btn-16">Read More</button>
</div>
@elseif($type="employe")
@section('icon')
<div class="dropdown">
            <i class="fas fa-cog" id="dropbtn" onclick="toggleDropdown()"></i>
            <div class="dropdown-content" id="myDropdown">
            <a href="#" alt="Change Password">Change Password</a>
            <a href="{{ route('logout')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" alt="LOGOUT">LOGOUT <i class="fas fa-power-off"></i></a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
            </div>
          
@endsection
@include('admin.head')
<img src="{{asset('images/empl.png')}}" class="bg-img"> 
<div class="text-area">
<p class="ttl">Bienvenue, {{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Bienvenue dans votre espace {{$type}}, vous pouvez naviguez en utilisant les liens en haut !</p>
</div>

@elseif($type="cnadidat")
@section('icon')
<div class="dropdown">
            <i class="fas fa-cog" id="dropbtn" onclick="toggleDropdown()"></i>
            <div class="dropdown-content" id="myDropdown">
            <a href="#" alt="Change Password">Change Password</a>
            <a href="{{ route('logout')}}"
                 onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();" alt="LOGOUT">LOGOUT <i class="fas fa-power-off"></i></a>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
            </div>
          
@endsection
@include('admin.head')
<img src="{{asset('images/empl.png')}}" class="bg-img"> 
<div class="text-area">
<p class="ttl">Bienvenue, {{ $data[1] }} {{$data[2]}}</p>
<p class="txt">Bienvenue dans votre espace {{$type}}, vous pouvez naviguez en utilisant les liens en haut !</p>
</div>
@endif

@endsection

