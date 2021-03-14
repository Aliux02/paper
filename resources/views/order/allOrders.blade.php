<div class="firstTable" >
  <div class="header">Einamuju uzsakymu sarasas </div>
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
        {{-- <th>Daugiau</th> --}}
        {{-- <th>Pastabos</th>

        @if (auth()->user()->permission_lvl>=1000)

        <th>Priskirti masina</th>
        <th>Keisti</th>
        <th>Maketas</th>
        <th>Istrinti</th> --}}

        {{-- @endif --}}

      </tr>
      
      @foreach ($orders as $order)
      @if ($order->status !== 4)
          
      
          
      <tr onclick="window.location='{{route('order.orderCard',$order)}}'" ; {{$order->color()}}>
        <form action="{{route('order.update',$order)}}" method="get" enctype="multipart/form-data">
          <td>{{$order->uzsakovas}}</td>
          <td>{{$order->pavadinimas}}</td>
          <td>{{$order->ilgis}}</td>
          <td>{{$order->plotis}}</td>
          <td>{{$order->medziaga}}</td>
          <td>{{$order->klijai}}</td>
          <td>{{$order->eiles}}</td>
          <td>{{$order->spalva}}</td>
          <td>{{$order->kiekis}}</td>
          <td>{{$order->velenas}}</td>
          <td>{{$order->pabaigimas}}</td>
          <input type="hidden"  size="6" name="maketas" value="{{$order->maketas}}">
          {{-- <td><textarea name="pastabos" cols="10" rows="1" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>{{$order->pastabos}}</textarea></td> --}}
          
          @if (auth()->user()->permission_lvl>=1000)

          {{-- <td><a href="{{route('order.orderCard',$order)}}">Daugiau</a></td> --}}

          {{-- <td>    
            
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
        </td> --}}

        @endif

      </tr>

      
      @endif
      @endforeach
      
    </table>
  </div>