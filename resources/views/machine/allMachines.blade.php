<h2 style="background-color: white">{{$machine->pavadinimas}}</h2>
      <table>
        <tr>
          <th>Eil. nr.</th>
          <th>Uzs. nr.</th>
          <th>Uzsakovas</th>
          <th>Pavadinimas</th>
          <th>Ilgis</th>
          <th>Plotis</th>
          <th>Medziaga</th>
          <th>Velenas</th>
          <th>Klijai</th>
          <th>Eiles</th>
          <th>Spalva</th>
          <th>Pabaigimo data</th>
          
          <th>Pastabos</th>
          <th>Maketas</th>
          <th>Kiekis</th>                
          @if(auth()->user()->permission_lvl>=100 && auth()->user()->permission_lvl<750 || auth()->user()->permission_lvl>=2000)
          <th>Keisti</th>
          @endif
          
        </tr>
        @foreach ($orders as $order)
        @if ($machine->id == $order->machine_id)
        <tr>
          <form action="{{route('machine.moveElement')}}" method="get">
            <td>{{$order->eil_nr}}
              @if(auth()->user()->permission_lvl>=100 && auth()->user()->permission_lvl<750 || auth()->user()->permission_lvl>=1000)
              <input type="hidden" name="yyy" value="{{$machine->id-1}}">
              <input type="hidden" name="xxx" value="{{$order->eil_nr}}">
              <button type="submit">Up</button>
              @endif
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
            <td>{{$order->pabaigimas}} </td>
            
            <td>{{$order->pastabos}} </td>
            <td>
              <?php if ($order->maketas !== '0') {
                echo '<a style="text-decoration: none" href="'.route('order.printLayout', $order ).'">Maketas</a>';
                }?>
            </td>
          </form>
          <form action="{{route('order.doneRewind')}}" method="post">
            <td>

              @if (auth()->user()->permission_lvl>=750)
              {{$order->kiekis}}
              @else
              <input type="text"  size="4" name="kiekis" value="{{$order->kiekis}}">
              @endif
              
            </td>
            @if(auth()->user()->permission_lvl>=100 && auth()->user()->permission_lvl<750 || auth()->user()->permission_lvl>=2000)
            <td>
                <input type="hidden" name="id" value="{{$order->id}}">
                <button type="submit">Pagaminta</button>
              </td>
              @endif
                @csrf
              </form>
        </tr>
        @endif
        @endforeach
      </table>