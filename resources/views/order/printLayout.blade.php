<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Maketas</title>
</head>
<body>
    <header>
        <a href="{{route('welcome')}}"><button>Atgal</button></a>
    </header>

    <iframe src="{{url('storage/'.$path)}}" style="position:fixed; top:40px; left:0; bottom:0; right:0; width:100%; height:100%; border:none; margin:0; padding:0; overflow:hidden; z-index:999999;"></iframe>
</body>
</html>