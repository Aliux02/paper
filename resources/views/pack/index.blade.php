<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <title>Pakavimo sale</title>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=750)

@include('header')
@include('errors')


    <div class="container">
        
    
      <h2 class="titleOne">Suvynioti uzsakymai</h2>
    
      <div class="firstTable" >
        <table>
            <tr>
                <th>Uzsakovas</th>
                <th>Pavadinimas</th>
                <th>Ilgis</th>
                <th>Plotis</th>
                <th>Medziaga</th>
                <th>Klijai</th>
                <th>Eiles</th>
                <th>Spalvos</th>
                <th>Pagaminimo data</th>
                <th>Pastabos</th>
                <th>Dezes</th>
                <th>Kiekis</th>
                @if (auth()->user()->permission_lvl>=750 && auth()->user()->permission_lvl<1000 || auth()->user()->permission_lvl>=2000)
                <th>Supakuota</th>
                @endif
                
            </tr>
          
            @foreach ($orders as $order)
            <tr>
              <form action="{{route('order.donePacking',$order)}}" method="post">
                <td>{{$order->uzsakovas}}</td>
                <td>{{$order->pavadinimas}}</td>
                <td>{{$order->ilgis}}</td>
                <td>{{$order->plotis}}</td>
                <td>{{$order->medziaga}}</td>
                <td>{{$order->klijai}}</td>
                <td>{{$order->eiles}}</td>
                <td>{{$order->spalva}}</td>
                <td>{{$order->pabaigimas}}</td>
                <td>{{$order->pastabos}}</td>
                <td><input type="text" size="1" name="dezes" value="{{$order->dezes}}"></td>
                <td><input type="text" size="4" name="kiekis" value="{{$order->kiekis}}"></td>
                @if (auth()->user()->permission_lvl>=750 && auth()->user()->permission_lvl<1000 || auth()->user()->permission_lvl>=2000)
                <td>
                  <button type="submit">Save</button> 
                </td>
                @csrf
                @endif
              </form>
            </tr>
            @endforeach
          
        </table>
      </div>

      @endif
      @endif
      @endauth
</body>
</html>