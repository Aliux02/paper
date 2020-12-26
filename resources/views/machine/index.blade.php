<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
  <title>Document</title>
</head>
<body>
  <header>
    <a href="{{route('welcome')}}"><button>Atgal</button></a>
  </header>
  <div class="container">
    <div class="store">
        <form action="{{route('machine.store')}}" method="post">
          <div class="ivestis">
            <label for="pavadinimas">Pavadinimas:</label><br>
            <input type="text" id="pavadinimas" size="8" name="pavadinimas" value="">
          </div>
            
          <div class="btn_ivastis">
            <input  type="submit" value="Submit">
            @csrf
          </div>
        </form>
    </div>
    
    <h2>Masinu sarasas</h2>
    <div class="lentele">
      @foreach ($machines as $machine)
        <table>
          <h2>{{$machine->pavadinimas}}</h2>
          <tr>
            <th>Uzs. nr.</th>
            <th>uzsakovas</th>
            <th>pavadinimas</th>
            <th>ilgis</th>
            <th>plotis</th>
            <th>medziaga</th>
            <th>klijai</th>
            <th>eiles</th>
            <th>spalva</th>
            <th>kiekis</th>
            <th>Keisti</th>
            <th>Info</th>
            <th>Istrinti</th>
          </tr>
          @foreach ($orders as $order)
          @if ($machine->id == $order->machine_id)
          <tr>
              <form action="" method="get">
                <td>{{$order->id}} </td>
                <td>{{$order->uzsakovas}} </td>
                <td>{{$order->pavadinimas}} </td>
                <td>{{$order->ilgis}} </td>
                <td>{{$order->plotis}} </td>
                <td>{{$order->medziaga}} </td>
                <td>{{$order->klijai}} </td>
                <td>{{$order->eiles}} </td>
                <td>{{$order->spalva}} </td>
                <td>{{$order->kiekis}} </td>
                <td>
                    <button type="submit">Save</button> 
                </td>
              </form>
                <td>
                  <a href="{{route('machine.index')}}"><button>Info</button></a>
                </td>
                <td>
                  <a href="{{route('machine.destroy',$machine)}} "><button>Delete</button></a>
                </td>
          </tr>
          @endif
          @endforeach
        
        </table>
      @endforeach
    </div>
  </div>
</body>
</html>