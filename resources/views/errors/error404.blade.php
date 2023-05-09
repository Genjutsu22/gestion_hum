@extends('master.layout')
@section('style')

<link rel="stylesheet" href = "{{asset('style/error_page.css')}}"> 
@endsection
@section('title')
   Page n'existe pase !
@endsection
@section('content')
<div class="sect-1">
   <p class='tit'>Désolé !</p>
@include('errors.error')

<p> la page que vous avez demandée n'existe pas. Veuillez vérifier l'URL ou contacter l'administrateur du site pour obtenir de l'aide. <a href="/" >Retour à l'acceuil</a></p>

</div>
@endsection