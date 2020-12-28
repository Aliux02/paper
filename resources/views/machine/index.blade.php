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
    ". . lentele1 . ."
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
  .lentele1{
    grid-area: lentele1;
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
    

    <div class="lentele1" style="background-color: aquamarine">
    <table>
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
      <th>parinkti</th>
    </tr>

    <h2>Atspausdinti uzsakymai</h2>

    @foreach ($doneOrders as $doneOrder)
    <tr>
      <form action="{{route('order.rewind',$doneOrder)}}" method="post"> 
          <td>{{$doneOrder->id}} </td>
          <td>{{$doneOrder->uzsakovas}} </td>
          <td>{{$doneOrder->pavadinimas}} </td>
          <td>{{$doneOrder->ilgis}} </td>
          <td>{{$doneOrder->plotis}} </td>
          <td>{{$doneOrder->medziaga}} </td>
          <td>{{$doneOrder->klijai}} </td>
          <td>{{$doneOrder->eiles}} </td>
          <td>{{$doneOrder->spalva}} </td>
          <td>{{$doneOrder->kiekis}} </td>
               
          <td>    
               
            <select name="machine_id" >
              <option value="0">All</option>
                @foreach ($machines as $machine)
                <option value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
              @endforeach
            </select>

          </td>
          <td>
            <button type="submit">Save</button> 
          </td>
          @csrf
        </form>
    </tr>
    @endforeach
  </table>
</div>

    <h2>Masinu sarasas</h2>
    <div class="lentele" style="background-color: rgb(221, 255, 127)">
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
              </form>
                <td>
                  <form action="{{ route('order.done') }}" method="post">
                    <input type="hidden" name="id" value="{{$order->id}}">
                    
                    <button type="submit">Pagaminta</button>
                    @csrf
                  </form>
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