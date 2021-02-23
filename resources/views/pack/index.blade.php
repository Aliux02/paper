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
          .alert{
            grid-area: alert;
            font-size: 15px;
            color: red;
            width: 100%;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
          }
          .alert-info{
            font-size: 20px;
            color: yellow;
          }
          .alert-success{
            font-size: 20px;
            color: green;
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

    @if ($errors->any())
    <div class="alert">
      <ul class="list-group">
      @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
      @endforeach
      </ul>
    </div>
    @endif

    @if (session()->has('success_message'))
    <ul class="alert alert-success">
      <li>{{session()->get('success_message')}}</li>
    </ul>
    @endif

    @if (session()->has('info_message'))
    <ul class="alert alert-success">
      <li>{{session()->get('info_message')}}</li>
    </ul>
    @endif


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