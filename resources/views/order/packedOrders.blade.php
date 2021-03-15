<div class="thirdTable" >
  <div class="header">Supakuotu užsakymu sarasas</div>
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
        <th>Pabaigimo data</th>
        <th>Kiekis</th>
        <th>Dezes</th>
        <th>Keisti</th>
        
      </tr>
      
      @foreach ($ordersDonePacking as $ordersDonePacking)

      <tr onclick="window.location='{{route('order.orderCard',$ordersDonePacking)}}'">
        <form action="{{route('order.toArchive',$ordersDonePacking)}}" method="post">
          <td>{{$ordersDonePacking->uzsakovas}}</td>
          <td>{{$ordersDonePacking->pavadinimas}}</td>
          <td>{{$ordersDonePacking->ilgis}}</td>
          <td>{{$ordersDonePacking->plotis}}</td>
          <td>{{$ordersDonePacking->medziaga}}</td>
          <td>{{$ordersDonePacking->klijai}}</td>
          <td>{{$ordersDonePacking->eiles}}</td>
          <td>{{$ordersDonePacking->spalva}}</td>
          <td>{{$ordersDonePacking->pabaigimas}}</td>
          <td>{{$ordersDonePacking->kiekis}}</td>
          <td>{{$ordersDonePacking->dezes}}</td>
          <td>
            <button type="submit">Save</button> 
          </td>
          @csrf
        </form>


      </tr>
      @endforeach
      
    </table>
  </div>
