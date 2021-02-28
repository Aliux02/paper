<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
  <link href="{{ asset('css/main.css') }}" rel="stylesheet">




  <title>Masinos</title>
</head>
<body>
  @auth
  @if (auth()->user()->status!=0 )
  
  @include('header')

  <div class="container">
    @include('errors')

    
    @if (auth()->user()->permission_lvl>=2000 )
    @include('machine.storeMachine')
    @endif  
    
    @if(auth()->user()->permission_lvl>=100 )
    <h2 class="titleOne">Atspausdinti uzsakymai</h2>
    @include('machine.printedOrders')
    @endif
    
    
    @if(auth()->user()->permission_lvl>=500 )
    <h2 class="titleTwo">Spausdinimo masinos</h2>
    @include('machine.printMachines')          
    @endif
        
    @if(auth()->user()->permission_lvl>=100 && 
        auth()->user()->permission_lvl<500 || 
        auth()->user()->permission_lvl>=750)
    <h2 class="titleThree">Vyniokles</h2>
    @include('machine.rewinders')
    @endif



  </div>
  @endif
  @endauth
</body>
</html>