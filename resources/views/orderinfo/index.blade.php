<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <title>Uzsakymo istorija</title>
    
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=1000)
  @include('header')

  <div class="container">
    <div class="secondTable" >
      <div class="header">Uzsakymo istorija</div>
      <table>
        <tr>
          <th>Uzpilde</th>
          <th>Uzpildyta</th>
          <th>Atspausdino</th>
          <th>Atspausdinta</th>
          <th>Suvyniojo</th>
          <th>Suvyniota</th>
          <th>Supakavo</th>
          <th>Supakuota</th>
          
          
        </tr>
          
        @foreach ($orderinfos as $orderinfo)

        <tr>
          <form action="" method="post">
            <td><input type="text" size="8" name="uzpilde" value="{{$orderinfo->uzpilde}}"></td>
            <td><input type="text" size="14" name="uzpildyta" value="{{$orderinfo->uzpildyta}}"></td>
            <td><input type="text" size="8" name="atspausdino" value="{{$orderinfo->atspausdino}}"></td>
            <td><input type="text" size="14" name="atspausdinta" value="{{$orderinfo->atspausdinta}}"></td>
            <td><input type="text" size="8" name="suvyniojo" value="{{$orderinfo->suvyniojo}}"></td>
            <td><input type="text" size="14" name="suvyniota" value="{{$orderinfo->suvyniota}}"></td>
            <td><input type="text" size="8" name="supakavo" value="{{$orderinfo->supakavo}}"></td>
            <td><input type="text" size="14" name="supakuota" value="{{$orderinfo->supakuota}}"></td>
            



        </tr>
        @endforeach
          
      </table>
    </div>
  </div>
  @endif
  @endif
  @endauth
</body>
</html>