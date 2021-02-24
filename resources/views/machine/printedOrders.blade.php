
<div class="lentele1" style="background-color: aquamarine">
    <table>
      <tr>
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
        <th>Kiekis</th>
        @if(auth()->user()->permission_lvl>=100 && auth()->user()->permission_lvl<750 || auth()->user()->permission_lvl>=2000)
        <th>Keisti</th>
        <th>Parinkti</th>
        @endif
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
          <td>{{$doneOrder->pabaigimas}}</td>
          <td>{{$doneOrder->kiekis}} </td>
          
          @if(auth()->user()->permission_lvl>=100 && auth()->user()->permission_lvl<750 || auth()->user()->permission_lvl>=2000)
            
            <td>    
              <select style="width: 60px" name="machine_id" >
                  @foreach ($machines as $machine)
                  @if ($machine->tipas == 'vyniokle')
                  <option  value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
                  @endif
                @endforeach
              </select>

            </td>
            <td>
              <button type="submit">Save</button> 
            </td>

          @endif
            @csrf
        </form>
        </tr>
      @endforeach
    </table>
  </div>
 