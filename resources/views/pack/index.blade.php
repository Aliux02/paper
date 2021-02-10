<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <style>
        .container{
          display: grid;
          grid-template-columns: 20px 1fr 5fr 1fr 20px;
          grid-template-rows: auto;
          grid-template-areas:     
          ". . store .  ."
          ". h2 h2 h2 ."
          ". filtras filtras filtras ."
          ". . lentele . .";
        }
          table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
          }
          
          td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
          }
          
          tr:nth-child(even) {
            background-color: #dddddd;
          }
          .store{
            padding: 20px;
            grid-area: store;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
          }
          .lentele{
            grid-area: lentele;
            overflow-x:auto;
          }
          h2{
            grid-area: h2;
            text-align: center;
          }
          .ivestis{
            /* width: 200px; */
            padding: 0px 20px;
            float: left;
          }
          .btn_ivastis{
            float: left;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            padding: 0px 20px;
          }
          .filtras{
            grid-area: filtras;
            text-align: center;
          }
          header{
            height: 40px;
            background-color: aliceblue;
          }
      </style>
    <title>Pakavimo sale</title>
</head>
<body>

  @auth
  @if (auth()->user()->status!=0 )
  @if (auth()->user()->permission_lvl>=750)

    <header>
      <a href="{{route('welcome')}}"><button>Atgal</button></a>
    </header>
    <div class="container">
        
    
      <h2>Suvynioti uzsakymai</h2>
    
      <div class="lentele" >
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
                <th>Dezes</th>
                <th>Kiekis</th>
                <th>Supakuota</th>
                
                
            </tr>
          
            @foreach ($orders as $order)
            <tr>
              <form action="{{route('order.donePacking',$order)}}" method="post">
                <td><input type="text" size="10" name="uzsakovas" value="{{$order->uzsakovas}}"></td>
                <td><input type="text" size="10" name="pavadinimas" value="{{$order->pavadinimas}}"></td>
                <td><input type="text" size="2" name="ilgis" value="{{$order->ilgis}}"></td>
                <td><input type="text" size="2" name="plotis" value="{{$order->plotis}}"></td>
                <td><input type="text" size="4" name="medziaga" value="{{$order->medziaga}}"></td>
                <td><input type="text" size="2" name="klijai" value="{{$order->klijai}}"></td>
                <td><input type="text" size="1" name="eiles" value="{{$order->eiles}}"></td>
                <td><input type="text" size="1" name="spalva" value="{{$order->spalva}}"></td>
                <td><input type="text" size="1" name="dezes" value="{{$order->dezes}}"></td>
                <td><input type="text" size="4" name="kiekis" value="{{$order->kiekis}}"></td>
                <td>
                  <button type="submit">Save</button> 
                </td>
                @csrf
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