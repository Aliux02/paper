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
    ". ats_uzs ats_uzs ats_uzs ."
    ". . lentele1 . ."
    ". h2 h2 h2 ."
    ". filtras filtras filtras ."
    ". . lentele . ."
    ". vyniokles vyniokles vyniokles ."
    ". . lentele2 . ."
    ". . lentele3 . .";
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
  .lentele2{
    grid-area: lentele2;
    overflow-x:auto;
  }
  .lentele3{
    grid-area: lentele3;
    overflow-x:auto;
  }
  h2{
    grid-area: h2;
    text-align: center;
  }
  .vyniokles{
    grid-area: vyniokles;
    text-align: center;
  }
  .ats_uzs{
    grid-area: ats_uzs;
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
  <title>Masinos</title>
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
          
          <div style="float: left">
            <label for="tipas">Tipas:</label><br>
            <select id="tipas" name="tipas" >
              <option value="vyniokle">Vyniokle</option>
              <option value="spausdinimo">Spausdinimo</option>
            </select>
          </div>

          <div class="btn_ivastis">
            <input  type="submit" value="Submit">
            @csrf
          </div>
        </form>
    </div>
    
    <h2 class="ats_uzs">Atspausdinti uzsakymai</h2>

    <div class="lentele1" style="background-color: aquamarine">
      <table>
        <tr>
          <th>Uzs. nr.</th>
          <th>uzsakovas</th>
          <th>pavadinimas</th>
          <th>ilgis</th>
          <th>plotis</th>
          <th>medziaga</th>
          <th>velenas</th>
          <th>klijai</th>
          <th>eiles</th>
          <th>spalva</th>
          <th>kiekis</th>
          <th>Keisti</th>
          <th>parinkti</th>
        </tr>

        
        @foreach ($doneOrders as $doneOrder)
          <tr>
          <form action="{{route('order.rewind',$doneOrder)}}" method="post"> 
            <td>{{$doneOrder->id}} </td>
            <td>{{$doneOrder->uzsakovas}} </td>
            <td>{{$doneOrder->pavadinimas}} </td>
            <td>{{$doneOrder->ilgis}} </td>
            <td>{{$doneOrder->plotis}} </td>
            <td>{{$doneOrder->medziaga}} </td>
            <td>{{$doneOrder->velenas}} </td>
            <td>{{$doneOrder->klijai}} </td>
            <td>{{$doneOrder->eiles}} </td>
            <td>{{$doneOrder->spalva}} </td>
            <td>{{$doneOrder->kiekis}} </td>
                
            <td>    
                
              <select name="machine_id" >
                  @foreach ($machines as $machine)
                  @if ($machine->tipas == 'vyniokle')
                  <option value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
                  @endif
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

    <h2>Spausdinimo masinos</h2>
    <div class="lentele" style="background-color: rgb(221, 255, 127)">
      
      @foreach ($machines as $machine)
      @if ($machine->tipas == 'spausdinimo')
      <h2 style="background-color: red">{{$machine->pavadinimas}}</h2>
        <table>
          <tr>
            <th>Eil. nr.</th>
            <th>Uzs. nr.</th>
            <th>uzsakovas</th>
            <th>pavadinimas</th>
            <th>ilgis</th>
            <th>plotis</th>
            <th>medziaga</th>
            <th>velenas</th>
            <th>klijai</th>
            <th>eiles</th>
            <th>spalva</th>
            <th>kiekis</th>
            <th>Keisti</th>
          </tr>
          @foreach ($orders as $order)
          @if ($machine->id == $order->machine_id)
          
          <tr>
            <form action="{{route('machine.moveElement')}}" method="get">
              <td>{{$order->eil_nr}}
                <input type="hidden" name="yyy" value="{{$machine->id-1}}">
                <input type="hidden" name="xxx" value="{{$order->eil_nr}}">
                <input type="hidden" name="eiles_nr"  id="" value="">
                <button type="submit">Up</button>

              </td>
              <td>{{$order->id}} </td>
              <td>{{$order->uzsakovas}} </td>
              <td>{{$order->pavadinimas}} </td>
              <td>{{$order->ilgis}} </td>
              <td>{{$order->plotis}} </td>
              <td>{{$order->medziaga}} </td>
              <td>{{$order->velenas}} </td>
              <td>{{$order->klijai}} </td>
              <td>{{$order->eiles}} </td>
              <td>{{$order->spalva}} </td>
              <td>{{$order->kiekis}} </td>
            </form>
              <td>
                <form action="{{ route('order.donePrint') }}" method="post">
                  <input type="hidden" name="id" value="{{$order->id}}">
                  
                  <button type="submit">Pagaminta</button>
                  @csrf
                </form>
              </td>
          </tr>
          @endif
          @endforeach
        </table>
        @endif
      @endforeach
    </div>

    <h2 class="vyniokles">Vyniokles</h2>

    <div class="lentele2" style="background-color: rgb(148, 235, 19)">
      @foreach ($machines as $machine)
      @if ($machine->tipas == 'vyniokle')
      <h2 style="background-color: red">{{$machine->pavadinimas}}</h2>
        <table>
          <tr>
            <th>Eil. nr.</th>
            <th>Uzs. nr.</th>
            <th>uzsakovas</th>
            <th>pavadinimas</th>
            <th>ilgis</th>
            <th>plotis</th>
            <th>medziaga</th>
            <th>velenas</th>
            <th>klijai</th>
            <th>eiles</th>
            <th>spalva</th>
            <th>kiekis</th>
            <th>Keisti</th>
          </tr>
          @foreach ($orders as $order)
          @if ($machine->id == $order->machine_id)
          <tr>
            <form action="{{route('machine.moveElement')}}" method="get">
              <td>{{$order->eil_nr}}
                <input type="hidden" name="yyy" value="{{$machine->id-1}}">
                <input type="hidden" name="xxx" value="{{$order->eil_nr}}">
                <input type="hidden" name="eiles_nr"  id="" value="">
                <button type="submit">Up</button>

              </td>
              <td>{{$order->id}} </td>
              <td>{{$order->uzsakovas}} </td>
              <td>{{$order->pavadinimas}} </td>
              <td>{{$order->ilgis}} </td>
              <td>{{$order->plotis}} </td>
              <td>{{$order->medziaga}} </td>
              <td>{{$order->velenas}} </td>
              <td>{{$order->klijai}} </td>
              <td>{{$order->eiles}} </td>
              <td>{{$order->spalva}} </td>
              <td>{{$order->kiekis}} </td>
            </form>
              <td>
                <form action="{{route('order.doneRewind')}}" method="post">
                  <input type="hidden" name="id" value="{{$order->id}}">
                  
                  <button type="submit">Pagaminta</button>
                  @csrf
                </form>
              </td>
          </tr>
          @endif
          @endforeach
        </table>
        @endif
      @endforeach
    </div>
    



        {{-- <div class="lentele3" style="background-color: rgb(187, 195, 223)">
          
          @for ($b = 0; $b < count($arr); $b++)
          {{$machines[$b]->pavadinimas}}
          <table>
            <tr>
              <th>Eil. nr.</th>
              <th>db eil nr</th>
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
              
            @for ($c = 0; $c < count($arr[$b]); $c++)
              <form action="{{route('machine.moveElement')}}" method="get">
              <tr>
                <td>
                  <input type="hidden" name="yyy" value="{{$b}}">
                  <input type="hidden" name="xxx" value="{{$arr[$b][$c]->eil_nr}}">
                  <input type="hidden" name="eiles_nr"  id="" value="">
                  <button type="submit">pakeisti</button>
                </td>
                <td>{{$arr[$b][$c]->eil_nr}} </td>
                <td>{{$arr[$b][$c]->id}} </td>
                <td>{{$arr[$b][$c]->uzsakovas}} </td>
                <td>{{$arr[$b][$c]->pavadinimas}} </td>
                <td>{{$arr[$b][$c]->ilgis}} </td>
                <td>{{$arr[$b][$c]->plotis}} </td>
                <td>{{$arr[$b][$c]->medziaga}} </td>
                <td>{{$arr[$b][$c]->klijai}} </td>
                <td>{{$arr[$b][$c]->eiles}} </td>
                <td>{{$arr[$b][$c]->spalva}} </td>
                <td>{{$arr[$b][$c]->kiekis}} </td>
                <td>{{$arr[$b][$c]->id}}</td>
              </tr>
              </form>
            @endfor
            </table>
            @endfor
          </div> --}}
  </div>
</body>
</html>