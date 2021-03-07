<div class="secondTable" >
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
        <th>Kiekis</th>
        <th>Velenas</th>
        <th>Pagaminimo data</th>
        <th>Pastabos</th>

        @if (auth()->user()->permission_lvl>=1000)

        <th>Priskirti masina</th>
        <th>Keisti</th>
        <th>Maketas</th>
        <th>Istrinti</th>

        @endif

      </tr>
      
      @foreach ($orders as $order)
      @if ($order->status !== 4)
          
      
          
      <tr {{$order->color()}}>
        <form action="{{route('order.update',$order)}}" method="get" enctype="multipart/form-data">
          <td><input type="text"  size="10" name="uzsakovas" value="{{$order->uzsakovas}}"></td>
          <td><input type="text"  size="10" name="pavadinimas" value="{{$order->pavadinimas}}"></td>
          <td><input type="text"  size="2" name="ilgis" value="{{$order->ilgis}}"></td>
          <td><input type="text"  size="2" name="plotis" value="{{$order->plotis}}"></td>
          <td><input type="text"  size="4" name="medziaga" value="{{$order->medziaga}}"></td>
          <td><input type="text"  size="2" name="klijai" value="{{$order->klijai}}"></td>
          <td><input type="text"  size="1" name="eiles" value="{{$order->eiles}}"></td>
          <td><input type="text"  size="1" name="spalva" value="{{$order->spalva}}"></td>
          <td><input type="text"  size="4" name="kiekis" value="{{$order->kiekis}}"></td>
          <td><input type="text"  size="1" name="velenas" value="{{$order->velenas}}"></td>
          <td><input type="text"  size="6" name="pabaigimas" value="{{$order->pabaigimas}}"></td>
          <input type="hidden"  size="6" name="maketas" value="{{$order->maketas}}">
          <td><textarea name="pastabos" cols="10" rows="1" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{$order->pastabos}}</textarea></td>
          
          @if (auth()->user()->permission_lvl>=1000)



          <td>    
            
            <select name="machine_id" >
              @if ($order->machine_id===null)
                <option  value="0">
                  All 
                </option>
                @foreach ($machines as $machine)
                  <option value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
                  @endforeach
              @else
            
                @foreach ($machines as $machine)
                @if ($order->machine_id == $machine->id)

                <option value="{{$machine->id}}">
                  {{$machine->pavadinimas}}
                </option>
                @else 

                @endif
                @endforeach
                <option style="background-color: rgb(4, 61, 110);color:white" value="0">
                  Nuimti
                </option>
                @foreach ($machines as $machine)
                  <option value="{{$machine->id}}">{{$machine->pavadinimas}}</option>
                @endforeach
              @endif


            </select>

          </td>
          <td>
            <button type="submit">Save</button> 
          </td>
        </form>
        <td>
          <?php if ($order->maketas !== '0') {
          echo '<a style="text-decoration: none" href="'.route('order.printLayout', $order ).'">Maketas</a>';
          } 
          ?>
        </td>
        <td>
          <a href="{{route('order.destroy', $order)}} "><button>Delete</button></a>
        </td>

        @endif

      </tr>
      @endif
      @endforeach
      
    </table>
  </div>