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
    <div class="row">
    @include('errors')
    </div>
    
   
    @if(auth()->user()->permission_lvl>=100 )
    @include('machine.printedOrders')
    @endif
    
    
    @if(auth()->user()->permission_lvl>=500 )
    <div class="row">
      <h2 class="col-12">Spausdinimo masinos</h2>
    </div>
    @include('machine.printMachines')          
    @endif
        
    @if(auth()->user()->permission_lvl>=100 && 
        auth()->user()->permission_lvl<500 || 
        auth()->user()->permission_lvl>=750)
    <div class="row">
      <h2 class="col-12">Vyniokles</h2>
    </div>
    @include('machine.rewinders')
    @endif



  </div>
  @endif
  @endauth
</body>
</html>

<script>
  function tdclick(event){
      console.log(''); 
      event.stopPropagation()
  };
</script>