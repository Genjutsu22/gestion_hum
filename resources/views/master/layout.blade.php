<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('style')
	<script src="https://kit.fontawesome.com/876d7409f1.js" crossorigin="anonymous"></script>
    <link rel="icon" href="{{asset('images/Logo-top.png')}}" style="height: 20px;" type="image/png">
    <title> @yield('title')</title>
</head>
<body>   
@yield('content') 
</body>
</html>