@extends('master.layout')
@section('style')
<link rel="stylesheet" href = "{{asset('style/employes.css')}}"> 
<link rel="stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css"> 
<link rel="stylesheet" href = "https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>

    <link rel="stylesheet" href = "{{asset('style/head.css')}}"> 
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
@endsection
@section('title')
   Liste des employes
@endsection
@section('content')
@include('admin.head')
<script type="text/javascript" src="/media/js/site.js?_=e9941f271f8b970b156847cf7274c719" data-domain="datatables.net" data-api="https://plausible.sprymedia.co.uk/api/event"></script>
	<script src="/media/js/dynamic.php?comments-page=examples%2Fstyling%2Fbootstrap5.html"></script>
	<script defer async src="https://media.ethicalads.io/media/client/ethicalads.min.js" onload="window.dtAds()" onerror="window.dtAds()"></script>
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
	<script type="text/javascript" language="javascript" src="../resources/demo.js"></script>
	<script type="text/javascript" class="init">
	

$(document).ready(function () {
	$('#example').DataTable();
});


	</script>
<div class="container-1 ">
<h1>RWD List to Table</h1>
<table id="example" class="table table-striped table-hover" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Email</th>
                <th>Ville</th>
                <th>Quartier</th>
                <th>Departement</th>
                <th>Profession</th>
            </tr>
        </thead>
        <tbody>
@foreach($data as $arr)
<tr class="table-light">
@foreach($arr as $k => $v)

                <th>{{$v}}</th>
           
@endforeach
</tr>
@endforeach
</tbody>
</table>

</div>
@endsection