<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    
    <title>Uzsakymai</title>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  
  @include('header')
  @include('errors')

  @if (auth()->user()->permission_lvl>=1000)
  <a href="{{route('order.create')}}" style="margin-left: 20px; text-decoration:none">Ivesti uzsakyma</a>
  @endif

  <div class="container">


    
    @if (auth()->user()->permission_lvl>=750)
     <h2>Einamuju uzsakymu sarasas</h2>
    @include('order.allOrders')
    @endif

    @if (auth()->user()->permission_lvl>=1000)
      <h2 class="lia">Supakuotu uzsakymu sarasas</h2>
      @include('order.packedOrders')
    @endif
  </div>
  
  @endif
  @endauth

</body>
</html>