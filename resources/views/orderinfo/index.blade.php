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
        <thead>
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
      </thead>
      <tbody>
        @foreach ($orderinfos as $orderinfo)

        <tr>
          <form action="" method="post">
            <td>{{$orderinfo->uzpilde}}</td>
            <td>{{$orderinfo->uzpildyta}}</td>
            <td>{{$orderinfo->atspausdino}}</td>
            <td>{{$orderinfo->atspausdinta}}</td>
            <td>{{$orderinfo->suvyniojo}}</td>
            <td>{{$orderinfo->suvyniota}}</td>
            <td>{{$orderinfo->supakavo}}</td>
            <td>{{$orderinfo->supakuota}}</td>
            



        </tr>
        @endforeach
      </tbody>
      </table>
    </div>
  </div>
  @endif
  @endif
  @endauth
</body>
</html>