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
  

  
  <div class="container">
    <div class="row">
      @include('errors')
    </div>
    
    @if (auth()->user()->permission_lvl>=750)
    @include('order.allOrders')
    @endif

    @if (auth()->user()->permission_lvl>=1000)
      @include('order.packedOrders')
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